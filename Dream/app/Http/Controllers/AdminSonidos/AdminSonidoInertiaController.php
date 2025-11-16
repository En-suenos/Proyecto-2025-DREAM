<?php

namespace App\Http\Controllers\AdminSonidos;

use App\Http\Controllers\Controller;
use App\Models\Sonido;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminSonidoInertiaController extends Controller
{
    public function index(Request $request){
        $ruta = public_path('audio');
        $archivos = [];

        if (is_dir($ruta)){
            $archivos = array_diff(scandir($ruta), ['.', '..']);
        }
        
        return Inertia::render('AdminSonidos/Index', [
            'archivos' => $archivos
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo sonido
     */
    public function create()
    {
        return Inertia::render('AdminSonidos/Create');
    }

    /**
     * Almacena un nuevo sonido en la base de datos y en el sistema de archivos
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:mp3,wav,ogg,aac,m4a|max:10240', // 10MB máximo
            'categoria' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string|max:500'
        ]);

        try {
            // Procesar el archivo de audio
            if ($request->hasFile('archivo')) {
                $archivo = $request->file('archivo');
                
                // Generar un nombre único para el archivo
                $extension = $archivo->getClientOriginalExtension();
                $nombreArchivo = Str::slug($validated['nombre']) . '_' . time() . '.' . $extension;
                
                // Guardar el archivo en la carpeta public/audio
                $archivo->move(public_path('audio'), $nombreArchivo);

                // Guardar en la base de datos usando el modelo Sonido
                $sonido = Sonido::create([
                    'nombre' => $validated['nombre'],
                    'categoria' => $validated['categoria'],
                    'archivo_audio' => $nombreArchivo,
                    'duracion' => $this->getDuracionAudio(public_path('audio/' . $nombreArchivo)),
                    'activo' => true, // Por defecto activo
                ]);

                return redirect()->route('adminSonidos.index')
                    ->with('success', 'Sonido subido exitosamente.');
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al subir el sonido: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene la duración de un archivo de audio
     */
    private function getDuracionAudio($rutaArchivo)
    {
        try {
            // Si tienes la librería getID3 instalada
            if (class_exists('getID3')) {
                $getID3 = new \getID3;
                $fileInfo = $getID3->analyze($rutaArchivo);
                
                return $fileInfo['playtime_seconds'] ?? 0;
            }
            
            // Implementación alternativa si no tienes getID3
            return $this->getDuracionAudioSimple($rutaArchivo);
            
        } catch (\Exception $e) {
            // En caso de error, devolver duración por defecto
            return 180.0; // 3 minutos por defecto
        }
    }

    /**
     * Alternativa simple para la duración
     */
    private function getDuracionAudioSimple($rutaArchivo)
    {
        // Esta es una implementación básica
        // En producción real, deberías usar una librería adecuada
        // Por ahora devolvemos un valor fijo o calculamos basado en el tamaño
        $tamanio = filesize($rutaArchivo);
        
        // Estimación muy básica: ~1 minuto por cada 1MB para MP3
        $duracionEstimada = ($tamanio / (1024 * 1024)) * 60;
        
        // Limitar entre 30 segundos y 10 minutos
        return max(30.0, min(600.0, $duracionEstimada));
    }

    /**
     * Muestra el formulario para editar un sonido existente
     */
    public function edit($id)
    {
        $sonido = Sonido::findOrFail($id);
        
        return Inertia::render('AdminSonidos/Edit', [
            'sonido' => $sonido
        ]);
    }

    /**
     * Actualiza un sonido existente
     */
    public function update(Request $request, $id)
    {
        $sonido = Sonido::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:100',
            'activo' => 'boolean'
        ]);

        try {
            $sonido->update($validated);

            return redirect()->route('sonidos.index')
                ->with('success', 'Sonido actualizado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el sonido: ' . $e->getMessage());
        }
    }

    
    /**
     * Muestra la vista de confirmación para eliminar un sonido
     */
    public function delete($id)
    {
        $sonido = Sonido::findOrFail($id);
        
        return Inertia::render('AdminSonidos/Delete', [
            'sonido' => $sonido
        ]);
    }

    /**
     * Elimina un sonido
     */
    public function destroy($id)
    {
        $sonido = Sonido::findOrFail($id);

        try {
            // Eliminar el archivo físico
            $rutaArchivo = public_path('audio/' . $sonido->archivo_audio);
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo);
            }

            // Eliminar el registro de la base de datos
            $sonido->delete();

            return redirect()->route('sonidos.index')
                ->with('success', 'Sonido eliminado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el sonido: ' . $e->getMessage());
        }
    }
}