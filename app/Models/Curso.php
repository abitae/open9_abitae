<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'duracion',
        'nivel',
        'idioma',
        'instructor_id',
        'categoria_id',
        'estado',
        'imagen_principal',
        'rating',
        'conteo_estudiantes'
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function categoria()
    {
        return $this->belongsTo(CursoCategoria::class, 'categoria_id');
    }
}
