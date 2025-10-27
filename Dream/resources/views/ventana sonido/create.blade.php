<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Sonidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }
        .sound-list {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 20px;
        }
        .sound-item {
            background: white;
            color: #333;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s;
        }
        .sound-item:hover {
            transform: translateY(-2px);
        }
        .audio-player {
            width: 100%;
        }
        .btn-play {
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h1 class="text-center mb-4">
        <i class="fas fa-music me-2"></i>Biblioteca de Sonidos
    </h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario para subir audio -->
    <div class="card bg-light text-dark mb-4">
        <div class="card-body">
            <h5><i class="fas fa-upload me-2"></i>Subir nuevo audio</h5>
            <form action="{{ route('subir.audio') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="audio" class="form-label">Selecciona un archivo de audio:</label>
                <input type="file" name="audio" accept="audio/*" class="form-control mb-3" required>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-cloud-upload-alt me-1"></i> Subir
                </button>
            </form>
        </div>
    </div>

    <!-- Lista de sonidos -->
    <div class="sound-list">
        <h4 class="text-center mb-4"><i class="fas fa-list-ul me-2"></i>Lista de sonidos disponibles</h4>

        @if(count($archivos) > 0)
            @foreach($archivos as $archivo)
                <div class="sound-item">
                    <span><i class="fas fa-file-audio me-2 text-primary"></i>{{ $archivo }}</span>
                    <audio class="audio-player" controls>
                        <source src="{{ asset('audio/' . $archivo) }}" type="audio/mpeg">
                        Tu navegador no soporta el elemento de audio.
                    </audio>
                </div>
            @endforeach
        @else
            <div class="alert alert-info text-center mb-0">
                <i class="fas fa-info-circle"></i> No hay sonidos disponibles. Sube uno para comenzar.
            </div>
        @endif
    </div>

    <!-- Botón volver -->
    <div class="text-center mt-4">
        <a href="{{ route('usuario_con_cuenta.index') }}" class="btn btn-outline-light">
            <i class="fas fa-arrow-left me-2"></i>Volver al inicio
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Obtener todos los elementos de audio
    const audioPlayers = document.querySelectorAll('.audio-player');
    
    // Agregar evento a cada reproductor
    audioPlayers.forEach(player => {
        player.addEventListener('play', function() {
            // Pausar todos los demás audios cuando uno comienza a reproducirse
            audioPlayers.forEach(otherPlayer => {
                if (otherPlayer !== player && !otherPlayer.paused) {
                    otherPlayer.pause();
                    otherPlayer.currentTime = 0; // Reiniciar al principio
                }
            });
        });
    });
</script>
</body>
</html>