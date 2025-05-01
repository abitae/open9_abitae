<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leccions', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->text('contenido')->nullable();
            $table->string('url_video');
            $table->integer('duracion')->nullable(); // en minutos
            $table->integer('orden');
            $table->foreignId('seccion_id')->constrained('seccions')->onDelete('cascade');
            $table->enum('tipo', ['video', 'texto', 'quiz'])->default('video');
            $table->enum('estado', ['publicado', 'borrador'])->default('borrador');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leccions');
    }
};
