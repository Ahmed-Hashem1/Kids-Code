<?php

namespace Database\Factories;

use App\Models\Assessment;
use App\Models\Level;
use App\Models\PathVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Assessment>
 */
class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path_version_id' => PathVersion::factory(),
            'level_id' => Level::factory(),
            'kind' => 'level_end',
            'pass_percent' => 80,
        ];
    }
}
