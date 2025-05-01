<?php

namespace App\Livewire\Curso;

use App\Models\Curso;
use App\Models\CursoCategoria;
use Livewire\Component;
use Livewire\WithPagination;

class CursoManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $categoria = '';
    public $nivel = '';
    public $orden = 'recientes';

    public function render()
    {
        $query = Curso::query()
            ->where('estado', 'publicado')
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoria, function ($query) {
                $query->where('categoria_id', $this->categoria);
            })
            ->when($this->nivel, function ($query) {
                $query->where('nivel', $this->nivel);
            });

        switch ($this->orden) {
            case 'recientes':
                $query->latest();
                break;
            case 'antiguos':
                $query->oldest();
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'estudiantes':
                $query->orderBy('conteo_estudiantes', 'desc');
                break;
        }

        $cursos = $query->paginate(12);

        return view('livewire.curso.gestion-cursos', [
            'cursos' => $cursos,
            'categorias' => CursoCategoria::all(),
        ]);
    }
}
