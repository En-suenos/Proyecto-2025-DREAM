<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistSonido extends Model
{
    use HasFactory;

    protected $table = 'playlist_sonido';
    
    protected $fillable = [
        'playlist_id',
        'nombre_sonido',
        'ruta_sonido',
        'volumen',
        'orden'
    ];

    // Relación con la playlist
    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}