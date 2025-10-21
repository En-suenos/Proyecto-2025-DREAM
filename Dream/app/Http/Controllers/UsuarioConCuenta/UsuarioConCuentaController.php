<?php

namespace App\Http\Controllers\UsuarioConCuenta;

use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Redirect,View};
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioConCuentaController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el usuario_id de la sesión
        $usuarioId = session('usuario_id');
        
        // Debug: ver qué hay en la sesión
        if (!$usuarioId) {
            // Mostrar toda la sesión para diagnosticar
            dd('Sesión vacía o sin usuario_id', [
                'todas_las_sesiones' => session()->all(),
                'usuario_id' => session('usuario_id'),
                'usuario_correo' => session('usuario_correo')
            ]);
        }
        
        $usuario = Usuario::find($usuarioId);
        
        if (!$usuario) {
            dd('Usuario no encontrado con ID: ' . $usuarioId);
        }
        
        return view('usuarios con cuenta.index', compact('usuario'));
    }

    public function find(Request $request)
    {
        return view('ventana principal.index');
    }
}