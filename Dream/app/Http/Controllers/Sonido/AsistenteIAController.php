<?php

namespace App\Http\Controllers\AsistenteIA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsistenteIAController extends Controller
{
    // se conecta con la vista asistente ia
    public function index(Request $request)
    {
        return view('ventana asistente AI.index');
    }
}
