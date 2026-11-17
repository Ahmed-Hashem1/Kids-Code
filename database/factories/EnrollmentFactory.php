<?php

namespace Database\Factories;

use App\Models\Enrollment;
use App\Models\Child;
use App\Models\PathVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'child_id' => Child::factory(),
            'path_version_id' => PathVersion::factory(),
            'start_level_id' => null,
            'xp_total' => 0,
            'last_activity_at' => null,
            'completed_at' => null,
        ];
    }
}
