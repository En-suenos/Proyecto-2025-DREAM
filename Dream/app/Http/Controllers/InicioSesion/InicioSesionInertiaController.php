<?php

namespace App\Http\Controllers\InicioSesion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioSesionInertiaController extends Controller
{
    //
    public function index(Request $request){

        return Inertia::render('Inicio/Index', [
        ]);
    }
}
