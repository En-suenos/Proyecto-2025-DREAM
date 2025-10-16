<?php

namespace App\Http\Controllers\EstadisticaSueno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstadisticaSueno;

class EstadisticaSuenoController extends Controller
{
    // conectar con la vista
    public function index()
    {
        return view('estadistica_sueno.index', compact('estadistica_sueno'));
    }
}
