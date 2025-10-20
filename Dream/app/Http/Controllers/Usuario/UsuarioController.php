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
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }

    public function create()
    {
        return View::make('usuario.create');
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|max:150|unique:usuarios,correo',
            'contraseña' => 'required|string|min:6',
            'fecha_registro' => 'required|date',
        ]);

        try {
            $usuario = Usuario::create([
                'nombre' => $request->nombre,
                'correo' => $request->correo,
                'contraseña' => Hash::make($request->contraseña),
                'fecha_registro' => $request->fecha_registro,
                'tipo_usuario' => 'free',
            ]);

            // REDIRIGIR A INICIO DE SESIÓN (que ya existe)
            return Redirect::route('inicio_sesion.index')->with('success', 'Usuario creado exitosamente!');

        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Error al crear usuario: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:100',
            'correo' => 'sometimes|email|max:150|unique:usuarios,correo,' . $usuario->id_usuario . ',id_usuario',
            'contraseña' => 'sometimes|string|min:6',
        ]);

        try {
            $datosActualizar = $request->only(['nombre', 'correo']);
            
            if ($request->has('contraseña')) {
                $datosActualizar['contraseña'] = Hash::make($request->contraseña);
            }

            $usuario->update($datosActualizar);

            return Redirect::route('usuario.index')->with('success', 'Usuario actualizado exitosamente!');

        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Error al actualizar usuario: ' . $e->getMessage())->withInput();
        }
    }
}