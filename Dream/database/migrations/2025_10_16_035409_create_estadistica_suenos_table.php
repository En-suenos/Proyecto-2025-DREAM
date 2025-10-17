<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estadisticas_sueno', function (Blueprint $table) {
            $table->id('id_estadistica');
            $table->unsignedBigInteger('id_usuario');
            $table->enum('periodo', ['diario', 'semanal', 'mensual', 'anual']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->double('promedio_horas');
            $table->double('calidad_promedio');
            $table->integer('dias_registrados');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');

            // Índices para búsquedas
            $table->index('periodo');
            $table->index('fecha_inicio');
            $table->index('fecha_fin');
        });
    }

    public function down(): void
    {
        Schema::table('estadisticas_sueno', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });
        
        Schema::dropIfExists('estadisticas_sueno');
    }
};