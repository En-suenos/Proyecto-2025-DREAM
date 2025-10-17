<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistente_ia', function (Blueprint $table) {
            $table->id('id_sugerencia');
            $table->unsignedBigInteger('id_usuario');
            $table->text('sugerencia');
            $table->dateTime('fecha_generacion');
            $table->boolean('leida')->default(false);
            $table->timestamps();

            // Foreign key
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('asistente_ia', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });
        
        Schema::dropIfExists('asistente_ia');
    }
};