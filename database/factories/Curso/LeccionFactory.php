<?php

namespace Database\Factories\Curso;

use App\Models\Curso\Leccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeccionFactory extends Factory
{
    protected $model = Leccion::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph(2),
            'contenido' => $this->faker->paragraphs(3, true),
            'url_video' => 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9]{11}'),
            'duracion' => $this->faker->numberBetween(5, 60),
            'orden' => $this->faker->numberBetween(1, 20),
            'tipo' => $this->faker->randomElement(['video', 'texto', 'quiz']),
            'estado' => $this->faker->randomElement(['publicado', 'borrador']),
        ];
    }
}
