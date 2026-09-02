<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'icon' => 'site/services/'.$this->faker->uuid().'.webp',
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'overview_image' => null,
            'overview_description' => null,
            'sort_order' => $this->faker->numberBetween(0, 20),
            'is_active' => true,
            'show_on_homepage' => true,
        ];
    }
}
