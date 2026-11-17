<?php

namespace Database\Factories;

use App\Models\AssessmentAnswer;
use App\Models\AssessmentAttempt;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AssessmentAnswer>
 */
class AssessmentAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attempt_id' => AssessmentAttempt::factory(),
            'question_id' => Question::factory(),
            'option_id' => Option::factory(),
        ];
    }
}
