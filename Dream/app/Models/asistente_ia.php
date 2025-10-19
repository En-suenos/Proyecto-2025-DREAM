
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsistenteIA extends Model
{
    protected $table = 'asistente_ia';
    protected $primaryKey = 'id_sugerencia';

    protected $fillable = [
        'id_usuario',
        'sugerencia',
        'fecha_generacion',
        'leida'
    ];

    protected $casts = [
        'leida' => 'boolean',
        'fecha_generacion' => 'datetime'
    ];

    // Una sugerencia pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}