<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'level_id' => Level::factory(),
            'title' => fake()->sentence(4),
            'body' => fake()->paragraph(),
            'code_language' => 'python',
            'reward_xp' => 10,
            'position' => fake()->unique()->numberBetween(1, 100),
        ];
    }
}
