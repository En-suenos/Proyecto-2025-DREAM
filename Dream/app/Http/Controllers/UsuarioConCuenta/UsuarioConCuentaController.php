<?php

namespace App\Http\Controllers\UsuarioConCuenta;

use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Redirect,View};
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioConCuentaController extends Controller
{
    // conectar con la vista
    public function index(Request $request)
    {
        $usuarios = Usuario::orderBy('id', 'DESC')->get();
        return view('ventana perfil.index', compact('usuarios'));
    }

    public function find(Request $request)
    {
        return view('ventana principal.index');
    }
}
