<?php

namespace App\Http\Controllers\RegistroSueno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegistroSueno;

class RegistroSuenoController extends Controller
{
    // conectar con la vista
    public function index()
    {
        return view('registro_sueno.index', compact('registro_sueno'));    
    }
}
