<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User as Usuario;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UsuarioInertiaController extends Controller
{
    //
    public function index(Request $request){

        $usuarios = Usuario::orderby('id', 'DESC')->get();

        return Inertia::render('ListaUsuarios/Index', [
            'usuarios'=> $usuarios
        ]);
    }
}
