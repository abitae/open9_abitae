<?php

namespace App\Models\Curso;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'precio',
        'duracion',
        'nivel',
        'idioma',
        'instructor_id',
        'categoria_id',
        'estado',
        'imagen_portada',
        'rating',
        'total_estudiantes'
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function secciones()
    {
        return $this->hasMany(Seccion::class);
    }

    public function estudiantes()
    {
        return $this->belongsToMany(User::class, 'curso_estudiante')
            ->withPivot('progreso', 'fecha_inscripcion')
            ->withTimestamps();
    }

    public function comentarios()
    {
        return $this->hasMany(ComentarioCurso::class);
    }
}
