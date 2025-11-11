<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    // Relación CORRECTA con User (modelo de Laravel)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Obtener sonidos disponibles - versión simplificada para debug
    public static function getSonidosDisponibles()
    {
        // Versión simplificada para testing
        return [
            'Sonido-10.mp3',
            'Sonido-12.mp3',
            'Sonido-13.mp3', 
            'Sonido-14.mp3',
            'Sonido-15.mp3',
            'Sonido-16.mp3',
            'Sonido-17.mp3'
        ];
    }

    // Contador de sonidos
    public function getCantidadSonidosAttribute()
    {
        return is_array($this->sonidos) ? count($this->sonidos) : 0;
    }
}