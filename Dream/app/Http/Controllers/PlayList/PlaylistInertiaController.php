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
    public function index()
    {
        $playlists = Playlist::where('id_usuario', Auth::id())->get();

        return Inertia::render('Playlist/Index', [
            'playlists' => $playlists
        ]);
    }

    public function create()
    {
        return Inertia::render('Playlist/Create', [
            'sonidosDisponibles' => Playlist::getSonidosDisponibles(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'sonidos' => 'nullable|array',
            'sonidos.*' => 'string',
        ]);

        Playlist::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'] ?? null,
            'sonidos' => $validated['sonidos'] ?? [],
            'id_usuario' => Auth::id(),
        ]);

        return Redirect::route('playlist.index')
            ->with('success', 'Playlist creada con éxito.');
    }

    public function show($id)
    {
        $playlist = Playlist::where('id', $id)
            ->where('id_usuario', Auth::id())
            ->firstOrFail();

        return Inertia::render('Playlist/Show', [
            'playlist' => $playlist
        ]);
    }
}
