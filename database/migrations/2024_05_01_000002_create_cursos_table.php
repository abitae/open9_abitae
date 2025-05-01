<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->integer('duracion')->nullable(); // en minutos
            $table->enum('nivel', ['principiante', 'intermedio', 'avanzado']);
            $table->string('idioma');
            $table->foreignId('instructor_id')->constrained('users');
            $table->foreignId('categoria_id')->constrained('categoria_cursos');
            $table->enum('estado', ['borrador', 'publicado', 'archivado'])->default('borrador');
            $table->string('imagen_portada')->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('total_estudiantes')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos');
    }
};
