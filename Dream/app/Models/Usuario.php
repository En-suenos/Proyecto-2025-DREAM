<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
<<<<<<< HEAD
    // 
    protected $guarded = [];
}
=======
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'correo',
        'contraseña',
        'tipo_usuario',
        'fecha_registro'
    ];

    // Un usuario puede tener muchas playlists
    public function playlists()
    {
        return $this->hasMany(PlayList::class, 'id_usuario', 'id_usuario');
    }

    // Un usuario puede tener muchas suscripciones
    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class, 'id_usuario', 'id_usuario');
    }

    // Un usuario puede tener muchas sugerencias de IA
    public function sugerenciasIA()
    {
        return $this->hasMany(AsistenteIA::class, 'id_usuario', 'id_usuario');
    }

    // Un usuario puede tener muchos registros de sueño
    public function registrosSueno()
    {
        return $this->hasMany(RegistrySueno::class, 'id_usuario', 'id_usuario');
    }

    // Un usuario puede crear muchos sonidos
    public function sonidosCreados()
    {
        return $this->hasMany(Sonido::class, 'id_usuario_creador', 'id_usuario');
    }

    // Un usuario puede tener muchas detecciones faciales
    public function deteccionesFaciales()
    {
        return $this->hasMany(DetectorFacial::class, 'id_usuario', 'id_usuario');
    }

    // Un usuario puede tener muchas estadísticas
    public function estadisticasSueno()
    {
        return $this->hasMany(EstadisticaSueno::class, 'id_usuario', 'id_usuario');
    }
}
>>>>>>> InterfasC
