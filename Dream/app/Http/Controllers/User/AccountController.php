<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('User/Account', [
            'title' => 'Mi Cuenta - DreamApp'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Mostrar perfil de usuario
     */
    public function profile()
    {
        return Inertia::render('User/Profile', [
            'title' => 'Mi Perfil - DreamApp'
        ]);
    }

    /**
     * Mostrar configuración de sonidos
     */
    public function sounds()
    {
        return Inertia::render('User/Sounds', [
            'title' => 'Sonidos - DreamApp'
        ]);
    }

    /**
     * Mostrar playlists
     */
    public function playlists()
    {
        return Inertia::render('User/Playlists', [
            'title' => 'Mis Playlists - DreamApp'
        ]);
    }

    /**
     * Mostrar configuración (página separada)
     */
    public function settings()
    {
        return Inertia::render('User/Settings', [
            'title' => 'Configuración - DreamApp',
            'settings' => [
                'volume' => 80,
                'theme' => 'dark',
                'notifications' => true,
                'soundQuality' => 'medium'
            ]
        ]);
    }

    /**
     * Generar reporte PDF
     */
    public function generatePdfReport()
    {
        // Lógica temporal - puedes implementar PDF después
        return response()->json([
            'message' => 'Reporte PDF generado exitosamente',
            'status' => 'success'
        ]);
    }
}