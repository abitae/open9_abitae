<?php

namespace App\Models\Curso;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'contenido',
        'url_video',
        'duracion',
        'orden',
        'seccion_id',
        'tipo',
        'estado'
    ];

    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }

    public function recursos()
    {
        return $this->hasMany(RecursoLeccion::class);
    }
}
