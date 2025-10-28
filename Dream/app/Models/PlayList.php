<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'descripcion',
        'sonidos',
        'id_usuario' // Cambiado a id_usuario
    ];

    protected $casts = [
        'sonidos' => 'array'
    ];

    // Relación con el usuario (corregida)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Obtener sonidos disponibles localmente
    public static function getSonidosDisponibles()
    {
        $sonidosPath = public_path('audio');
        $sonidos = [];
        
        if (file_exists($sonidosPath)) {
            $archivos = scandir($sonidosPath);
            foreach ($archivos as $archivo) {
                if ($archivo !== '.' && $archivo !== '..') {
                    $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    if (in_array($extension, ['mp3', 'wav', 'ogg'])) {
                        $sonidos[] = [
                            'nombre' => pathinfo($archivo, PATHINFO_FILENAME),
                            'archivo' => $archivo,
                            'ruta' => asset('audio/' . $archivo),
                            'volumen' => 80,
                            'activo' => true
                        ];
                    }
                }
            }
        }
        
        return $sonidos;
    }

    // Agregar sonido a la playlist
    public function agregarSonido($sonidoArchivo)
    {
        $sonidos = $this->sonidos ?? [];
        $sonidoInfo = $this->getInfoSonido($sonidoArchivo);
        
        if ($sonidoInfo && !$this->tieneSonido($sonidoArchivo)) {
            $sonidos[] = [
                'id' => uniqid(),
                'nombre' => $sonidoInfo['nombre'],
                'archivo' => $sonidoInfo['archivo'],
                'ruta' => $sonidoInfo['ruta'],
                'volumen' => 80,
                'activo' => true
            ];
            
            $this->update(['sonidos' => $sonidos]);
            return true;
        }
        
        return false;
    }

    // Quitar sonido de la playlist
    public function quitarSonido($sonidoId)
    {
        $sonidos = $this->sonidos ?? [];
        $sonidos = array_filter($sonidos, function($sonido) use ($sonidoId) {
            return $sonido['id'] !== $sonidoId;
        });
        
        $this->update(['sonidos' => array_values($sonidos)]);
        return true;
    }

    // Actualizar volumen de un sonido
    public function actualizarVolumen($sonidoId, $volumen)
    {
        $sonidos = $this->sonidos ?? [];
        
        foreach ($sonidos as &$sonido) {
            if ($sonido['id'] === $sonidoId) {
                $sonido['volumen'] = $volumen;
                break;
            }
        }
        
        $this->update(['sonidos' => $sonidos]);
        return true;
    }

    // Actualizar orden de los sonidos
    public function actualizarOrden($nuevoOrden)
    {
        $sonidos = $this->sonidos ?? [];
        $sonidosOrdenados = [];
        
        foreach ($nuevoOrden as $sonidoId) {
            foreach ($sonidos as $sonido) {
                if ($sonido['id'] === $sonidoId) {
                    $sonidosOrdenados[] = $sonido;
                    break;
                }
            }
        }
        
        $this->update(['sonidos' => $sonidosOrdenados]);
        return true;
    }

    // Verificar si ya tiene un sonido
    public function tieneSonido($sonidoArchivo)
    {
        $sonidos = $this->sonidos ?? [];
        
        foreach ($sonidos as $sonido) {
            if ($sonido['archivo'] === $sonidoArchivo) {
                return true;
            }
        }
        
        return false;
    }

    // Obtener información del sonido
    private function getInfoSonido($archivo)
    {
        $rutaCompleta = public_path('audio/' . $archivo);
        
        if (file_exists($rutaCompleta)) {
            return [
                'nombre' => pathinfo($archivo, PATHINFO_FILENAME),
                'archivo' => $archivo,
                'ruta' => asset('audio/' . $archivo)
            ];
        }
        
        return null;
    }

    // Contador de sonidos
    public function getCantidadSonidosAttribute()
    {
        return count($this->sonidos ?? []);
    }

    // Obtener sonidos activos
    public function getSonidosActivosAttribute()
    {
        $sonidos = $this->sonidos ?? [];
        return array_filter($sonidos, function($sonido) {
            return $sonido['activo'] ?? true;
        });
    }
}