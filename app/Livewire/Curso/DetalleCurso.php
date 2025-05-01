<?php

namespace App\Livewire\Curso;

use App\Models\Curso\Curso;
use Livewire\Component;

class DetalleCurso extends Component
{
    public $curso;
    public $rating = 0;
    public $comentario = '';

    public function mount(Curso $curso)
    {
        $this->curso = $curso;
    }

    public function inscribirse()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->curso->estudiantes()->attach(auth()->id(), [
            'fecha_inscripcion' => now(),
            'progreso' => 0
        ]);

        $this->curso->increment('total_estudiantes');
        session()->flash('message', 'Te has inscrito exitosamente al curso.');
    }

    public function enviarComentario()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'required|min:10',
        ]);

        $this->curso->comentarios()->create([
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'contenido' => $this->comentario,
        ]);

        $this->reset(['rating', 'comentario']);
        session()->flash('message', 'Tu comentario ha sido publicado.');
    }

    public function render()
    {
        return view('livewire.curso.detalle-curso');
    }
}
