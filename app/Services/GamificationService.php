<?php

namespace App\Services;

use App\Models\Assessment;
use App\Models\AssessmentAttempt;
use App\Models\Badge;
use App\Models\Challenge;
use App\Models\ChallengeAttempt;
use App\Models\ChildBadge;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonProgress;

class GamificationService
{
    public function completeLesson(Enrollment $enrollment, Lesson $lesson): LessonProgress
    {
        $progress = LessonProgress::firstOrCreate(
            ['enrollment_id' => $enrollment->id, 'lesson_id' => $lesson->id],
            ['xp_awarded' => false],
        );

        $progress->completed_at ??= now();
        if (! $progress->xp_awarded) {
            $progress->xp_awarded = true;
            $enrollment->xp_total += $lesson->reward_xp;
        }
        $progress->save();
        $enrollment->last_activity_at = now();

        $completedCount = LessonProgress::where('enrollment_id', $enrollment->id)
            ->whereNotNull('completed_at')
            ->count();

        if ($completedCount >= 1) {
            $this->awardBadge($enrollment, 'first_lesson');
        }

        if ($completedCount >= 5) {
            $this->awardBadge($enrollment, 'five_lessons');
        }

        $levelLessonIds = $lesson->level->lessons()->pluck('id');
        $completedInLevel = LessonProgress::where('enrollment_id', $enrollment->id)
            ->whereIn('lesson_id', $levelLessonIds)
            ->whereNotNull('completed_at')
            ->count();

        if ($levelLessonIds->isNotEmpty() && $completedInLevel === $levelLessonIds->count()) {
            $this->awardBadge($enrollment, 'level_passer');
        }

        $allLessonIds = $enrollment->pathVersion->levels()
            ->with('lessons:id,level_id')
            ->get()
            ->flatMap(fn ($level) => $level->lessons->pluck('id'));
        $completedLessonIds = LessonProgress::where('enrollment_id', $enrollment->id)
            ->whereNotNull('completed_at')
            ->pluck('lesson_id');

        if ($allLessonIds->isNotEmpty() && $allLessonIds->diff($completedLessonIds)->isEmpty()) {
            if ($enrollment->completed_at === null) {
                $enrollment->completed_at = now();
                $enrollment->xp_total += 50;
            }
            $this->awardBadge($enrollment, 'path_graduate');
        }

        return $progress;
    }

    public function awardChallengeStars(
        Enrollment $enrollment,
        Challenge $challenge,
        ChallengeAttempt $attempt,
    ): void {
        if ($attempt->stars < 1) {
            return;
        }

        $alreadyAwarded = ChallengeAttempt::where('enrollment_id', $enrollment->id)
            ->where('challenge_id', $challenge->id)
            ->where('stars', '>', 0)
            ->where('id', '!=', $attempt->id)
            ->exists();

        if (! $alreadyAwarded) {
            $enrollment->xp_total += $attempt->stars * 2;
        }

        $starredChallenges = ChallengeAttempt::where('enrollment_id', $enrollment->id)
            ->where('stars', 3)
            ->distinct()
            ->count('challenge_id');

        if ($starredChallenges >= 5) {
            $this->awardBadge($enrollment, 'bright_star');
        }

        if ($challenge->kind === 'fix') {
            $this->awardBadge($enrollment, 'bug_hunter');
        }
    }

    public function awardAssessmentPass(
        Enrollment $enrollment,
        Assessment $assessment,
        AssessmentAttempt $attempt,
    ): void {
        if (! $attempt->passed) {
            return;
        }

        $alreadyPassed = AssessmentAttempt::where('enrollment_id', $enrollment->id)
            ->where('assessment_id', $assessment->id)
            ->where('passed', true)
            ->where('id', '!=', $attempt->id)
            ->exists();

        if (! $alreadyPassed) {
            $enrollment->xp_total += 20;
        }

        if ($assessment->kind === 'level_end') {
            $this->awardBadge($enrollment, 'level_passer');
        }
    }

    public function awardBadge(Enrollment $enrollment, string $code): void
    {
        $badge = Badge::where('code', $code)->first();
        if ($badge) {
            ChildBadge::firstOrCreate(
                ['child_id' => $enrollment->child_id, 'badge_id' => $badge->id],
                ['earned_at' => now()],
            );
        }
    }
}
