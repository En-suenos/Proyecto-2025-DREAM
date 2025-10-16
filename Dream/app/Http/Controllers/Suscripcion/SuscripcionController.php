<?php

namespace App\Http\Controllers\Suscripcion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suscripcion;

class SuscripcionController extends Controller
{
    // conectar con la vista
    public function index()
    {
        return view('suscripcion.index', compact('suscripcion'));   
    }
}
