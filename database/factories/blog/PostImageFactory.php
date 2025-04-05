<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'file_name' => fake()->word() . '.jpg',
            'file_path' => 'https://www.colombianosune.com/sites/default/files/asociaciones/NO_disponible-43_15.jpg',
            'mime_type' => fake()->randomElement(['image/jpeg', 'image/png', 'image/gif']),
            'disk' => 'public',
            'size' => fake()->numberBetween(1000, 10000000),
            'post_id' => Post::factory(),
        ];
    }
}
