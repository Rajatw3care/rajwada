<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category' => $this->faker->randomElement(['gallery', 'testimonial']),
            'thumbnail' => 'site/videos/'.$this->faker->uuid().'.webp',
            'title' => $this->faker->sentence(3),
            'tag' => $this->faker->words(2, true),
            'duration' => '03:24',
            'video_url' => 'https://www.youtube.com/watch?v='.$this->faker->uuid(),
            'sort_order' => $this->faker->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
