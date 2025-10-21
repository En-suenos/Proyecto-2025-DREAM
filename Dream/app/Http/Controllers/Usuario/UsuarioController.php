<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\{Redirect, View, Hash};

class UsuarioController extends Controller
{
    public function index()
    {
        return view('usuario.index', compact('usuario'));
    }

    public function create()
    {
        return View::make('usuario.create');
    }

    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios',
            'contraseña' => 'required|string|min:6',
            'fecha_registro' => 'required|date'
        ]);

        // Crear el usuario con la contraseña ENCRIPTADA
        Usuario::create([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'contraseña' => Hash::make($request->input('contraseña')), // ✅ Encriptada
            'tipo_usuario' => 'free',
            'fecha_registro' => $request->input('fecha_registro')
        ]);

        return Redirect::route('inicio_sesion.index')->with('success', 'Registro exitoso. Por favor, inicia sesión.');
    }

    public function update(Request $request, Usuario $usuario)
    {
        $usuario->update($request->all());
        return Redirect::to('/ventana de datos/index');
    }

    // para eliminar usuario (lógica)
    public function delete($id){
        $usuario=Usuario::find($id);
        return View::make('usuarios con cuenta.delete', compact('usuario'));
    }

    public function destroy(Usuario $usuario)
   {
    $usuario->delete(); // Eliminación lógica (porque usas SoftDeletes)
    return Redirect::route('ventana-principal.index')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
   }

}