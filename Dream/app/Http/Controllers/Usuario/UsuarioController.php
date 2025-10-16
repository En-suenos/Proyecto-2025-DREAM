<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    //conectar con la vista
    public function index()
    {
        return view('usuario.index', compact('usuario'));
    }
}
