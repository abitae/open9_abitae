<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\PostImage;
use App\Models\Blog\PostVideo;
use App\Models\Blog\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraphs(5, true),
            'excerpt' => fake()->paragraph(),
            'status' => fake()->randomElement(['draft', 'published', 'archived']),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'is_active' => fake()->boolean(),
        ];
    }

}
