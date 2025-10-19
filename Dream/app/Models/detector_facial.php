<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetectorFacial extends Model
{
    protected $table = 'detector_facial';
    protected $primaryKey = 'id_detector';

    protected $fillable = [
        'id_usuario',
        'estado_detectado',
        'fecha_deteccion',
        'confianza'
    ];

    protected $casts = [
        'fecha_deteccion' => 'datetime',
        'confianza' => 'double'
    ];

    // Una detección pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}