<?php

namespace App\Models\Curso;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoLeccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'url',
        'leccion_id'
    ];

    public function leccion()
    {
        return $this->belongsTo(Leccion::class);
    }
}
