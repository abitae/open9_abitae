<?php

namespace App\Livewire\Blog;

use App\Models\Blog\Post;
use App\Models\Blog\Category;
use App\Models\Blog\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PostManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $category_id = '';
    public $status = '';
    public $selectedPost = null;
    public $showCommentsModal = false;
    public $newComment = '';
    public $replyToComment = null;

    protected $rules = [
        'newComment' => 'required|min:3|max:1000',
    ];

    protected $listeners = ['commentAdded' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Post::with(['category', 'tags'])
            ->latest();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return view('livewire.blog.post-management', [
            'posts' => $query->paginate(10),
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
                ]);
            } elseif ($post->status === 'draft') {
                $post->update([
                    'status' => 'published',
                ]);
            } elseif ($post->status === 'archived') {
                $post->update([
                    'status' => 'published',
                ]);
            }
        }
    }

    public function showComments($postId)
    {
        $this->selectedPost = Post::with(['comments' => function($query) {
            $query->with(['user', 'replies.user'])
                  ->whereNull('parent_id')
                  ->orderBy('created_at', 'desc');
        }])->findOrFail($postId);

        $this->showCommentsModal = true;
    }

    public function addComment()
    {
        $this->validate();

        try {
            $comment = $this->selectedPost->comments()->create([
                'content' => $this->newComment,
                'user_id' => Auth::id(),
                'parent_id' => $this->replyToComment,
                'status' => 'approved'
            ]);

            $this->reset(['newComment', 'replyToComment']);
            $this->selectedPost->refresh();
            $this->emit('commentAdded');

            session()->flash('message', 'Comentario agregado exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al agregar el comentario.');
        }
    }

    public function replyTo($commentId)
    {
        $this->replyToComment = $commentId;
        $this->emit('focusCommentInput');
    }

    public function cancelReply()
    {
        $this->replyToComment = null;
    }

    public function closeCommentsModal()
    {
        $this->reset(['showCommentsModal', 'selectedPost', 'newComment', 'replyToComment']);
    }
}
