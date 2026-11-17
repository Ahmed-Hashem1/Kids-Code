<?php

namespace Database\Factories;

use App\Models\AssessmentAttempt;
use App\Models\Assessment;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AssessmentAttempt>
 */
class AssessmentAttemptFactory extends Factory
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
            'assessment_id' => Assessment::factory(),
            'request_key' => fake()->uuid(),
            'score_percent' => 0,
            'passed' => false,
        ];
    }
}
