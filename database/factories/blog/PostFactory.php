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
            'published_at' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            // Attach random tags
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->get();
            $post->tags()->attach($tags);

            // Create random number of images
            if (fake()->boolean(80)) { // 80% chance to have images
                PostImage::factory()
                    ->count(rand(1, 5))
                    ->create(['post_id' => $post->id]);
            }

            // Create random number of videos
            if (fake()->boolean(30)) { // 30% chance to have videos
                PostVideo::factory()
                    ->count(rand(1, 2))
                    ->create(['post_id' => $post->id]);
            }
        });
    }
}
