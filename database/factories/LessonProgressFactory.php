<?php

namespace Database\Factories;

use App\Models\LessonProgress;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LessonProgress>
 */
class LessonProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_id' => Enrollment::factory(),
            'lesson_id' => Lesson::factory(),
            'played_ranges' => null,
            'video_done_at' => null,
            'read_at' => null,
            'activity_tried_at' => null,
            'completed_at' => null,
            'xp_awarded' => false,
        ];
    }
}
