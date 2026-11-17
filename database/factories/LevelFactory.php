<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\PathVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Level>
 */
class LevelFactory extends Factory
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
            'title' => fake()->words(2, true),
            'position' => fake()->unique()->numberBetween(1, 100),
        ];
    }
}
