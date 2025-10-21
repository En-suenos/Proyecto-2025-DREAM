<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sonidos', function (Blueprint $table) {
            $table->id('id_sonido');
            $table->string('nombre', 100);
            $table->enum('categoria', ['naturaleza', 'meditacion', 'urbano', 'blanco', 'instrumental']);
            $table->string('archivo_audio', 255);
            $table->double('duracion')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            // Índices
            $table->index('categoria');
            $table->index('activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sonidos');
    }
};