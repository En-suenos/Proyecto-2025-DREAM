<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('suscripciones')) {
            Schema::create('suscripciones', function (Blueprint $table) {
                $table->id('id_suscripcion');
                $table->unsignedBigInteger('id_usuario');
                $table->enum('tipo_plan', ['mensual', 'anual', 'vitalicio']);
                $table->date('fecha_inicio');
                $table->date('fecha_fin');
                $table->boolean('activa')->default(true);
                $table->timestamps();

                $table->foreign('id_usuario')
                      ->references('id_usuario')
                      ->on('usuario')
                      ->onDelete('cascade');

                $table->index('activa');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('suscripciones');
    }
};