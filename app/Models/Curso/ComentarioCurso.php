<?php

namespace App\Models\Curso;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioCurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenido',
        'rating',
        'user_id',
        'curso_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
