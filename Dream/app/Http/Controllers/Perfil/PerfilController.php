<?php

namespace App\Http\Controllers\Perfil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perfil;

class PerfilController extends Controller
{
    // conectar con la vista
    public function index()
    {
        return view('ventana perfil.index');
    }
}
