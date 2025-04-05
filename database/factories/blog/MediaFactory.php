<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    public function definition(): array
    {
        $type = fake()->randomElement(['image', 'video']);
        $mimeType = $type === 'image'
            ? fake()->randomElement(['image/jpeg', 'image/png', 'image/gif'])
            : fake()->randomElement(['video/mp4', 'video/quicktime', 'video/x-msvideo']);

        return [
            'file_name' => fake()->word() . '.' . ($type === 'image' ? 'jpg' : 'mp4'),
            'file_path' => 'https://www.colombianosune.com/sites/default/files/asociaciones/NO_disponible-43_15.jpg',
            'mime_type' => $mimeType,
            'type' => $type,
            'disk' => 'public',
            'size' => fake()->numberBetween(1000, 10000000),
            'post_id' => Post::factory(),
        ];
    }
}
