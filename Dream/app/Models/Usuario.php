<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'fecha_registro'
    ];
    
    protected $hidden = [
        'contraseña'
    ];
}