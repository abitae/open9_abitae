<?php

namespace Database\Seeders;

use App\Models\Blog\Comment;
use App\Models\Blog\Media;
use App\Models\Blog\Post;
use App\Models\Blog\PostImage;
use App\Models\Blog\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Abel Arana',
            'email' => 'abel.arana@hotmail.com',
            'password' => Hash::make('lobomalo123'),
        ]);

        // Create sample blog posts with tags, comments, and media
        $user = User::first();
        
        // Create tags
        $tags = Tag::factory(10)->create();
        
        // Create posts with relationships
        Post::factory(20)
            ->create(['user_id' => $user->id])
            ->each(function ($post) use ($tags, $user) {
                // Attach random tags to each post (between 1-4 tags)
                $post->tags()->attach(
                    $tags->random(rand(1, 4))->pluck('id')->toArray()
                );
                
                // Add 0-5 comments to each post
                Comment::factory(rand(0, 5))
                    ->create([
                        'post_id' => $post->id,
                        'user_id' => $user->id,
                    ]);
                
                // Add 0-3 media items to each post
                PostImage::factory(rand(0, 3))
                    ->create([
                        'post_id' => $post->id,
                    ]);
            });
    }
}
