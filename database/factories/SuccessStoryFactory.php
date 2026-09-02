<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SuccessStoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image' => 'site/success-stories/'.$this->faker->uuid().'.webp',
            'location' => $this->faker->city(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'sort_order' => $this->faker->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
