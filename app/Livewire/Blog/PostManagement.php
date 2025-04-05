<?php

namespace App\Livewire\Blog;

use App\Models\Blog\Post;
use App\Models\Blog\Category;
use App\Models\Blog\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class PostManagement extends Component
{
    use WithPagination;


    public function render()
    {
        return view('livewire.blog.post-management', [
            'posts' => Post::with(['category', 'tags', 'images', 'videos'])
                ->latest()
                ->paginate(10),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }
    public function redirectToForm(Post $post)
    {
        return redirect()->route('admin.blog.form', $post);
    }
    public function delete($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->delete();
        }
    }

    public function publish($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            if ($post->status === 'published') {
                $post->update([
                    'status' => 'draft',
                    'published_at' => null,
                ]);
            } elseif ($post->status === 'draft') {
                $post->update([
                    'status' => 'published',
                    'published_at' => now(),
                ]);
            } elseif ($post->status === 'archived') {
                $post->update([
                    'status' => 'published',
                    'published_at' => now(),
                ]);
            }
        }
    }
}
