<?php

namespace Database\Factories\Curso;

use App\Models\Curso\Seccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeccionFactory extends Factory
{
    protected $model = Seccion::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(2),
            'descripcion' => $this->faker->paragraph(2),
            'orden' => $this->faker->numberBetween(1, 10),
        ];
    }
}
