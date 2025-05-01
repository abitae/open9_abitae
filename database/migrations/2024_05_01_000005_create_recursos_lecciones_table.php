<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recursos_lecciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo', ['archivo', 'enlace', 'documento']);
            $table->string('url');
            $table->foreignId('leccion_id')->constrained('leccions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recursos_lecciones');
    }
};
