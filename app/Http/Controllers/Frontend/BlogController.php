<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        $tags = Tag::all();
        $posts = Post::where('status', 'published')->paginate(6);
        $categories = Category::all();
        return view('frontend.blog', compact('posts', 'tags', 'categories'));
    }

    public function post(Post $post)
    {
        return view('frontend.post', compact('post'));
    }

    public function postDetails(Post $post)
    {
        return view('frontend.blog-detalle', compact('post'));
    }
}
