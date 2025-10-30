<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Playlist - {{ $playlist->nombre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a2a6c, #2c3e50);
            min-height: 100vh;
            color: white;
            padding-top: 20px;
        }
        .playlist-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sonido-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        .sonido-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }
        .btn-playlist {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-playlist:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="playlist-container">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h1><i class="fas fa-music me-2"></i>{{ $playlist->nombre }}</h1>
                    @if($playlist->descripcion)
                        <p class="text-muted">{{ $playlist->descripcion }}</p>
                    @endif
                    <small class="text-muted" id="contador-sonidos">{{ $playlist->cantidad_sonidos }} sonidos</small>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('playlists.reproducir', $playlist) }}" class="btn btn-playlist me-2">
                        <i class="fas fa-play me-1"></i>Reproducir
                    </a>
                    <a href="{{ route('playlists.index') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-1"></i>Volver
                    </a>
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

            <!-- Lista de sonidos -->
            <div class="mb-4">
                <h4><i class="fas fa-list me-2"></i>Sonidos en la Playlist</h4>
                <div class="mt-3" id="lista-sonidos">
                    @forelse($playlist->sonidos ?? [] as $sonido)
                        <div class="sonido-item" id="sonido-{{ $sonido['id'] }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="form-check form-switch me-3">
                                        <input class="form-check-input toggle-sonido" 
                                               type="checkbox" 
                                               {{ $sonido['activo'] ?? true ? 'checked' : '' }}
                                               data-playlist-id="{{ $playlist->id }}"
                                               data-sonido-id="{{ $sonido['id'] }}">
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $sonido['nombre'] }}</h6>
                                        <small class="text-muted">{{ $sonido['archivo'] }}</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="volume-control me-3">
                                        <i class="fas fa-volume-up text-muted me-2"></i>
                                        <input type="range" class="form-range volume-slider" 
                                               min="0" max="100" value="{{ $sonido['volumen'] ?? 80 }}"
                                               data-playlist-id="{{ $playlist->id }}"
                                               data-sonido-id="{{ $sonido['id'] }}">
                                    </div>
                                    <button class="btn btn-sm btn-outline-danger quitar-sonido" 
                                            data-playlist-id="{{ $playlist->id }}"
                                            data-sonido-id="{{ $sonido['id'] }}"
                                            data-sonido-archivo="{{ $sonido['archivo'] }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center" id="mensaje-vacio">
                            <i class="fas fa-info-circle me-2"></i>
                            No hay sonidos en esta playlist. Agrega algunos sonidos disponibles.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sonidos disponibles -->
            <div>
                <h4><i class="fas fa-plus me-2"></i>Agregar Sonidos Disponibles</h4>
                <div class="row mt-3" id="lista-disponibles">
                    @forelse($sonidosDisponibles as $sonido)
                        <div class="col-md-6 mb-2">
                            <div class="d-flex justify-content-between align-items-center p-3 bg-dark bg-opacity-25 rounded">
                                <div>
                                    <i class="fas fa-music text-primary me-2"></i>
                                    <span>{{ $sonido['nombre'] }}</span>
                                </div>
                                <button class="btn btn-sm btn-success agregar-sonido" 
                                        data-playlist-id="{{ $playlist->id }}"
                                        data-sonido-archivo="{{ $sonido['archivo'] }}"
                                        data-sonido-nombre="{{ $sonido['nombre'] }}">
                                    <i class="fas fa-plus me-1"></i>Agregar
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                No se encontraron archivos de sonido en la carpeta audio.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Agregar sonido
        document.querySelectorAll('.agregar-sonido').forEach(btn => {
            btn.addEventListener('click', function() {
                const playlistId = this.getAttribute('data-playlist-id');
                const archivo = this.getAttribute('data-sonido-archivo');
                const nombre = this.getAttribute('data-sonido-nombre');
                agregarSonido(playlistId, archivo, nombre, this);
            });
        });

        // Quitar sonido
        document.querySelectorAll('.quitar-sonido').forEach(btn => {
            btn.addEventListener('click', function() {
                const playlistId = this.getAttribute('data-playlist-id');
                const sonidoId = this.getAttribute('data-sonido-id');
                const archivo = this.getAttribute('data-sonido-archivo');
                quitarSonido(playlistId, sonidoId, archivo);
            });
        });

        // Actualizar volumen
        document.querySelectorAll('.volume-slider').forEach(slider => {
            slider.addEventListener('change', function() {
                const playlistId = this.getAttribute('data-playlist-id');
                const sonidoId = this.getAttribute('data-sonido-id');
                const volumen = this.value;
                actualizarVolumen(playlistId, sonidoId, volumen);
            });
        });

        // Toggle sonido activo/inactivo
        document.querySelectorAll('.toggle-sonido').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const playlistId = this.getAttribute('data-playlist-id');
                const sonidoId = this.getAttribute('data-sonido-id');
                toggleSonido(playlistId, sonidoId);
            });
        });

        // Funciones AJAX
        function agregarSonido(playlistId, archivo, nombre, boton) {
            fetch(`/playlists/${playlistId}/agregar-sonido`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ sonido_archivo: archivo })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Agregar el sonido visualmente sin recargar
                    agregarSonidoVisualmente(data.sonido, nombre, archivo);
                    // Deshabilitar el botón para evitar duplicados
                    boton.disabled = true;
                    boton.innerHTML = '<i class="fas fa-check me-1"></i>Agregado';
                    boton.classList.remove('btn-success');
                    boton.classList.add('btn-secondary');
                    // Actualizar contador
                    actualizarContador();
                } else {
                    alert('Error al agregar el sonido');
                }
            });
        }

        function agregarSonidoVisualmente(sonidoData, nombre, archivo) {
            const listaSonidos = document.getElementById('lista-sonidos');
            const playlistId = document.querySelector('[data-playlist-id]').getAttribute('data-playlist-id');
            
            // Si no hay sonidos, remover el mensaje de "no hay sonidos"
            const alertaVacio = document.getElementById('mensaje-vacio');
            if (alertaVacio) {
                alertaVacio.remove();
            }

            // Crear el nuevo elemento de sonido
            const nuevoSonido = document.createElement('div');
            nuevoSonido.className = 'sonido-item';
            nuevoSonido.id = `sonido-${sonidoData.id}`;
            nuevoSonido.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="form-check form-switch me-3">
                            <input class="form-check-input toggle-sonido" 
                                   type="checkbox" 
                                   checked
                                   data-playlist-id="${playlistId}"
                                   data-sonido-id="${sonidoData.id}">
                        </div>
                        <div>
                            <h6 class="mb-1">${nombre}</h6>
                            <small class="text-muted">${archivo}</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="volume-control me-3">
                            <i class="fas fa-volume-up text-muted me-2"></i>
                            <input type="range" class="form-range volume-slider" 
                                   min="0" max="100" value="80"
                                   data-playlist-id="${playlistId}"
                                   data-sonido-id="${sonidoData.id}">
                        </div>
                        <button class="btn btn-sm btn-outline-danger quitar-sonido" 
                                data-playlist-id="${playlistId}"
                                data-sonido-id="${sonidoData.id}"
                                data-sonido-archivo="${archivo}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;

            // Agregar el nuevo sonido a la lista
            listaSonidos.appendChild(nuevoSonido);

            // Agregar event listeners a los nuevos elementos
            nuevoSonido.querySelector('.quitar-sonido').addEventListener('click', function() {
                const playlistId = this.getAttribute('data-playlist-id');
                const sonidoId = this.getAttribute('data-sonido-id');
                const archivo = this.getAttribute('data-sonido-archivo');
                quitarSonido(playlistId, sonidoId, archivo);
            });

            nuevoSonido.querySelector('.volume-slider').addEventListener('change', function() {
                const playlistId = this.getAttribute('data-playlist-id');
                const sonidoId = this.getAttribute('data-sonido-id');
                const volumen = this.value;
                actualizarVolumen(playlistId, sonidoId, volumen);
            });

            nuevoSonido.querySelector('.toggle-sonido').addEventListener('change', function() {
                const playlistId = this.getAttribute('data-playlist-id');
                const sonidoId = this.getAttribute('data-sonido-id');
                toggleSonido(playlistId, sonidoId);
            });
        }

        function quitarSonido(playlistId, sonidoId, archivo) {
    if (!confirm('¿Estás seguro de quitar este sonido de la playlist?')) return;
    
    // CORREGIDO: Usar la ruta correcta para eliminar sonido individual
    fetch(`/playlists/${playlistId}/sonidos/${sonidoId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Eliminar el elemento del DOM inmediatamente
            const sonidoItem = document.getElementById(`sonido-${sonidoId}`);
            if (sonidoItem) {
                sonidoItem.remove();
            }
            
            // Reactivar el botón de agregar
            reactivarBotonAgregar(archivo);
            
            // Actualizar contador
            actualizarContador();
            
            // Si no quedan sonidos, mostrar mensaje
            const listaSonidos = document.getElementById('lista-sonidos');
            if (listaSonidos.children.length === 0) {
                listaSonidos.innerHTML = `
                    <div class="alert alert-info text-center" id="mensaje-vacio">
                        <i class="fas fa-info-circle me-2"></i>
                        No hay sonidos en esta playlist. Agrega algunos sonidos disponibles.
                    </div>
                `;
            }
        } else {
            alert('Error al quitar el sonido: ' + (data.message || 'Error desconocido'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error de conexión al quitar el sonido');
    });
}

        function reactivarBotonAgregar(archivo) {
            const botones = document.querySelectorAll('.agregar-sonido');
            botones.forEach(boton => {
                if (boton.getAttribute('data-sonido-archivo') === archivo) {
                    boton.disabled = false;
                    boton.innerHTML = '<i class="fas fa-plus me-1"></i>Agregar';
                    boton.classList.remove('btn-secondary');
                    boton.classList.add('btn-success');
                }
            });
        }

        function actualizarVolumen(playlistId, sonidoId, volumen) {
            fetch(`/playlists/${playlistId}/actualizar-volumen/${sonidoId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ volumen: volumen })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Feedback visual del cambio de volumen
                    const slider = document.querySelector(`.volume-slider[data-sonido-id="${sonidoId}"]`);
                    if (slider) {
                        const icon = slider.previousElementSibling;
                        if (volumen == 0) {
                            icon.className = 'fas fa-volume-mute text-muted me-2';
                        } else if (volumen < 50) {
                            icon.className = 'fas fa-volume-down text-muted me-2';
                        } else {
                            icon.className = 'fas fa-volume-up text-muted me-2';
                        }
                    }
                }
            });
        }

        function toggleSonido(playlistId, sonidoId) {
            fetch(`/playlists/${playlistId}/toggle-sonido/${sonidoId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    // Revertir el toggle si hubo error
                    const toggle = document.querySelector(`.toggle-sonido[data-sonido-id="${sonidoId}"]`);
                    if (toggle) {
                        toggle.checked = !toggle.checked;
                    }
                }
            });
        }

        function actualizarContador() {
            const sonidosItems = document.querySelectorAll('.sonido-item');
            const contador = document.getElementById('contador-sonidos');
            if (contador) {
                contador.textContent = `${sonidosItems.length} sonidos`;
            }
        }
    </script>
</body>
</html>