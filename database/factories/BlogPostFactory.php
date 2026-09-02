<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(5);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::random(5),
            'image' => 'site/blog/'.$this->faker->uuid().'.webp',
            'venue' => $this->faker->city(),
            'excerpt' => $this->faker->sentence(12),
            'body' => '<p>'.$this->faker->paragraph().'</p>',
            'category' => $this->faker->randomElement(['Real Weddings', 'Planning Tips', 'Décor Trends']),
            'tags' => 'Mehendi, Sangeet, Décor',
            'sort_order' => $this->faker->numberBetween(0, 20),
            'is_active' => true,
            'is_featured' => false,
            'published_at' => now(),
        ];
    }
}
