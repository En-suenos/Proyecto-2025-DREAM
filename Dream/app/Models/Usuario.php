<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use SoftDeletes;
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario'; // ✅ ESTO ES LO QUE FALTA
    
    protected $fillable = [
        'nombre',
        'correo',
        'contraseña',
        'tipo_usuario',
        'fecha_registro',
        'imagen'
    ];
    
    protected $hidden = [
        'contraseña'
    ];

    // Relación con playlists
    public function playlists()
    {
        return $this->hasMany(Playlist::class, 'id_usuario', 'id_usuario');
    }

    // Método para obtener la contraseña (laravel espera 'password')
    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    
}