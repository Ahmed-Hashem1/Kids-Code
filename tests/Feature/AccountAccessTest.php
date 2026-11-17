<?php

namespace Tests\Feature;

use App\Models\Child;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonMedia;
use App\Models\Level;
use App\Models\PathVersion;
use App\Models\Pathway;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Tests\TestCase;

class AccountAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_parent_can_register_and_must_verify_email(): void
    {
        Notification::fake();

        $response = $this->post('/parent/register', [
            'name' => 'ولي أمر',
            'email' => 'parent@example.test',
            'password' => 'password-123',
            'password_confirmation' => 'password-123',
        ]);

        $user = User::where('email', 'parent@example.test')->firstOrFail();

        $response->assertRedirect('/email/verify');
        $this->assertSame('parent', $user->role);
        $this->assertNull($user->email_verified_at);
        Notification::assertSentTo($user, VerifyEmail::class);
        $this->actingAs($user)->get('/parent')->assertRedirect('/email/verify');
    }

    public function test_child_login_uses_username_and_forces_temporary_password_change(): void
    {
        [$parent, $childUser] = $this->createChildAccount();

        $response = $this->post('/login', [
            'identity' => $childUser->username,
            'password' => 'temporary-password',
        ]);

        $response->assertRedirect('/password/change');
        $this->assertAuthenticatedAs($childUser);
        $this->get('/learn')->assertRedirect('/password/change');
        $this->get('/password/change')->assertOk();

        $this->put('/password/change', [
            'password' => 'a-new-secure-password',
            'password_confirmation' => 'a-new-secure-password',
        ])->assertRedirect('/learn');

        $this->assertFalse($childUser->fresh()->must_change_password);
        $this->assertTrue(Hash::check('a-new-secure-password', $childUser->fresh()->password));
    }

    public function test_disabled_child_parent_logs_child_out(): void
    {
        [$parent, $childUser] = $this->createChildAccount();
        $parent->update(['is_active' => false]);

        $response = $this->actingAs($childUser)->get('/learn');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_login_attempts_are_rate_limited(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post('/login', [
                'identity' => 'unknown@example.test',
                'password' => 'incorrect',
            ])->assertSessionHasErrors('identity');
        }

        $this->post('/login', [
            'identity' => 'unknown@example.test',
            'password' => 'incorrect',
        ])->assertTooManyRequests();
    }

    public function test_parent_can_reset_password_by_email(): void
    {
        Notification::fake();
        $parent = User::factory()->parent()->create([
            'email' => 'reset@example.test',
        ]);

        $this->post('/forgot-password', ['email' => $parent->email])
            ->assertSessionHas('status');

        Notification::assertSentTo($parent, ResetPassword::class);
        $notification = Notification::sent($parent, ResetPassword::class)->first();

        $this->post('/reset-password', [
            'token' => $notification->token,
            'email' => $parent->email,
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ])->assertRedirect('/login');

        $this->assertTrue(Hash::check('new-password-123', $parent->fresh()->password));
    }

    public function test_parent_can_only_view_their_own_children(): void
    {
        $parent = User::factory()->parent()->create([
            'email' => 'owner@example.test',
            'email_verified_at' => now(),
        ]);
        $otherParent = User::factory()->parent()->create([
            'email' => 'other@example.test',
            'email_verified_at' => now(),
        ]);
        $ownChild = Child::factory()->create(['parent_user_id' => $parent->id]);
        $otherChild = Child::factory()->create(['parent_user_id' => $otherParent->id]);

        $this->actingAs($parent)->get("/parent/children/{$ownChild->id}")->assertOk();
        $this->get("/parent/children/{$otherChild->id}")->assertForbidden();
    }

    public function test_child_can_open_only_enrolled_published_lessons(): void
    {
        [$parent, $childUser, $child] = $this->createChildAccount();
        $childUser->update(['must_change_password' => false]);
        $pathway = Pathway::create([
            'age_group' => '10-12',
            'title' => 'مسار تجريبي',
            'slug' => 'test-path',
        ]);
        $pathVersion = PathVersion::create([
            'pathway_id' => $pathway->id,
            'version_no' => 1,
            'status' => 'published',
        ]);
        $level = Level::create([
            'path_version_id' => $pathVersion->id,
            'title' => 'مستوى',
            'position' => 1,
        ]);
        $lesson = Lesson::create([
            'level_id' => $level->id,
            'title' => 'درس',
            'body' => 'محتوى الدرس',
            'code_language' => 'python',
            'reward_xp' => 10,
            'position' => 1,
        ]);
        Enrollment::create([
            'child_id' => $child->id,
            'path_version_id' => $pathVersion->id,
            'xp_total' => 0,
        ]);
        $otherVersion = PathVersion::create([
            'pathway_id' => $pathway->id,
            'version_no' => 2,
            'status' => 'published',
        ]);
        $otherLevel = Level::create([
            'path_version_id' => $otherVersion->id,
            'title' => 'مستوى آخر',
            'position' => 1,
        ]);
        $otherLesson = Lesson::create([
            'level_id' => $otherLevel->id,
            'title' => 'درس غير مسجل',
            'body' => 'محتوى الدرس',
            'code_language' => 'python',
            'reward_xp' => 10,
            'position' => 1,
        ]);

        $this->actingAs($childUser)->get("/learn/lessons/{$lesson->id}")->assertOk();
        $this->get("/learn/lessons/{$otherLesson->id}")->assertForbidden();

        $media = LessonMedia::create([
            'lesson_id' => $otherLesson->id,
            'kind' => 'image',
            'storage_key' => 'outside-enrollment.png',
            'position' => 1,
        ]);
        $this->get("/media/{$media->id}")->assertForbidden();
    }

    private function createChildAccount(): array
    {
        $parent = User::factory()->parent()->create([
            'email' => 'parent-'.fake()->unique()->numberBetween(1, 999999).'@example.test',
            'is_active' => true,
        ]);
        $childUser = User::factory()->child()->create([
            'name' => 'طفل تجريبي',
            'email' => null,
            'username' => 'hero-'.fake()->unique()->numberBetween(1, 999999),
            'password' => 'temporary-password',
            'must_change_password' => true,
        ]);
        $child = Child::create([
            'child_user_id' => $childUser->id,
            'parent_user_id' => $parent->id,
            'display_name' => 'طفل تجريبي',
            'age_group' => '10-12',
            'avatar' => 'avatar-1.png',
        ]);

        return [$parent, $childUser, $child];
    }
}
