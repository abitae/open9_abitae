<?php

namespace App\Livewire\Curso;

use App\Models\Curso\Curso;
use App\Models\Curso\Categoria;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CursoForm extends Component
{
    use WithFileUploads;

    public $curso;
    public $titulo;
    public $descripcion;
    public $precio;
    public $nivel;
    public $idioma;
    public $categoria_id;
    public $imagen_portada;
    public $estado = 'borrador';

    protected $rules = [
        'titulo' => 'required|min:3',
        'descripcion' => 'required|min:10',
        'precio' => 'required|numeric|min:0',
        'nivel' => 'required|in:principiante,intermedio,avanzado',
        'idioma' => 'required',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen_portada' => 'nullable|image|max:2048',
        'estado' => 'required|in:borrador,publicado,archivado',
    ];

    public function mount(?Curso $curso = null)
    {
        $this->curso = $curso;
        if ($curso && $curso->exists) {
            $this->titulo = $curso->titulo;
            $this->descripcion = $curso->descripcion;
            $this->precio = $curso->precio;
            $this->nivel = $curso->nivel;
            $this->idioma = $curso->idioma;
            $this->categoria_id = $curso->categoria_id;
            $this->estado = $curso->estado;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'nivel' => $this->nivel,
            'idioma' => $this->idioma,
            'categoria_id' => $this->categoria_id,
            'estado' => $this->estado,
            'instructor_id' => Auth::user()->id,
        ];

        if ($this->imagen_portada) {
            $data['imagen_portada'] = $this->imagen_portada->store('cursos', 'public');
        }

        if ($this->curso->exists) {
            $this->curso->update($data);
            session()->flash('message', 'Curso actualizado exitosamente.');
        } else {
            Curso::create($data);
            session()->flash('message', 'Curso creado exitosamente.');
        }

        return redirect()->route('cursos.index');
    }

    public function render()
    {
        return view('livewire.curso.formulario-curso', [
            'categorias' => Categoria::all(),
        ]);
    }
}
