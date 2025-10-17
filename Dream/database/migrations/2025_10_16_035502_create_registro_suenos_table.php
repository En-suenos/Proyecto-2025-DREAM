<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registro_suenos', function (Blueprint $table) {
            $table->id('id_registro');
            $table->unsignedBigInteger('id_usuario');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_despertar');
            $table->double('duracion_total');
            $table->enum('calidad_sueno', ['mala', 'regular', 'buena', 'excelente']);
            $table->text('notas')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');

            // Índices para búsquedas frecuentes
            $table->index('fecha');
            $table->index('calidad_sueno');
        });
    }

    public function down(): void
    {
        Schema::table('registro_suenos', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });
        
        Schema::dropIfExists('registro_suenos');
    }
};