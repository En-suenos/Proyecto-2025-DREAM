<?php

namespace App\Http\Controllers\Sonido;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sonido;
use Inertia\Inertia;

class SonidoInertiaController extends Controller
{
    //
    public function index(Request $request){
        $ruta= public_path('audio');
        $archivos=[];

        if (is_dir($ruta)){
            $archivos = array_diff(scandir($ruta), ['.', '..']);
        }
        return Inertia::render('Sonidos/Index', [
            'archivos'=>$archivos
        ]);
    }
}
