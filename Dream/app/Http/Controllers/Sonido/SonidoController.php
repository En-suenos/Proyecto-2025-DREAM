<?php

namespace App\Http\Controllers\Sonido;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sonido;

class SonidoController extends Controller
{
    // conectar con la vista
    public function index()
    {
        return view('sonido.index', compact('sonido'));
    }
}
