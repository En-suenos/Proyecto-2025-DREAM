<?php

namespace App\Http\Controllers\InicioSesion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioSesionController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('inicio sesion.index');
    }

    public function login(Request $request)
    {
        // Validar campos requeridos
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required'
        ]);

        // Buscar usuario en BD por correo
        $usuario = Usuario::where('correo', $request->correo)->first();

        // Verificar si existe y la contraseña coincide
        if ($usuario && Hash::check($request->contrasena, $usuario->contraseña)) {
            // Guardar sesión
            session(['usuario_id' => $usuario->id_usuario]);

            // Redirigir al panel del usuario
            return redirect()->route('usuario_con_cuenta.index')->with('success', 'Inicio de sesión exitoso.');
        }else {
           dd('No coincide o no existe el usuario');
        }

        // Si falla, regresar con mensaje de error
        return back()->with('error', 'Correo o contraseña incorrectos.');
    }
}
