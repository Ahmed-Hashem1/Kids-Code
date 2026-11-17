<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Assessment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assessment_id' => Assessment::factory(),
            'prompt' => fake()->sentence(),
            'position' => fake()->unique()->numberBetween(1, 100),
        ];
    }
}
