<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador;

class AdministradorController extends Controller
{
    //conectar con la vista
    public function index()
    {
        return view('administrador.index', compact('administrador'));
    }
}
