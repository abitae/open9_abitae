<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostVideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'file_name' => fake()->word() . '.mp4',
            'file_path' => 'media/posts/' . fake()->numberBetween(1, 100) . '/videos/' . fake()->word() . '.mp4',
            'mime_type' => fake()->randomElement(['video/mp4', 'video/quicktime', 'video/x-msvideo']),
            'disk' => 'public',
            'size' => fake()->numberBetween(10000000, 50000000),
            'duration' => fake()->time('H:i:s'),
            'post_id' => Post::factory(),
        ];
    }
}
