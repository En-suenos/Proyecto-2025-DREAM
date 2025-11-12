<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->json('sonidos')->nullable();
            $table->unsignedBigInteger('id_usuario')->notnull(); 
            $table->timestamps();

            // Foreign key 
            // $table->foreign('id')
            //       ->on('usuarios')
            //       ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('playlists');
    }
};