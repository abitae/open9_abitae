<?php

namespace App\Livewire\Blog;

use App\Models\Blog\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class TagBlog extends Component
{
    public $tags;
    public $name;
    public $description;
    public $tag_id;
    public $showModal = false;
    public $modalTitle = '';
    public $modalAction = '';

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000'
    ];

    public function mount()
    {
        $this->loadTags();
    }

    public function loadTags()
    {
        $this->tags = Tag::all();
    }

    public function openModal($action, $id = null)
    {
        $this->resetForm();
        $this->modalAction = $action;

        if ($action === 'create') {
            $this->modalTitle = 'Crear Etiqueta';
        } elseif ($action === 'edit') {
            $this->modalTitle = 'Editar Etiqueta';
            $this->tag_id = $id;
            $this->loadTagData();
        }

        $this->showModal = true;
    }

    public function loadTagData()
    {
        $tag = Tag::find($this->tag_id);
        $this->name = $tag->name;
        $this->description = $tag->description;
    }

    public function resetForm()
    {
        $this->reset(['name', 'description', 'tag_id']);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'slug' => Str::slug($this->name)
        ];

        if ($this->modalAction === 'create') {
            Tag::create($data);
            session()->flash('message', 'Etiqueta creada exitosamente.');
        } else {
            $tag = Tag::find($this->tag_id);
            $tag->update($data);
            session()->flash('message', 'Etiqueta actualizada exitosamente.');
        }

        $this->closeModal();
        $this->loadTags();
    }

    public function delete($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            session()->flash('message', 'Etiqueta eliminada exitosamente.');
            $this->loadTags();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.blog.tag-blog');
    }
}
