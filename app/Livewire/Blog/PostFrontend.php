<?php

namespace App\Livewire\Blog;

use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostFrontend extends Component
{
    public $post;
    public $content;
    public $replyTo;
    public function mount($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $post = $this->post;
        $featuredPosts = Post::with(['user', 'category'])
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
        return view('livewire.blog.post-frontend', compact('post', 'featuredPosts'));
    }
    public function saveComment()
    {
        $this->validate([
            'content' => 'required|string|max:255',
        ]);
        $comment = new Comment();
        $comment->content = $this->content;
        $comment->post_id = $this->post->id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        $this->reset('content');
    }
    public function saveReply()
    {
        $this->validate([
            'content' => 'required|string|max:255',
        ]);
        $reply = new Comment();
        $reply->content = $this->content;
        $reply->post_id = $this->post->id;
        $reply->user_id = Auth::user()->id;
        $reply->parent_id = $this->replyTo;
        $reply->save();
        $this->reset('content');
        $this->redirect(route('frontend.post', $this->post->slug));
    }
}
