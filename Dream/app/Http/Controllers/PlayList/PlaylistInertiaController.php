<?php

namespace App\Http\Controllers\PlayList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\PlayList;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PlaylistInertiaController extends Controller
{
    //
    // Muestra la lista de playlists 
    public function index(Request $request)
    {
        return Inertia::render('Playlist/Index', []);
    }

    // Prepara la vista para crear una nueva playlist
    public function create(Request $request)
    {
        // Obtener la lista de sonidos disponibles del modelo
        $sonidosDisponibles = Playlist::getSonidosDisponibles();

        return Inertia::render('Playlist/Create', [
            'sonidosDisponibles' => $sonidosDisponibles,
        ]);
    }
    
    // Almacena la nueva playlist en la base de datos
    public function store(Request $request)
    {
        // 1. Validar la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'sonidos' => 'nullable|array',
            'sonidos.*' => 'string', // Asegura que cada elemento del array sea un string (el nombre del archivo)
        ]);

        // 2. Crear la Playlist
        // Nota: Asumo que tienes una relación de usuario o el ID se obtiene del Auth
        $playlist = Playlist::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            // Guardamos solo los nombres de archivo
            'sonidos' => $request->sonidos, 
            'id_usuario' => Auth::id(), // Obtener el ID del usuario autenticado
        ]);

        // 3. Redireccionar con un mensaje
        return Redirect::route('playlist.index')->with('success', 'Playlist creada con éxito.');
    }
}
