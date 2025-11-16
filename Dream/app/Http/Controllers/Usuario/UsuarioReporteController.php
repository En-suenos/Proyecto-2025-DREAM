<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UsuarioReporteController extends Controller
{
    //
    public function index(Request $request) {

        $usuarios = User::get();

        $pdf = Pdf::loadView('usuario.pdf.index', compact('usuarios'));

        return $pdf->download('invoice.pdf');
    }
}
