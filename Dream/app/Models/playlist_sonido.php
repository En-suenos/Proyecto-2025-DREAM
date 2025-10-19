<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaylistSonido extends Model
{
    protected $table = 'playlist_sonido';
    protected $primaryKey = 'id_playlist_sonido';

    protected $fillable = [
        'id_playlist',
        'id_sonido',
        'volumen_playlist',
        'orden'
    ];

    // Pertenece a una playlist
    public function playlist()
    {
        return $this->belongsTo(PlayList::class, 'id_playlist', 'id_playlist');
    }

    // Pertenece a un sonido
    public function sonido()
    {
        return $this->belongsTo(Sonido::class, 'id_sonido', 'id_sonido');
    }
}
