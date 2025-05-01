<?php

namespace Database\Factories\Curso;

use App\Models\Curso\CategoriaCurso;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = CategoriaCurso::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word,
            'descripcion' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'imagen' => $this->faker->imageUrl(640, 480, 'business', true),
        ];
    }
}
