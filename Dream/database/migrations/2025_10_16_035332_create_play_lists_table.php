<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('play_lists', function (Blueprint $table) {
            $table->id('id_playlist');
            $table->unsignedBigInteger('id_usuario'); // Cambia esto
            $table->string('nombre', 100);
            $table->integer('temporizador')->default(60);
            $table->date('fecha_creacion');
            $table->timestamps();

            // Define la FK manualmente especificando las columnas
            $table->foreign('id_usuario')
                  ->references('id_usuario')  // Referencia a id_usuario
                  ->on('usuario')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('play_lists', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });
        
        Schema::dropIfExists('play_lists');
    }
};