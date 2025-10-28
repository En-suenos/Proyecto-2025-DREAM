<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Playlist - {{ $playlist->nombre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a2a6c, #2c3e50);
            min-height: 100vh;
            color: white;
            padding-top: 20px;
        }
        .edit-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 800px;
            margin: 0 auto;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 10px;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #4fc3f7;
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(79, 195, 247, 0.25);
        }
        .form-label {
            color: #4fc3f7;
            font-weight: 600;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-outline-light {
            border-radius: 25px;
            padding: 12px 30px;
        }
        .playlist-header {
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .info-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="edit-container">
            <!-- Header -->
            <div class="playlist-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1><i class="fas fa-edit me-2"></i>Editar Playlist</h1>
                        <p class="text-muted mb-0">Modifica los detalles de tu playlist</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('playlists.index') }}" class="btn btn-outline-light">
                            <i class="fas fa-arrow-left me-2"></i>Volver
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mensajes -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Formulario de edición -->
            <form action="{{ route('playlists.update', $playlist) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">
                                <i class="fas fa-heading me-2"></i>Nombre de la Playlist
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre', $playlist->nombre) }}" 
                                   required 
                                   placeholder="Ingresa el nombre de tu playlist">
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="form-label">
                                <i class="fas fa-align-left me-2"></i>Descripción
                            </label>
                            <textarea class="form-control" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="4" 
                                      placeholder="Describe tu playlist...">{{ old('descripcion', $playlist->descripcion) }}</textarea>
                            <div class="form-text text-muted">
                                Opcional: Una descripción ayuda a identificar el propósito de tu playlist.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Información de la playlist -->
                        <div class="info-card">
                            <h5><i class="fas fa-info-circle me-2"></i>Información</h5>
                            <div class="mb-2">
                                <small class="text-muted">Sonidos en la playlist:</small>
                                <div class="fw-bold">{{ $playlist->cantidad_sonidos }}</div>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted">Creada:</small>
                                <div class="fw-bold">{{ $playlist->created_at->format('d/m/Y') }}</div>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted">Última modificación:</small>
                                <div class="fw-bold">{{ $playlist->updated_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>

                        <!-- Acciones rápidas -->
                        <div class="info-card mt-3">
                            <h5><i class="fas fa-bolt me-2"></i>Acciones Rápidas</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('playlists.show', $playlist) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-music me-1"></i>Gestionar Sonidos
                                </a>
                                <a href="{{ route('playlists.reproducir', $playlist) }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-play me-1"></i>Reproducir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>Guardar Cambios
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('playlists.index') }}" class="btn btn-outline-light w-100">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </form>

            <!-- Sección de eliminación (opcional) -->
            <div class="mt-5 pt-4 border-top border-secondary">
                <h5 class="text-warning"><i class="fas fa-exclamation-triangle me-2"></i>Zona de Peligro</h5>
                <p class="text-muted small">
                    Eliminar esta playlist es permanente. Todos los sonidos asociados se perderán.
                </p>
                <form action="{{ route('playlists.destroy', $playlist) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-outline-danger btn-sm"
                            onclick="return confirm('¿Estás seguro de eliminar esta playlist? Esta acción no se puede deshacer.')">
                        <i class="fas fa-trash me-1"></i>Eliminar Playlist
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Contador de caracteres para la descripción
        const descripcion = document.getElementById('descripcion');
        const contador = document.createElement('small');
        contador.className = 'form-text text-muted text-end d-block';
        contador.textContent = `${descripcion.value.length}/500 caracteres`;
        
        descripcion.parentNode.appendChild(contador);

        descripcion.addEventListener('input', function() {
            contador.textContent = `${this.value.length}/500 caracteres`;
            
            if (this.value.length > 500) {
                contador.classList.remove('text-muted');
                contador.classList.add('text-danger');
            } else {
                contador.classList.remove('text-danger');
                contador.classList.add('text-muted');
            }
        });

        // Validación del nombre
        const nombre = document.getElementById('nombre');
        nombre.addEventListener('input', function() {
            if (this.value.trim().length === 0) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    </script>
</body>
</html>