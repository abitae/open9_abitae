<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comentarios_cursos', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->integer('rating');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comentarios_cursos');
    }
};
