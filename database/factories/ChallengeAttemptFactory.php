<?php

namespace Database\Factories;

use App\Models\ChallengeAttempt;
use App\Models\Challenge;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChallengeAttempt>
 */
class ChallengeAttemptFactory extends Factory
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
            'challenge_id' => Challenge::factory(),
            'request_key' => fake()->uuid(),
            'response' => ['answer' => 'test'],
            'is_correct' => false,
            'stars' => 0,
        ];
    }
}
