<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'sonidos',
        'id_usuario'
    ];

    protected $casts = [
        'sonidos' => 'array'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    // SONIDOS DISPONIBLES CORREGIDOS
    public static function getSonidosDisponibles()
    {
        $archivos = [
            'Sonido-10.mp3',
            'Sonido-12.mp3',
            'Sonido-13.mp3',
            'Sonido-14.mp3',
            'Sonido-15.mp3',
            'Sonido-16.mp3',
            'Sonido-17.mp3'
        ];

        // Convertimos cada archivo en un OBJETO
        return array_map(function($archivo) {
            return [
                'archivo' => $archivo,
                'nombre' => pathinfo($archivo, PATHINFO_FILENAME)
            ];
        }, $archivos);
    }

    public function getCantidadSonidosAttribute()
    {
        return is_array($this->sonidos) ? count($this->sonidos) : 0;
    }
}
