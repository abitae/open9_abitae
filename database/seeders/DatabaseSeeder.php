<?php

namespace Database\Seeders;

use App\Models\Blog\Category;
use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use App\Models\Blog\PostImage;
use App\Models\Blog\Tag;
use App\Models\Curso\Categoria;
use App\Models\Curso\CategoriaCurso;
use App\Models\Curso\Curso;
use App\Models\Curso\Leccion;
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

        Category::factory(10)->create();
        Tag::factory(10)->create();
        Post::factory(10)->create();

    }
}
