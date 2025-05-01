<?php

namespace Database\Factories\Curso;

use App\Models\Curso\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    protected $model = Curso::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph(3),
            'precio' => $this->faker->randomFloat(2, 0, 200),
            'duracion' => $this->faker->numberBetween(30, 600),
            'nivel' => $this->faker->randomElement(['principiante', 'intermedio', 'avanzado']),
            'idioma' => $this->faker->randomElement(['español', 'inglés']),
            'estado' => $this->faker->randomElement(['borrador', 'publicado', 'archivado']),
            'imagen_portada' => $this->faker->imageUrl(1280, 720, 'education', true),
            'rating' => $this->faker->randomFloat(1, 0, 5),
            'total_estudiantes' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
