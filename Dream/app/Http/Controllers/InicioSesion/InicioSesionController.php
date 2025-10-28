<?php

namespace App\Http\Controllers\InicioSesion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class InicioSesionController extends Controller
{
    public function index()
    {
        return view('inicio sesion.index');
    }

    public function login(Request $request)
    {
        // Validar que los campos no estén vacíos
        $request->validate([
            'correoLogin' => 'required|email',
            'contrasenaLogin' => 'required'
        ]);

        $correo = $request->input('correoLogin');
        $contrasena = $request->input('contrasenaLogin');

        // Buscar el usuario por correo
        $usuario = Usuario::where('correo', $correo)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && Hash::check($contrasena, $usuario->contraseña)) {
            // Usuario encontrado y contraseña válida
            session([
                'usuario_id' => $usuario->id_usuario, 
                'usuario_nombre' => $usuario->nombre,
                'usuario_correo' => $usuario->correo
            ]);
            
            return Redirect::route('usuario_con_cuenta.index')
                ->with('success', 'Inicio de sesión exitoso');
        } else {
            // Usuario no encontrado o contraseña incorrecta
            return Redirect::route('inicio_sesion.index')
                ->with('error', 'Credenciales incorrectas. Por favor, verifica tus datos.');
        }
    }

    public function logout()
{
    // Limpiar la sesión
    session()->forget(['usuario_id', 'usuario_nombre', 'usuario_correo']);
    
    return Redirect::route('ventana-principal.index')
        ->with('success', 'Sesión cerrada correctamente');
}
}