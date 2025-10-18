<?php

namespace App\Http\Controllers\VentanaPrincipal;

use App\Models\VentanaPrincipal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VentanaPrincipalController extends Controller
{
    //conectar con la vista
    public function index(Request $request)
    {
        return view('ventana principal.index');
    }

    // se conecta con inicio sesion-controller
    public function find(Request $request)
    {
        return view('inicio sesion.index');
    }
}
