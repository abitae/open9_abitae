<?php

namespace Database\Factories\Curso;

use App\Models\Curso\RecursoLeccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecursoLeccionFactory extends Factory
{
    protected $model = RecursoLeccion::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence(2),
            'tipo' => $this->faker->randomElement(['archivo', 'enlace', 'documento']),
            'url' => $this->faker->url,
        ];
    }
}
