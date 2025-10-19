<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrySueno extends Model
{
    protected $table = 'registry_sueno';
    protected $primaryKey = 'id_registro';

    protected $fillable = [
        'id_usuario',
        'fecha',
        'hora_inicio',
        'hora_despertar',
        'duracion_total',
        'calidad_sueno',
        'notas'
    ];

    protected $casts = [
        'fecha' => 'date',
        'duracion_total' => 'double'
    ];

    // Un registro pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}