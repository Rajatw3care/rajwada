<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingStatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'icon' => $this->faker->randomElement(['⭐', '🏆', '👑', '👨‍👩‍👧‍👦']),
            'number' => $this->faker->randomElement(['4.9/5', '500+', '50+', '10+']),
            'label' => $this->faker->words(3, true),
            'sort_order' => $this->faker->numberBetween(0, 20),
        ];
    }
}
