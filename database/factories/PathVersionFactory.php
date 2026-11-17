<?php

namespace Database\Factories;

use App\Models\PathVersion;
use App\Models\Pathway;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PathVersion>
 */
class PathVersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pathway_id' => Pathway::factory(),
            'version_no' => fake()->numberBetween(1, 5),
            'status' => 'draft',
            'published_at' => null,
        ];
    }
}
