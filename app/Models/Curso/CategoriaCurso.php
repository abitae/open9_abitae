<?php

namespace App\Models\Curso;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaCurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'slug',
        'imagen'
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
