<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('playlist_sonido', function (Blueprint $table) {
            $table->id('id_playlist_sonido');
            $table->unsignedBigInteger('id_playlist');
            $table->unsignedBigInteger('id_sonido');
            $table->integer('volumen_playlist')->default(80);
            $table->integer('orden');
            $table->timestamps();

            // Foreign keys corregidas
            $table->foreign('id_playlist')
                  ->references('id_playlist')  // Referencia a id_playlist
                  ->on('play_lists')
                  ->onDelete('cascade');

            $table->foreign('id_sonido')
                  ->references('id_sonido')    // Referencia a id_sonido
                  ->on('sonidos')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('playlist_sonido', function (Blueprint $table) {
            $table->dropForeign(['id_playlist']);
            $table->dropForeign(['id_sonido']);
        });
        
        Schema::dropIfExists('playlist_sonido');
    }
};