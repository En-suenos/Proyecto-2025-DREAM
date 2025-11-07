<?php

namespace App\Http\Controllers\Perfil;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PerfilInertiaController extends Controller
{
    //
    public function index(Request $request){
        $usuarios=User::orderby('id', 'DESC')->get();

        return Inertia::render('Perfil/Index', [
            'usuarios'=>$usuarios
        ]);
    }
}
