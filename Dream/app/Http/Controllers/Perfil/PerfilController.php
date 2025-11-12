<?php

namespace App\Http\Controllers\Perfil;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\{Redirect, Hash, Storage, Session};
use Inertia\Inertia;


class PerfilController extends Controller
{
    // 🪞 Mostrar el perfil del usuario autenticado
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

        // 🧠 Enviar los datos del usuario a Inertia
        return Inertia::render('Perfil/Index', [
            'auth' => [
                'user' => [
                    'id_usuario' => $usuario->id_usuario,
                    'nombre' => $usuario->nombre,
                    'apellido' => $usuario->apellido,
                    'correo' => $usuario->correo,
                    'telefono' => $usuario->telefono,
                    'imagen' => $usuario->imagen ? asset('storage/perfil/' . $usuario->imagen) : null,
                    'created_at' => $usuario->created_at,
                ]
            ]
        ]);
    }

    // 🧩 Actualizar los datos del perfil
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

        // 🧾 Validar datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuarioId . ',id_usuario',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // 🖼️ Manejar imagen
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($usuario->imagen && Storage::exists('public/perfil/' . $usuario->imagen)) {
                Storage::delete('public/perfil/' . $usuario->imagen);
            }

            $imagen = $request->file('imagen');
            $nombreImagen = 'perfil_' . $usuarioId . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->storeAs('public/perfil', $nombreImagen);
            $usuario->imagen = $nombreImagen;
        }

        // 🧑‍💼 Actualizar datos
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->telefono = $request->telefono;
        $usuario->correo = $request->correo;
        $usuario->save();

        // 🔄 Actualizar la sesión
        session(['usuario_correo' => $usuario->correo]);

        return Redirect::back()->with('success', 'Perfil actualizado correctamente.');
    }

    // ❌ Eliminar imagen
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

        if ($usuario->imagen && Storage::exists('public/perfil/' . $usuario->imagen)) {
            Storage::delete('public/perfil/' . $usuario->imagen);
        }

        $usuario->imagen = null;
        $usuario->save();

        return Redirect::back()->with('success', 'Imagen eliminada correctamente.');
    }
}
