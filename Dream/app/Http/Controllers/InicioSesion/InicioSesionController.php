<?php

namespace App\Http\Controllers\InicioSesion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioSesionController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('inicio sesion.index');
    }
}
