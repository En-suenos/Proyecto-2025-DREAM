<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OpcionesInertiaController extends Controller
{
    public function index()
    {
        return Inertia::render('Opciones/Index', [
            'configuraciones' => [
                'sonido' => [
                    'volumen' => 80,
                    'efectos' => true,
                    'notificaciones' => true,
                ],
                'apariencia' => [
                    'tema' => 'oscuro',
                    'animaciones' => true,
                ],
                'privacidad' => [
                    'datos_uso' => true,
                    'compartir_estadisticas' => false,
                ]
            ]
        ]);
    }
}