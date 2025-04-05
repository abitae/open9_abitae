<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'content' => fake()->paragraph(),
            'post_id' => Post::factory(),
            'user_id' => User::factory(),
            'parent_id' => null,
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Comment $comment) {
            // 30% chance to have replies
            if (fake()->boolean(30)) {
                Comment::factory()
                    ->count(rand(1, 3))
                    ->create([
                        'post_id' => $comment->post_id,
                        'parent_id' => $comment->id,
                    ]);
            }
        });
    }
}
