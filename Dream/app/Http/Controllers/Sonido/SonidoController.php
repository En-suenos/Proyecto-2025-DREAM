<?php

namespace App\Http\Controllers\Sonido;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sonido;
use Illuminate\Support\Facades\{Storage, Redirect};

class SonidoController extends Controller
{
    // Mostrar todos los sonidos (público para todos)
    // public function index()
    // {
    //     $sonidos = Sonido::where('activo', true)
    //                      ->orderBy('categoria')
    //                      ->orderBy('nombre')
    //                      ->get();
        
    //     return view('ventana sonido.index', compact('sonidos'));
    // }

    // // Mostrar formulario para subir sonido
    // public function create()
    // {
    //     return view('ventana sonido.create');
    // }

    // // Guardar nuevo sonido (global)
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nombre' => 'required|string|max:100',
    //         'categoria' => 'required|in:naturaleza,meditacion,urbano,blanco,instrumental',
    //         'archivo_audio' => 'required|mimes:mp3,wav,ogg|max:10240' // 10MB máximo
    //     ]);

    //     // Guardar el archivo de audio
    //     $archivo = $request->file('archivo_audio');
    //     $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
    //     $ruta = $archivo->storeAs('sonidos', $nombreArchivo, 'public');

    //     // Crear el sonido en la BD
    //     Sonido::create([
    //         'nombre' => $request->nombre,
    //         'categoria' => $request->categoria,
    //         'archivo_audio' => $ruta,
    //         'duracion' => 0,
    //         'activo' => true
    //     ]);

    //     return Redirect::route('sonidos.index')->with('success', 'Sonido agregado exitosamente');
    // }

    // // Eliminar sonido
    // public function destroy($id)
    // {
    //     $sonido = Sonido::find($id);
        
    //     if ($sonido) {
    //         // Eliminar archivo físico
    //         Storage::disk('public')->delete($sonido->archivo_audio);
            
    //         // Eliminar registro de BD
    //         $sonido->delete();
    //     }

    //     return Redirect::route('sonidos.index')->with('success', 'Sonido eliminado');
    // }

    public function index()
{
    // Obtener lista de archivos de la carpeta public/audio
    $ruta = public_path('audio');
    $archivos = [];

    if (is_dir($ruta)) {
        $archivos = array_diff(scandir($ruta), ['.', '..']);
    }

    return view('ventana sonido.index', compact('archivos'));
}

public function subirAudio(Request $request)
{
    $request->validate([
        'audio' => 'required|mimes:mp3,wav,ogg|max:20480', // 20 MB máximo
    ]);

    $archivo = $request->file('audio');
    $nombre = $archivo->getClientOriginalName();
    $archivo->move(public_path('audio'), $nombre);

    return back()->with('success', 'Audio subido correctamente.');
}

}