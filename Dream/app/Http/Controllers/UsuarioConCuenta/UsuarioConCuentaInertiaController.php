<?php

namespace App\Http\Controllers\UsuarioConCuenta;

// use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioConCuentaInertiaController extends Controller
{
    //
    public function index(Request $request){
        return Inertia::render('VentanaUsuarioCuenta/Index', []);
    }
}
