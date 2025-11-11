<?php

namespace App\Http\Controllers\PlayList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Playlist;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PlaylistInertiaController extends Controller
{
    // Muestra la lista de playlists del usuario autenticado
    public function index(Request $request)
    {
        try {
            Log::info('Accediendo a index de playlists');

            // Verificar autenticación
            if (!Auth::check()) {
                Log::warning('Usuario no autenticado en playlists');
                return Redirect::route('login');
            }

            $userId = Auth::id();
            Log::info("Buscando playlists para usuario ID: {$userId}");

            // Obtener playlists con manejo seguro
            $playlists = Playlist::where('id_usuario', $userId)->get();

            Log::info("Playlists encontradas: " . $playlists->count());

            return Inertia::render('Playlist/Index', [
                'playlists' => $playlists
            ]);

        } catch (\Exception $e) {
            Log::error('Error crítico en PlaylistController index: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return Inertia::render('Error', ['message' => 'Error al cargar las playlists']);
        }
    }

    // Muestra una playlist específica
    public function show($id)
    {
        try {
            Log::info("Mostrando playlist ID: {$id} para usuario: " . Auth::id());

            // Buscar la playlist del usuario autenticado
            $playlist = Playlist::where('id', $id)
                ->where('id_usuario', Auth::id())
                ->firstOrFail();

            Log::info("Playlist encontrada: {$playlist->nombre}");

            return Inertia::render('Playlist/Show', [
                'playlist' => $playlist
            ]);

        } catch (\Exception $e) {
            Log::error('Error en PlaylistController show: ' . $e->getMessage());
            return Redirect::route('playlist.index')
                ->with('error', 'Playlist no encontrada');
        }
    }

    // Prepara la vista para crear una nueva playlist
    public function create(Request $request)
    {
        try {
            $sonidosDisponibles = Playlist::getSonidosDisponibles();
            
            Log::info('Sonidos disponibles: ' . count($sonidosDisponibles));

            return Inertia::render('Playlist/Create', [
                'sonidosDisponibles' => $sonidosDisponibles,
            ]);

        } catch (\Exception $e) {
            Log::error('Error en PlaylistController create: ' . $e->getMessage());
            return Redirect::back()->with('error', 'Error al cargar el formulario');
        }
    }
    
    // Almacena la nueva playlist en la base de datos
    public function store(Request $request)
    {
        try {
            Log::info('Store request data: ', $request->all());

            // 1. Validar la solicitud
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'sonidos' => 'nullable|array',
                'sonidos.*' => 'string',
            ]);

            Log::info('Datos validados: ', $validated);

            // 2. Crear la Playlist
            $playlistData = [
                'nombre' => $validated['nombre'],
                'descripcion' => $validated['descripcion'] ?? null,
                'sonidos' => $validated['sonidos'] ?? [],
                'id_usuario' => Auth::id(),
            ];

            Log::info('Creando playlist con datos: ', $playlistData);

            $playlist = Playlist::create($playlistData);

            Log::info("Playlist creada exitosamente ID: {$playlist->id}");

            // 3. Redireccionar con mensaje
            return Redirect::route('playlist.index')
                ->with('success', 'Playlist creada con éxito.');

        } catch (\Exception $e) {
            Log::error('Error en PlaylistController store: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return Redirect::back()
                ->withInput()
                ->with('error', 'Error al crear la playlist: ' . $e->getMessage());
        }
    }
}