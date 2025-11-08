<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // auto_increment primary key
            $table->string('nombre', 100);
            $table->string('correo', 150)->unique();
            $table->string('contraseña', 255);
            $table->string('nombre_cuenta', 200)->unique();
            $table->enum('tipo_usuario', ['free', 'premium', 'admin'])->default('free');
            $table->softDeletes(); // Para eliminaciones
            $table->timestamps(); // Para created_at 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

