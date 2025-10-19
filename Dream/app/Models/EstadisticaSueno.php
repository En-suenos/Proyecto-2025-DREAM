<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadisticaSueno extends Model
{
    protected $table = 'estadisticas_sueno';
    protected $primaryKey = 'id_estadistica';

    protected $fillable = [
        'id_usuario',
        'periodo',
        'fecha_inicio',
        'fecha_fin',
        'promedio_horas',
        'calidad_promedio',
        'dias_registrados'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'promedio_horas' => 'double',
        'calidad_promedio' => 'double'
    ];

    // Una estadística pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}