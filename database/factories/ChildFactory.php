<?php

namespace Database\Factories;

use App\Models\Child;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Child>
 */
class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'child_user_id' => User::factory()->child(),
            'parent_user_id' => User::factory()->parent(),
            'display_name' => fake()->firstName(),
            'age_group' => fake()->randomElement(['7-9', '10-12', '13-15']),
            'avatar' => 'avatar-'.fake()->numberBetween(1, 8).'.png',
        ];
    }
}
