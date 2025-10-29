<?php

namespace App\Http\Controllers\Perfil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\{Redirect, Hash, Storage};

class PerfilController extends Controller
{
    // Mostrar el perfil del usuario autenticado
    public function index(Request $request)
    {
        $usuarioId = session('usuario_id');
        
        if (!$usuarioId) {
            return Redirect::route('inicio_sesion.index')->with('error', 'Debes iniciar sesión primero.');
        }
        
        $usuario = Usuario::find($usuarioId);
        
        if (!$usuario) {
            return Redirect::route('inicio_sesion.index')->with('error', 'Usuario no encontrado.');
        }
        
        return view('ventana perfil.index', compact('usuario'));
    }

    // Actualizar datos del perfil
    public function update(Request $request)
    {
        $usuarioId = session('usuario_id');
        
        if (!$usuarioId) {
            return Redirect::route('inicio_sesion.index')->with('error', 'Debes iniciar sesión primero.');
        }
        
        $usuario = Usuario::find($usuarioId);
        
        if (!$usuario) {
            return Redirect::route('inicio_sesion.index')->with('error', 'Usuario no encontrado.');
        }

        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuarioId . ',id_usuario',
            'contrasena_actual' => 'nullable|string',
            'contrasena_nueva' => 'nullable|string|min:6|confirmed',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048' // 2MB máximo
        ]);

        // Manejar la imagen de perfil
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($usuario->imagen && Storage::exists('public/perfil/' . $usuario->imagen)) {
                Storage::delete('public/perfil/' . $usuario->imagen);
            }

            $imagen = $request->file('imagen');
            $nombreImagen = 'perfil_' . $usuarioId . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            
            // Guardar imagen
            $imagen->storeAs('public/perfil', $nombreImagen);
            $usuario->imagen = $nombreImagen;
        }

        // Actualizar nombre y correo
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;

        // Si quiere cambiar la contraseña
        if ($request->filled('contrasena_nueva')) {
            // Verificar que la contraseña actual sea correcta
            if (!$request->filled('contrasena_actual') || !Hash::check($request->contrasena_actual, $usuario->contraseña)) {
                return Redirect::back()->with('error', 'La contraseña actual es incorrecta.');
            }
            
            // Actualizar contraseña
            $usuario->contraseña = Hash::make($request->contrasena_nueva);
        }

        $usuario->save();

        // Actualizar la sesión con el nuevo correo
        session(['usuario_correo' => $usuario->correo]);

        return Redirect::route('perfil.index')->with('success', 'Perfil actualizado exitosamente.');
    }

    // Eliminar imagen de perfil
    public function eliminarImagen(Request $request)
    {
        $usuarioId = session('usuario_id');
        
        if (!$usuarioId) {
            return Redirect::route('inicio_sesion.index')->with('error', 'Debes iniciar sesión primero.');
        }
        
        $usuario = Usuario::find($usuarioId);
        
        if (!$usuario) {
            return Redirect::route('inicio_sesion.index')->with('error', 'Usuario no encontrado.');
        }

        // Eliminar imagen del almacenamiento
        if ($usuario->imagen && Storage::exists('public/perfil/' . $usuario->imagen)) {
            Storage::delete('public/perfil/' . $usuario->imagen);
        }
        
        // Eliminar referencia de la imagen en la base de datos
        $usuario->imagen = null;
        $usuario->save();

        return Redirect::route('perfil.index')->with('success', 'Imagen de perfil eliminada correctamente.');
    }
}