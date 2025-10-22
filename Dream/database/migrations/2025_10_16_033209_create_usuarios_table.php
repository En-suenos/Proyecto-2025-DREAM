<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario'); // Equivale a auto_increment primary key
            $table->string('nombre', 100);
            $table->string('correo', 150)->unique();
            $table->string('contraseña', 255);
            $table->enum('tipo_usuario', ['free', 'premium', 'admin']);
            $table->date('fecha_registro');
            $table->softDeletes(); // Para eliminaciones lógicas
            $table->timestamps(); // Opcional: para created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};