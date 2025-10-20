<?php

namespace App\Http\Controllers\InicioSesion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario; // FALTABA ESTE
use Illuminate\Support\Facades\Hash; // FALTABA ESTE

class InicioSesionController extends Controller
{
    public function index(Request $request)
    {
        return view('inicio sesion.index');
    }

    public function login(Request $request)
    {
        // Validar campos requeridos - CORREGIDO EL NOMBRE DEL CAMPO
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required' // CAMBIADO: 'contrasena' → 'contraseña'
        ]);

        // Buscar usuario en BD por correo
        $usuario = Usuario::where('correo', $request->correo)->first();

        // DEBUG: Ver qué está pasando
        if (!$usuario) {
            dd('Usuario no encontrado con correo: ' . $request->correo);
        }

        // Verificar contraseña
        if (Hash::check($request->contraseña, $usuario->contraseña)) {
            // Guardar sesión
            session(['usuario_id' => $usuario->id_usuario]);
            session(['usuario_nombre' => $usuario->nombre]);

            // Redirigir al panel del usuario
            return redirect()->route('usuario_con_cuenta.index')->with('success', 'Inicio de sesión exitoso.');
        } else {
            dd('Contraseña incorrecta. Hash en BD: ' . $usuario->contraseña);
        }

        // Este código nunca se ejecutará por los dd() arriba
        // return back()->with('error', 'Correo o contraseña incorrectos.');
    }
}