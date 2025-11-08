<?php

namespace App\Http\Controllers\RegistroCuenta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use App\Models\Usuario;

class RegistroCuentaInertiaController extends Controller
{
    //
    public function index(Request $request){
        
        return Inertia::render('RegistroCuenta/Index', []);
    }

    public function create(Request $request){
        return Inertia::render('RegistroCuenta/Create');
    }

    public function store(Request $request){
        $usuarios=Usuario::create($request->all());

        return Redirect::route('registro.index');
    }
}
