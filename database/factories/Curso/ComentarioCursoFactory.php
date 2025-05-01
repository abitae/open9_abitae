<?php

namespace Database\Factories\Curso;

use App\Models\Curso\ComentarioCurso;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioCursoFactory extends Factory
{
    protected $model = ComentarioCurso::class;

    public function definition(): array
    {
        return [
            'contenido' => $this->faker->paragraph(3),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
