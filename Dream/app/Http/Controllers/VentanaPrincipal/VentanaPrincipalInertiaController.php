<?php

namespace App\Http\Controllers\VentanaPrincipal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VentanaPrincipalInertiaController extends Controller
{
    //
    public function index(Request $request){
        return Inertia::render('Inicio/Index', []);
    }
}
