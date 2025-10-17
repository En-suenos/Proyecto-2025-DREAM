<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detector_facial', function (Blueprint $table) {
            $table->id('id_detector');
            $table->unsignedBigInteger('id_usuario');
            $table->enum('estado_detectado', ['despierto', 'dormido_ligero', 'dormido_profundo', 'REM']);
            $table->dateTime('fecha_deteccion');
            $table->double('confianza');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');

            // Índices para búsquedas por fecha
            $table->index('fecha_deteccion');
            $table->index('estado_detectado');
        });
    }

    public function down(): void
    {
        Schema::table('detector_facial', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });
        
        Schema::dropIfExists('detector_facial');
    }
};