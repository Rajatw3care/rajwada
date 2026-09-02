<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image' => 'site/destinations/'.$this->faker->uuid().'.webp',
            'name' => $this->faker->city(),
            'count_label' => $this->faker->numberBetween(3, 20).'+ Celebrations',
            'sort_order' => $this->faker->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
