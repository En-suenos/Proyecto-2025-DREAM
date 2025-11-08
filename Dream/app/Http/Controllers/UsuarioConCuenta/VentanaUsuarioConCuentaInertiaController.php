<?php

namespace App\Http\Controllers\UsuarioConCuenta;

// use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Usuario;

class VentanaUsuarioConCuentaInertiaController extends Controller
{
    //
    public function index(Request $request){
        return Inertia::render('VentanaUsuarioCuenta/Index', []);
    }

    public function show(Usuario $usuario){
        return Inertia::render('Perfil/Index', [
            'usuario'=>$usuario
        ]);
    }
}
