<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\{Redirect,View};

class UsuarioController extends Controller
{
    //conectar con la vista
    public function index()
    {
        return view('usuario.index', compact('usuario'));
    }

    public function create(){
        return View::make('usuario.create');
    }

    public function store(Request $request){
        $usuario = Usuario::create($request->all());

        return Redirect::to('ventana datos/index');
    }

    public function update(Request $request, Usuario $usuario){
        $usuario->update($request->all());
        return Redirect::to('/ventana de datos/index');
    }

}
