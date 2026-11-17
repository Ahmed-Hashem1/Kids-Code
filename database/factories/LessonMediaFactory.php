<?php

namespace Database\Factories;

use App\Models\LessonMedia;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LessonMedia>
 */
class LessonMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::factory(),
            'kind' => fake()->randomElement(['video', 'caption', 'image']),
            'storage_key' => fake()->uuid(),
            'duration_seconds' => null,
            'alt_text' => fake()->sentence(),
            'position' => fake()->unique()->numberBetween(1, 100),
        ];
    }
}
