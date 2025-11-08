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
        'nombre_cuenta',
        'tipo_usuario',
        'imagen'
    ];
    
    protected $hidden = [
        'contraseña'
    ];

    // Relación con playlists
    public function playlists()
    {
        return $this->hasMany(Playlist::class, 'id');
    }

    // Método para obtener la contraseña (laravel espera 'password')
    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    
}