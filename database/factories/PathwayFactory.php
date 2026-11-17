<?php

namespace Database\Factories;

use App\Models\Pathway;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pathway>
 */
class PathwayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'age_group' => fake()->randomElement(['7-9', '10-12', '13-15']),
            'title' => fake()->sentence(3),
            'slug' => fake()->unique()->slug(),
        ];
    }
}
