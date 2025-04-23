<?php

namespace App\Livewire\Blog;

use App\Models\Blog\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CategoryBlog extends Component
{
    use WithFileUploads;

    public $categories;
    public $name;
    public $description;
    public $image;
    public $color;
    public $is_active = true;
    public $category_id;
    public $showModal = false;
    public $modalTitle = '';
    public $modalAction = '';

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'image' => 'nullable|image|max:2048',
        'color' => 'required|string|max:7',
        'is_active' => 'boolean'
    ];

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::all();
    }

    public function openModal($action, $id = null)
    {
        $this->resetForm();
        $this->modalAction = $action;

        if ($action === 'create') {
            $this->modalTitle = 'Crear Categoría';
        } elseif ($action === 'edit') {
            $this->modalTitle = 'Editar Categoría';
            $this->category_id = $id;
            $this->loadCategoryData();
        }

        $this->showModal = true;
    }

    public function loadCategoryData()
    {
        $category = Category::find($this->category_id);
        $this->name = $category->name;
        $this->description = $category->description;
        $this->color = $category->color;
        $this->is_active = $category->is_active;
    }

    public function resetForm()
    {
        $this->reset(['name', 'description', 'image', 'color', 'is_active', 'category_id']);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
            'is_active' => $this->is_active,
            'slug' => Str::slug($this->name)
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('categories', 'public');
        }

        if ($this->modalAction === 'create') {
            Category::create($data);
            session()->flash('message', 'Categoría creada exitosamente.');
        } else {
            $category = Category::find($this->category_id);
            $category->update($data);
            session()->flash('message', 'Categoría actualizada exitosamente.');
        }

        $this->closeModal();
        $this->loadCategories();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            session()->flash('message', 'Categoría eliminada exitosamente.');
            $this->loadCategories();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.blog.category-blog');
    }
}
