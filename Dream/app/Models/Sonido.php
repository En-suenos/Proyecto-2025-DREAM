<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sonido extends Model
{
    protected $table = 'sonidos';
    protected $primaryKey = 'id_sonido';

    protected $fillable = [
        'nombre',
        'categoria',
        'archivo_audio',
        'duracion',
        'activo'
    ];

    protected $casts = [
        'duracion' => 'double',
        'activo' => 'boolean'
    ];

    // Relación con playlists
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_sonido')
                    ->withPivot('volumen', 'orden')
                    ->withTimestamps();
    }
}