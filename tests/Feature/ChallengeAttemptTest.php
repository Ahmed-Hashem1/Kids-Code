<?php

namespace Tests\Feature;

use App\Models\Challenge;
use App\Models\Child;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\Level;
use App\Models\PathVersion;
use App\Models\Pathway;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use App\Services\ChallengeGrader;
use Tests\TestCase;

class ChallengeAttemptTest extends TestCase
{
    use RefreshDatabase;

    public function test_correct_challenge_awards_xp_once_and_duplicate_request_returns_saved_result(): void
    {
        [$user, $enrollment, $lesson, $challenge] = $this->createChallenge();
        $requestKey = (string) Str::uuid();
        $answer = [
            'request_key' => $requestKey,
            'option_id' => 'o2',
        ];

        $this->actingAs($user)
            ->post(route('learn.challenges.attempts.store', $challenge), $answer)
            ->assertRedirect(route('learn.lessons.show', $lesson))
            ->assertSessionHas('challenge_result.is_correct', true);

        $this->assertSame(10, $enrollment->fresh()->xp_total);
        $this->assertDatabaseHas('lesson_progress', [
            'enrollment_id' => $enrollment->id,
            'lesson_id' => $lesson->id,
            'xp_awarded' => true,
        ]);

        $this->post(route('learn.challenges.attempts.store', $challenge), $answer)
            ->assertRedirect(route('learn.lessons.show', $lesson))
            ->assertSessionHas('challenge_result.replayed', true);

        $this->assertSame(10, $enrollment->fresh()->xp_total);
        $this->assertDatabaseCount('challenge_attempts', 1);
    }

    public function test_request_key_cannot_be_reused_with_a_different_answer(): void
    {
        [$user, $enrollment, $lesson, $challenge] = $this->createChallenge();
        $requestKey = (string) Str::uuid();

        $this->actingAs($user)->post(route('learn.challenges.attempts.store', $challenge), [
            'request_key' => $requestKey,
            'option_id' => 'o2',
        ])->assertRedirect();

        $this->post(route('learn.challenges.attempts.store', $challenge), [
            'request_key' => $requestKey,
            'option_id' => 'o1',
        ])->assertStatus(409);

        $this->assertDatabaseCount('challenge_attempts', 1);
        $this->assertSame(10, $enrollment->fresh()->xp_total);
    }

    public function test_wrong_answer_is_saved_without_awarding_xp(): void
    {
        [$user, $enrollment, $lesson, $challenge] = $this->createChallenge();

        $this->actingAs($user)
            ->post(route('learn.challenges.attempts.store', $challenge), [
                'request_key' => (string) Str::uuid(),
                'option_id' => 'o1',
            ])
            ->assertRedirect(route('learn.lessons.show', $lesson))
            ->assertSessionHas('challenge_result.is_correct', false);

        $this->assertSame(0, $enrollment->fresh()->xp_total);
        $this->assertDatabaseHas('lesson_progress', [
            'enrollment_id' => $enrollment->id,
            'lesson_id' => $lesson->id,
            'xp_awarded' => false,
        ]);
        $this->assertSame(0, LessonProgress::where('enrollment_id', $enrollment->id)
            ->whereNotNull('completed_at')
            ->count());
    }

    public function test_child_dashboard_and_lesson_render_their_journey_and_challenge_without_grading_key(): void
    {
        [$user, $enrollment, $lesson, $challenge] = $this->createChallenge();

        $this->actingAs($user)
            ->get('/learn')
            ->assertOk()
            ->assertSee('رحلة التعلم')
            ->assertSee('درس تجريبي');

        $this->get(route('learn.lessons.show', $lesson))
            ->assertOk()
            ->assertSee('ما ناتج التعبير؟')
            ->assertSee('تحقق من إجابتي')
            ->assertDontSee('grading_key');
    }

    public function test_grader_checks_order_fix_and_maze_without_running_user_code(): void
    {
        $grader = new ChallengeGrader;

        $ordering = new Challenge([
            'kind' => 'ordering',
            'config' => ['steps' => [['id' => 's1'], ['id' => 's2']]],
            'grading_key' => ['order' => ['s1', 's2']],
        ]);
        $this->assertTrue($grader->grade($ordering, ['order' => ['s1', 's2']]));
        $this->assertFalse($grader->grade($ordering, ['order' => ['s2', 's1']]));

        $fix = new Challenge([
            'kind' => 'fix',
            'config' => ['lines' => [['id' => 'l1']], 'replacements' => [['id' => 'r1']]],
            'grading_key' => ['line_id' => 'l1', 'replacement_id' => 'r1'],
        ]);
        $this->assertTrue($grader->grade($fix, ['line_id' => 'l1', 'replacement_id' => 'r1']));

        $maze = new Challenge([
            'kind' => 'maze',
            'config' => [
                'grid' => [[0, 0, 0], [0, 1, 0], [0, 0, 0]],
                'start' => [0, 0],
                'goal' => [2, 2],
            ],
            'grading_key' => ['max_steps' => 12],
        ]);
        $this->assertTrue($grader->grade($maze, ['commands' => ['right', 'right', 'down', 'down']]));
        $this->assertFalse($grader->grade($maze, ['commands' => ['right', 'down', 'down', 'right']]));
    }

    private function createChallenge(): array
    {
        $parent = User::factory()->parent()->create(['is_active' => true]);
        $user = User::factory()->child()->create([
            'email' => null,
            'must_change_password' => false,
        ]);
        $child = Child::create([
            'child_user_id' => $user->id,
            'parent_user_id' => $parent->id,
            'display_name' => 'طفل',
            'age_group' => '10-12',
            'avatar' => 'avatar-1.png',
        ]);
        $pathway = Pathway::create([
            'age_group' => '10-12',
            'title' => 'مسار تجريبي',
            'slug' => 'challenge-test-path',
        ]);
        $pathVersion = PathVersion::create([
            'pathway_id' => $pathway->id,
            'version_no' => 1,
            'status' => 'published',
        ]);
        $level = Level::create([
            'path_version_id' => $pathVersion->id,
            'title' => 'مستوى تجريبي',
            'position' => 1,
        ]);
        $lesson = Lesson::create([
            'level_id' => $level->id,
            'title' => 'درس تجريبي',
            'body' => 'محتوى الدرس',
            'code_language' => 'python',
            'reward_xp' => 10,
            'position' => 1,
        ]);
        $challenge = Challenge::create([
            'lesson_id' => $lesson->id,
            'kind' => 'predict',
            'prompt' => 'ما ناتج التعبير؟',
            'config' => [
                'code' => 'print(2 + 3)',
                'language' => 'python',
                'options' => [
                    ['id' => 'o1', 'text' => '23'],
                    ['id' => 'o2', 'text' => '5'],
                ],
            ],
            'grading_key' => ['option_id' => 'o2'],
        ]);
        $enrollment = Enrollment::create([
            'child_id' => $child->id,
            'path_version_id' => $pathVersion->id,
            'xp_total' => 0,
        ]);

        return [$user, $enrollment, $lesson, $challenge];
    }
}
