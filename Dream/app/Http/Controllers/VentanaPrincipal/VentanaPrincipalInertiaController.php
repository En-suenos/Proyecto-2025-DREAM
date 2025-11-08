<?php

namespace App\Http\Controllers\VentanaPrincipal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Usuario;

class VentanaPrincipalInertiaController extends Controller
{
    //
    public function index(Request $request){
        $usuarios=Usuario::orderby('id', 'DESC')->get();

        return Inertia::render('Inicio/Index', [
            'usuarios'=>$usuarios
        ]);
    }
}
