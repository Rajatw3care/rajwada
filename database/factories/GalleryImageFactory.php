<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image' => 'site/gallery/'.$this->faker->uuid().'.webp',
            'alt_text' => $this->faker->sentence(4),
            'title' => $this->faker->words(3, true),
            'category' => $this->faker->randomElement(['royal', 'destination', 'haldi', 'mehendi', 'sangeet', 'reception']),
            'sort_order' => $this->faker->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
