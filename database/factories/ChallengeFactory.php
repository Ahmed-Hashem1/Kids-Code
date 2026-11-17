<?php

namespace Database\Factories;

use App\Models\Challenge;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Challenge>
 */
class ChallengeFactory extends Factory
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
            'kind' => 'predict',
            'prompt' => fake()->sentence(),
            'hint' => fake()->sentence(),
            'config' => ['code' => "print('Hello')", 'language' => 'python', 'options' => []],
            'grading_key' => ['option_id' => 'o1'],
        ];
    }
}
