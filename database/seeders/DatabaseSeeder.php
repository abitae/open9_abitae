<?php

namespace Database\Seeders;

use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use App\Models\Blog\PostImage;
use App\Models\Blog\Tag;
use App\Models\Curso\Categoria;
use App\Models\Curso\CategoriaCurso;
use App\Models\Curso\Curso;
use App\Models\Curso\Leccion;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Abel Arana',
            'email' => 'abel.arana@hotmail.com',
            'password' => Hash::make('lobomalo123'),
        ]);

        // Crear categorías
        $categorias = [
            ['nombre' => 'Desarrollo Web', 'descripcion' => 'Cursos de desarrollo web frontend y backend', 'slug' => 'desarrollo-web', 'imagen' => 'desarrollo-web.jpg'],
            ['nombre' => 'Programación', 'descripcion' => 'Cursos de programación en diferentes lenguajes', 'slug' => 'programacion', 'imagen' => 'programacion.jpg'],
            ['nombre' => 'Diseño UX/UI', 'descripcion' => 'Cursos de diseño de experiencia de usuario e interfaces', 'slug' => 'diseno-ux-ui', 'imagen' => 'diseno-ux-ui.jpg'],
            ['nombre' => 'Marketing Digital', 'descripcion' => 'Cursos de marketing en plataformas digitales', 'slug' => 'marketing-digital', 'imagen' => 'marketing-digital.jpg'],
            ['nombre' => 'Inteligencia Artificial', 'descripcion' => 'Cursos de IA y machine learning', 'slug' => 'inteligencia-artificial', 'imagen' => 'ia.jpg'],
        ];

        foreach ($categorias as $categoria) {
            CategoriaCurso::create($categoria);
        }

        // Crear instructor
        $instructor = User::factory()->create([
            'name' => 'Instructor Demo',
            'email' => 'instructor@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Crear 5 cursos con sus relaciones
        $cursos = [
            [
                'titulo' => 'Desarrollo Web con Laravel',
                'descripcion' => 'Aprende a desarrollar aplicaciones web con Laravel desde cero',
                'precio' => 49.99,
                'duracion' => 60,
                'nivel' => 'Intermedio',
                'idioma' => 'Español',
                'instructor_id' => $instructor->id,
                'categoria_id' => 1,
                'estado' => 'publicado',
                'imagen_portada' => 'laravel-curso.jpg',
                'rating' => 4.8,
                'total_estudiantes' => 120
            ],
            [
                'titulo' => 'JavaScript Avanzado',
                'descripcion' => 'Domina JavaScript y sus frameworks modernos',
                'precio' => 39.99,
                'duracion' => 60,
                'nivel' => 'Avanzado',
                'idioma' => 'Español',
                'instructor_id' => $instructor->id,
                'categoria_id' => 2,
                'estado' => 'publicado',
                'imagen_portada' => 'javascript-curso.jpg',
                'rating' => 4.5,
                'total_estudiantes' => 85
            ],
            [
                'titulo' => 'Diseño UX/UI con Figma',
                'descripcion' => 'Crea interfaces de usuario atractivas y funcionales',
                'precio' => 29.99,
                'duracion' => 60,
                'nivel' => 'Principiante',
                'idioma' => 'Español',
                'instructor_id' => $instructor->id,
                'categoria_id' => 3,
                'estado' => 'publicado',
                'imagen_portada' => 'figma-curso.jpg',
                'rating' => 4.7,
                'total_estudiantes' => 95
            ],
            [
                'titulo' => 'Marketing en Redes Sociales',
                'descripcion' => 'Estrategias efectivas para promocionar tu negocio en redes sociales',
                'precio' => 34.99,
                'duracion' => 60,
                'nivel' => 'Intermedio',
                'idioma' => 'Español',
                'instructor_id' => $instructor->id,
                'categoria_id' => 4,
                'estado' => 'publicado',
                'imagen_portada' => 'marketing-curso.jpg',
                'rating' => 4.6,
                'total_estudiantes' => 150
            ],
            [
                'titulo' => 'Introducción a Machine Learning',
                'descripcion' => 'Fundamentos de machine learning y sus aplicaciones',
                'precio' => 59.99,
                'duracion' => 60,
                'nivel' => 'Avanzado',
                'idioma' => 'Español',
                'instructor_id' => $instructor->id,
                'categoria_id' => 5,
                'estado' => 'publicado',
                'imagen_portada' => 'ml-curso.jpg',
                'rating' => 4.9,
                'total_estudiantes' => 75
            ],
        ];

        foreach ($cursos as $cursoData) {
            $curso = Curso::create($cursoData);

            // Crear secciones para cada curso
            for ($i = 1; $i <= 3; $i++) {
                $seccion = $curso->secciones()->create([
                    'titulo' => "Sección $i del curso " . $curso->titulo,
                    'descripcion' => "Descripción de la sección $i",
                    'orden' => $i
                ]);

                // Crear lecciones para cada sección
                for ($j = 1; $j <= 4; $j++) {
                    $leccion = $seccion->lecciones()->create([
                        'titulo' => "Lección $j de la sección $i",
                        'descripcion' => "Descripción de la lección $j",
                        'contenido' => "Contenido detallado de la lección $j",
                        'url_video' => "https://example.com/videos/curso{$curso->id}/seccion{$i}/leccion{$j}",
                        'duracion' => rand(5, 30),
                        'orden' => $j,
                        'tipo' => rand(0, 1) ? 'video' : 'texto',
                        'estado' => 'publicado'
                    ]);

                    // Crear recursos para cada lección
                    for ($k = 1; $k <= 2; $k++) {
                        $leccion->recursos()->create([
                            'nombre' => "Recurso $k para la lección $j",
                            'tipo' => rand(0, 1) ? 'pdf' : 'archivo',
                            'url' => "https://example.com/recursos/curso{$curso->id}/seccion{$i}/leccion{$j}/recurso{$k}.pdf"
                        ]);
                    }
                }
            }

            // Crear comentarios para cada curso
            for ($l = 1; $l <= 5; $l++) {
                $curso->comentarios()->create([
                    'contenido' => "Este curso es excelente, me ha ayudado mucho en mi carrera profesional.",
                    'rating' => rand(3, 5),
                    'user_id' => User::factory()->create()->id
                ]);
            }

            // Inscribir estudiantes al curso
            $estudiantes = User::factory(10)->create();
            foreach ($estudiantes as $estudiante) {
                $curso->estudiantes()->attach($estudiante->id, [
                    'progreso' => rand(0, 100),
                    'fecha_inscripcion' => now()->subDays(rand(1, 30))
                ]);
            }
        }

    }
}
