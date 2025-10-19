<?php

namespace App\Http\Controllers\Perfil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Usuario;
class PerfilController extends Controller
{
    // conectar con la vista
    public function index(Request $request)
    {
        $usuarios = Usuario::orderBy('id_usuario', 'DESC')->get();
        return view('ventana perfil.index', compact('usuarios'));
    }
}
