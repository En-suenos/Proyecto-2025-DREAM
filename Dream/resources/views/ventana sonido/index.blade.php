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
            background: linear-gradient(135deg, #1a2a6c, #2c3e50);
            min-height: 100vh;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sound-list {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
        }
        .sound-item {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .sound-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .sound-item.playing {
            border: 2px solid rgba(79, 195, 247, 0.7);
            box-shadow: 0 0 15px rgba(79, 195, 247, 0.5);
        }
        .btn-play {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s;
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            border: none;
            color: #fff;
        }
        .btn-play:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(79, 195, 247, 0.3);
        }
        .sound-info {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .volume-control {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 150px;
        }
        .volume-slider {
            width: 100px;
        }
        .controls-global {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .btn-success {
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            border: none;
            color: #fff;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 195, 247, 0.3);
        }
        .btn-danger {
            background: rgba(255, 0, 0, 0.2);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #ffcccc;
        }
        .btn-danger:hover {
            background: rgba(255, 0, 0, 0.3);
            transform: translateY(-2px);
        }
        .btn-outline-light {
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }
        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #4fc3f7;
            border-color: #4fc3f7;
        }
        .alert-success {
            background: rgba(79, 195, 247, 0.2);
            border-color: rgba(79, 195, 247, 0.3);
            color: #4fc3f7;
        }
        .alert-info {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }
        h1, h4, h5 {
            color: #4fc3f7;
        }
        .text-primary {
            color: #4fc3f7 !important;
        }
        .btn-toggle {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #4fc3f7;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        .btn-toggle:focus {
            box-shadow: 0 0 0 0.2rem rgba(79, 195, 247, 0.25);
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

    <!-- Controles globales -->
    <div class="controls-global">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5><i class="fas fa-sliders-h me-2"></i>Controles Globales</h5>
            </div>
            <div class="col-md-6 text-end">
                <button id="playAllBtn" class="btn btn-success me-2">
                    <i class="fas fa-play"></i> Reproducir Todos
                </button>
                <button id="stopAllBtn" class="btn btn-danger">
                    <i class="fas fa-stop"></i> Detener Todos
                </button>
            </div>
        </div>
    </div>

    <!-- Lista de sonidos -->
    <div class="sound-list">
        <button class="btn btn-toggle w-100 mb-4" type="button" data-bs-toggle="collapse" data-bs-target="#soundListCollapse" aria-expanded="false" aria-controls="soundListCollapse">
            <i class="fas fa-list-ul me-2"></i>Lista de sonidos disponibles
        </button>
        <div class="collapse" id="soundListCollapse">
            @if(count($archivos) > 0)
                @foreach($archivos as $index => $archivo)
                    <div class="sound-item" data-sound-index="{{ $index }}">
                        <!-- Botón Play/Pause -->
                        <button class="btn btn-primary btn-play play-btn">
                            <i class="fas fa-play"></i>
                        </button>

                        <!-- Información del sonido -->
                        <div class="sound-info">
                            <i class="fas fa-file-audio text-primary"></i>
                            <span class="fw-bold">{{ $archivo }}</span>
                        </div>

                        <!-- Control de volumen -->
                        <div class="volume-control">
                            <i class="fas fa-volume-up"></i>
                            <input type="range" class="form-range volume-slider" min="0" max="100" value="70">
                        </div>

                        <!-- Audio oculto -->
                        <audio class="audio-player d-none" preload="metadata">
                            <source src="{{ asset('audio/' . $archivo) }}" type="audio/mpeg">
                        </audio>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info text-center mb-0">
                    <i class="fas fa-info-circle"></i> No hay sonidos disponibles. Sube uno para comenzar.
                </div>
            @endif
        </div>
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
    // Seleccionar todos los sonidos
    const soundItems = document.querySelectorAll('.sound-item');
    let playingAudios = [];

    soundItems.forEach(item => {
        const playBtn = item.querySelector('.play-btn');
        const audio = item.querySelector('.audio-player');
        const volumeSlider = item.querySelector('.volume-slider');
        const icon = playBtn.querySelector('i');

        // Configurar volumen inicial
        audio.volume = volumeSlider.value / 100;
        audio.loop = true; // Reproducción en bucle

        // Botón Play/Pause
        playBtn.addEventListener('click', function() {
            if (audio.paused) {
                // Reproducir
                audio.play();
                icon.classList.remove('fa-play');
                icon.classList.add('fa-pause');
                playBtn.classList.remove('btn-primary');
                playBtn.classList.add('btn-success');
                item.classList.add('playing');
                
                if (!playingAudios.includes(audio)) {
                    playingAudios.push(audio);
                }
            } else {
                // Pausar
                audio.pause();
                icon.classList.remove('fa-pause');
                icon.classList.add('fa-play');
                playBtn.classList.remove('btn-success');
                playBtn.classList.add('btn-primary');
                item.classList.remove('playing');
                
                playingAudios = playingAudios.filter(a => a !== audio);
            }
        });

        // Control de volumen
        volumeSlider.addEventListener('input', function() {
            audio.volume = this.value / 100;
        });
    });

    // Reproducir todos los sonidos secuencialmente
    document.getElementById('playAllBtn').addEventListener('click', function() {
        // Detener todos los sonidos primero
        playingAudios.forEach(audio => {
            audio.pause();
            audio.currentTime = 0;
        });

        soundItems.forEach(item => {
            const playBtn = item.querySelector('.play-btn');
            const icon = playBtn.querySelector('i');
            
            icon.classList.remove('fa-pause');
            icon.classList.add('fa-play');
            playBtn.classList.remove('btn-success');
            playBtn.classList.add('btn-primary');
            item.classList.remove('playing');
        });

        playingAudios = [];

        // Reproducir secuencialmente
        let currentIndex = 0;
        
        function playNext() {
            if (currentIndex < soundItems.length) {
                const currentItem = soundItems[currentIndex];
                const audio = currentItem.querySelector('.audio-player');
                const playBtn = currentItem.querySelector('.play-btn');
                const icon = playBtn.querySelector('i');

                // Reproducir el audio actual
                audio.play();
                icon.classList.remove('fa-play');
                icon.classList.add('fa-pause');
                playBtn.classList.remove('btn-primary');
                playBtn.classList.add('btn-success');
                currentItem.classList.add('playing');
                
                playingAudios.push(audio);

                // Cuando termine, reproducir el siguiente
                audio.onended = function() {
                    currentIndex++;
                    playNext();
                };
            }
        }

        // Iniciar la reproducción secuencial
        playNext();
    });

    // Detener todos los sonidos
    document.getElementById('stopAllBtn').addEventListener('click', function() {
        playingAudios.forEach(audio => {
            audio.pause();
            audio.currentTime = 0;
        });

        soundItems.forEach(item => {
            const playBtn = item.querySelector('.play-btn');
            const icon = playBtn.querySelector('i');
            
            icon.classList.remove('fa-pause');
            icon.classList.add('fa-play');
            playBtn.classList.remove('btn-success');
            playBtn.classList.add('btn-primary');
            item.classList.remove('playing');
        });

        playingAudios = [];
    });
</script>
</body>
</html>
