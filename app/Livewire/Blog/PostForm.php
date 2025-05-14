<?php

namespace App\Livewire\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
    public $image_path = null;
    public $video_path = null;
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
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB max
            'video_path' => 'nullable|mimes:mp4,mov,avi,webm|max:512000', // 500MB max
        ];
        $messages = [
            'title.required' => 'El título es requerido',
            'title.min' => 'El título debe tener al menos 3 caracteres',
            'content.required' => 'El contenido es requerido',
            'content.min' => 'El contenido debe tener al menos 10 caracteres',
            'category_id.required' => 'La categoría es requerida',
            'category_id.exists' => 'Categoría inválida seleccionada',
            'selectedTags.array' => 'Etiquetas inválidas seleccionadas',
            'image_path.image' => 'El archivo debe ser una imagen',
            'image_path.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o webp',
            'image_path.max' => 'El tamaño de la imagen debe ser menor a 10MB',
            'video_path.mimes' => 'El video debe ser de tipo: mp4, mov, avi o webm',
            'video_path.max' => 'El tamaño del video debe ser menor a 500MB',
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

        // Manejo de archivos
        if ($this->image_path) {
            // Eliminar imagen anterior si existe
            if ($this->post->image_path && Storage::disk('public')->exists($this->post->image_path)) {
                Storage::disk('public')->delete($this->post->image_path);
            }

            $imageName = time() . '_' . Str::slug(pathinfo($this->image_path->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $this->image_path->getClientOriginalExtension();
            $this->post->image_path = $this->image_path->storeAs('media/posts/' . $this->post->id . '/image', $imageName, 'public');
        }

        if ($this->video_path) {
            // Eliminar video anterior si existe
            if ($this->post->video_path && Storage::disk('public')->exists($this->post->video_path)) {
                Storage::disk('public')->delete($this->post->video_path);
            }

            $videoName = time() . '_' . Str::slug(pathinfo($this->video_path->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $this->video_path->getClientOriginalExtension();
            $this->post->video_path = $this->video_path->storeAs('media/posts/' . $this->post->id . '/video', $videoName, 'public');
        }
        
        $this->post->save();

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
