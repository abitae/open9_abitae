<?php

namespace App\Livewire\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PostForm extends Component
{
    use WithFileUploads;

    public Post $post;
    public $title = '';
    public $content = '';
    public $excerpt = '';
    public $status = 'draft';
    public $category_id = '';
    public $selectedTags = [];
    public $image = null;
    public $video = null;
    public $isEditing = false;

    public function mount($id = null)
    {
        if ($id) {
            $post = Post::find($id);
            $this->post = $post;
            $this->isEditing = true;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->excerpt = $post->excerpt;
            $this->status = $post->status;
            $this->category_id = $post->category_id;
            $this->selectedTags = $post->tags->pluck('id')->toArray();
        }
    }

    public function save()
    {
        $rules = [
            'title' => 'required|min:3',
            'content' => 'required|min:10',
            'excerpt' => 'nullable|max:255',
            'status' => 'required|in:draft,published,archived',
            'category_id' => 'required|exists:categories,id',
            'selectedTags' => 'array',
            'image' => 'nullable|image|max:10240', // 10MB max
            'video' => 'nullable|mimes:mp4,mov,avi|max:51200', // 50MB max
        ];
        $messages = [
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 3 characters',
            'content.required' => 'Content is required',
            'content.min' => 'Content must be at least 10 characters',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Invalid category selected',
            'selectedTags.array' => 'Invalid tags selected',
            'image.image' => 'Invalid image file',
            'image.max' => 'Image file size must be less than 10MB',
            'video.mimes' => 'Invalid video file type',
            'video.max' => 'Video file size must be less than 50MB',
        ];
        $this->validate($rules, $messages);

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'user_id' => Auth::user()->id,
        ];

        if ($this->isEditing) {
            $this->post->update($data);
        } else {
            $this->post = Post::create($data);
        }

        // Handle tags
        $this->post->tags()->sync($this->selectedTags);

        // Handle image upload
        if ($this->image) {
            $path = $this->image->store('media/posts/' . $this->post->id . '/images', 'public');
            $this->post->images()->create([
                'file_name' => $this->image->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $this->image->getMimeType(),
                'size' => $this->image->getSize(),
            ]);
        }

        // Handle video upload
        if ($this->video) {
            $path = $this->video->store('media/posts/' . $this->post->id . '/videos', 'public');
            $this->post->videos()->create([
                'file_name' => $this->video->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $this->video->getMimeType(),
                'size' => $this->video->getSize(),
            ]);
        }
        return redirect()->route('admin.blog');
    }

    public function render()
    {
        return view('livewire.blog.post-form', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }
}
