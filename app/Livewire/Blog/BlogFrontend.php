<?php

namespace App\Livewire\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class BlogFrontend extends Component
{
    use WithPagination;

    public $category_id;
    public $tag_id;
    public $search;

    protected $queryString = [
        'category_id' => ['except' => ''],
        'tag_id' => ['except' => ''],
        'search' => ['except' => '']
    ];

    public function render()
    {
        // Solo categorías con posts publicados
        $categories = Category::whereHas('posts', function (Builder $query) {
            $query->where('status', 'published');
        })->withCount(['posts' => function (Builder $query) {
            $query->where('status', 'published');
        }])->get();

        // Solo etiquetas con posts publicados
        $tags = Tag::whereHas('posts', function (Builder $query) {
            $query->where('status', 'published');
        })->get();

        // Últimos 3 comentarios con sus relaciones
        $comments = Comment::with(['user', 'post'])
            ->latest()
            ->take(3)
            ->get();

        // Consulta base de posts optimizada
        $postsQuery = Post::with(['user', 'category', 'tags'])
            ->where('status', 'published');

        if ($this->category_id) {
            $postsQuery->where('category_id', $this->category_id);
        }

        if ($this->tag_id) {
            $postsQuery->whereHas('tags', function ($query) {
                $query->where('tags.id', $this->tag_id);
            });
        }

        if ($this->search) {
            $postsQuery->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $this->search . '%');
            });
        }

        $posts = $postsQuery->latest()->paginate(6);

        // Artículos destacados (los 3 más recientes)
        $featuredPosts = Post::with(['user', 'category'])
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.blog.blog-frontend', [
            'categories' => $categories,
            'posts' => $posts,
            'tags' => $tags,
            'comments' => $comments,
            'featuredPosts' => $featuredPosts,
        ]);
    }

    public function tag($tagId)
    {
        $this->tag_id = $tagId;
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }
}
