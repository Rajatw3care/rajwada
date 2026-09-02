<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'avatar' => 'site/testimonials/'.$this->faker->uuid().'.webp',
            'message' => $this->faker->paragraph(),
            'event_label' => $this->faker->words(3, true),
            'rating' => 5,
            'sort_order' => $this->faker->numberBetween(0, 20),
            'is_active' => true,
            'is_featured' => false,
        ];
    }
}
