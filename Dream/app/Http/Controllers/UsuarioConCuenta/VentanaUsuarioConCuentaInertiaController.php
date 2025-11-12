<?php

namespace App\Http\Controllers\UsuarioConCuenta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Usuario;

class VentanaUsuarioConCuentaInertiaController extends Controller
{
    public function index(Request $request){
        return Inertia::render('VentanaUsuarioCuenta/Index', [
            'user' => $request->user()
        ]);
    }

    public function show(Usuario $usuario){
        return Inertia::render('Perfil/Index', [
            'usuario' => $usuario
        ]);
    }

    // Métodos adicionales requeridos por el resource
    public function create(){
        return Inertia::render('VentanaUsuarioCuenta/Create');
    }

    public function store(Request $request){
        // Lógica para guardar
    }

    public function edit(Usuario $usuario){
        return Inertia::render('VentanaUsuarioCuenta/Edit', [
            'usuario' => $usuario
        ]);
    }

    public function update(Request $request, Usuario $usuario){
        // Lógica para actualizar
    }

    public function destroy(Usuario $usuario){
        // Lógica para eliminar
    }
}