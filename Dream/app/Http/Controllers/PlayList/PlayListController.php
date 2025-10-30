<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    // Método auxiliar para obtener el ID del usuario desde la sesión
    private function getUsuarioId()
    {
        return session('usuario_id');
    }

    // Verificar si el usuario es propietario de la playlist
    private function esPropietario(Playlist $playlist)
    {
        return $playlist->id_usuario == $this->getUsuarioId();
    }

    public function index()
    {
        $playlists = Playlist::where('id_usuario', $this->getUsuarioId())->get();
        return view('ventana playlista.index', compact('playlists'));
    }

    public function create()
    {
        return view('playlists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        Playlist::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_usuario' => $this->getUsuarioId(),
            'sonidos' => [] // Playlist vacía
        ]);

        return redirect()->route('playlists.index')
            ->with('success', 'Playlist creada exitosamente.');
    }

    public function show(Playlist $playlist)
    {
        // Verificar que el usuario sea el propietario
        if (!$this->esPropietario($playlist)) {
            abort(403, 'No tienes permiso para ver esta playlist.');
        }

        $sonidosDisponibles = Playlist::getSonidosDisponibles();

        return view('ventana playlista.show', compact('playlist', 'sonidosDisponibles'));
    }

    public function edit(Playlist $playlist)
    {
        // Verificar que el usuario sea el propietario
        if (!$this->esPropietario($playlist)) {
            abort(403, 'No tienes permiso para editar esta playlist.');
        }

        return view('ventana playlista.edit', compact('playlist'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        // Verificar que el usuario sea el propietario
        if (!$this->esPropietario($playlist)) {
            abort(403, 'No tienes permiso para editar esta playlist.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        $playlist->update($request->all());

        return redirect()->route('playlists.index')
            ->with('success', 'Playlist actualizada exitosamente.');
    }

    public function destroy(Playlist $playlist)
    {
        // Verificar que el usuario sea el propietario
        if (!$this->esPropietario($playlist)) {
            abort(403, 'No tienes permiso para eliminar esta playlist.');
        }

        $playlist->delete();

        return redirect()->route('playlists.index')
            ->with('success', 'Playlist eliminada exitosamente.');
    }

    // Métodos para gestionar sonidos en playlists específicas
    // Retornar JSON
    public function agregarSonido(Request $request, Playlist $playlist)
    {
        if (!$this->esPropietario($playlist)) {
            return response()->json(['success' => false, 'message' => 'No autorizado'], 403);
        }

        $request->validate([
            'sonido_archivo' => 'required|string'
        ]);

        $sonido = $playlist->agregarSonido($request->sonido_archivo);
        
        if ($sonido) {
            return response()->json([
                'success' => true,
                'sonido' => $sonido
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'El sonido no existe o ya está en la playlist.'
            ], 400);
        }
    }

    //Retornar JSON
    public function quitarSonido(Playlist $playlist, $sonidoId)
    {
        if (!$this->esPropietario($playlist)) {
            return response()->json(['success' => false, 'message' => 'No autorizado'], 403);
        }

        if ($playlist->quitarSonido($sonidoId)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al remover el sonido.'
            ], 400);
        }
    }

    public function actualizarVolumen(Request $request, Playlist $playlist, $sonidoId)
    {
        // Verificar que el usuario sea el propietario
        if (!$this->esPropietario($playlist)) {
            abort(403, 'No tienes permiso para modificar esta playlist.');
        }

        $request->validate([
            'volumen' => 'required|integer|min:0|max:100'
        ]);

        if ($playlist->actualizarVolumen($sonidoId, $request->volumen)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    public function actualizarOrden(Request $request, Playlist $playlist)
    {
        // Verificar que el usuario sea el propietario
        if (!$this->esPropietario($playlist)) {
            abort(403, 'No tienes permiso para modificar esta playlist.');
        }

        $request->validate([
            'sonidos' => 'required|array'
        ]);

        if ($playlist->actualizarOrden($request->sonidos)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    public function toggleSonido(Request $request, Playlist $playlist, $sonidoId)
    {
        // Verificar que el usuario sea el propietario
        if (!$this->esPropietario($playlist)) {
            abort(403, 'No tienes permiso para modificar esta playlist.');
        }

        $sonidos = $playlist->sonidos ?? [];

        foreach ($sonidos as &$sonido) {
            if ($sonido['id'] === $sonidoId) {
                $sonido['activo'] = !($sonido['activo'] ?? true);
                break;
            }
        }

        $playlist->update(['sonidos' => $sonidos]);

        return response()->json(['success' => true]);
    }

    public function reproducirPlaylist(Playlist $playlist)
    {
        // Verificar que el usuario sea el propietario
        if (!$this->esPropietario($playlist)) {
            abort(403, 'No tienes permiso para reproducir esta playlist.');
        }

        $sonidosActivos = $playlist->sonidos_activos;

        return view('ventana playlista.reproducir', compact('playlist', 'sonidosActivos'));
    }
}