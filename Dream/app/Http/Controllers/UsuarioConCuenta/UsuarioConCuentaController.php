<?php

namespace App\Http\Controllers\UsuarioConCuenta;

use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Redirect,View};
use Illuminate\Http\Request;

class UsuarioConCuentaController extends Controller
{
    // conectar con la vista
    public function index(Request $request)
    {
        return view('usuarios con cuenta.index');
    }

    public function find(Request $request)
    {
        return view('ventana principal.index');
    }
}
