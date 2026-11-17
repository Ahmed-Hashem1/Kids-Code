<?php

namespace Database\Factories;

use App\Models\ChildBadge;
use App\Models\Badge;
use App\Models\Child;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChildBadge>
 */
class ChildBadgeFactory extends Factory
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
            'badge_id' => Badge::factory(),
            'earned_at' => now(),
        ];
    }
}
