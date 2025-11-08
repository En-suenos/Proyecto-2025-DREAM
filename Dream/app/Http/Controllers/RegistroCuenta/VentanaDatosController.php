<?php

namespace App\Http\Controllers\VentanaDatos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VentanaDatosController extends Controller
{
    // conectar con la vista ventana de datos
    public function index(Request $request)
    {
        return view('ventana de datos.index');
    }
}
