<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // Nombre de la tabla
    protected $table = 'usuarios';

    // Clave primaria personalizada
    protected $primaryKey = 'id_usuario';

    // Campos asignables masivamente - OPCIÓN RECOMENDADA
    protected $fillable = [
        'nombre',
        'correo',
        'contraseña', 
        'tipo_usuario',
        'fecha_registro'
    ];

    // O usar guarded (pero es menos seguro)
    // protected $guarded = [];

    // Campos ocultos en respuestas JSON
    protected $hidden = [
        'contraseña',
    ];

    // Casts de tipos de datos
    protected $casts = [
        'fecha_registro' => 'date',
    ];

    // Timestamps automáticos (debe ser true si tu tabla tiene created_at/updated_at)
    public $timestamps = true;

    // Valor por defecto para tipo_usuario
    protected $attributes = [
        'tipo_usuario' => 'free',
    ];
}