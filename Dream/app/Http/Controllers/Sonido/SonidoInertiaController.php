<?php

namespace App\Http\Controllers\Sonido;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sonido;
use Inertia\Inertia;

class SonidoInertiaController extends Controller
{
    //
    public function index(Request $request){
        $ruta= public_path('audio');
        $archivos=[];

        if (is_dir($ruta)){
            $archivos = array_diff(scandir($ruta), ['.', '..']);
        }
        return Inertia::render('Sonidos/Index', [
            'archivos'=>$archivos
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nombre'=>'required|string|max:255',
            'categoria'=>'nullable|string|max:255',
            'archivo_audio'=>'required|string|max:255',
            'duracion'=>'required|numeric',
            'activo'=>'required|boolean'
        ]);

        Sonido::create([
            'nombre'=>$request->nombre,
            'categoria'=>$request->categoria,
            'archivo_audio'=>$request->archivo_audio,
            'duracion'=>$request->duracion,
            'activo'=>$request->activo
        ]);

        return redirect()->back()->with('success', 'Sonido creado exitosamente.');
    }

    public function delete($id){
        $sonido = Sonido::findOrFail($id);
        $sonido->delete();

        return redirect()->back()->with('success', 'Sonido eliminado exitosamente.');
    }

    public function destroy($id){
        $sonido = Sonido::findOrFail($id);
        $sonido->delete();

        return redirect()->back()->with('success', 'Sonido eliminado exitosamente.');
    }
}
