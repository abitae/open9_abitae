<?php

namespace App\Models\Curso;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'orden',
        'curso_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function lecciones()
    {
        return $this->hasMany(Leccion::class);
    }
}
