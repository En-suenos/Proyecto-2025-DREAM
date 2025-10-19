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
        'id_usuario_creador',
        'activo'
    ];

    protected $casts = [
        'duracion' => 'double',
        'activo' => 'boolean'
    ];

    // Un sonido pertenece a un usuario creador
    public function usuarioCreador()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_creador', 'id_usuario');
    }

    // Un sonido puede estar en muchas playlists (relación muchos a muchos)
    public function playlists()
    {
        return $this->belongsToMany(PlayList::class, 'playlist_sonido', 'id_sonido', 'id_playlist')
                    ->withPivot('volumen_playlist', 'orden')
                    ->withTimestamps();
    }
}