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
            $table->double('duracion');
            $table->unsignedBigInteger('id_usuario_creador');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            // Foreign key
            $table->foreign('id_usuario_creador')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');

            // Índices
            $table->index('categoria');
            $table->index('activo');
        });
    }

    public function down(): void
    {
        Schema::table('sonidos', function (Blueprint $table) {
            $table->dropForeign(['id_usuario_creador']);
        });
        
        Schema::dropIfExists('sonidos');
    }
};