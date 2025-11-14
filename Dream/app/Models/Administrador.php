<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use Notifiable;

    protected $table = 'administrador'; // tu tabla

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'codigo',
    ];

    protected $hidden = [
        'password',
    ];
}
