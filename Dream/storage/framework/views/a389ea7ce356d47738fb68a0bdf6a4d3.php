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
<<<<<<< HEAD
        }
        .sound-card {
            transition: transform 0.3s;
            cursor: pointer;
        }
        .sound-card:hover {
            transform: translateY(-5px);
        }
        .sound-card.playing {
            border: 3px solid #28a745;
            box-shadow: 0 0 20px rgba(40, 167, 69, 0.5);
=======
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
            gap: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .sound-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .sound-item.playing {
            border: 2px solid #28a745;
            box-shadow: 0 0 15px rgba(40, 167, 69, 0.5);
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
        }
        .btn-play:hover {
            transform: scale(1.1);
        }
        .sound-info {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 10px;
>>>>>>> ramaProgram-v3
        }
        .volume-control {
            display: flex;
            align-items: center;
            gap: 10px;
<<<<<<< HEAD
=======
            min-width: 150px;
        }
        .volume-slider {
            width: 100px;
        }
        .controls-global {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
>>>>>>> ramaProgram-v3
        }
    </style>
</head>
<body>
<<<<<<< HEAD
<div class="container py-5">
    <div class="row mb-4">
        <div class="col">
            <h1 class="text-white text-center">
                <i class="fas fa-volume-up me-2"></i>Biblioteca de Sonidos
            </h1>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
=======

<div class="container py-5">
    <h1 class="text-center mb-4">
        <i class="fas fa-music me-2"></i>Biblioteca de Sonidos
    </h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center">
            <?php echo e(session('success')); ?>

>>>>>>> ramaProgram-v3
        </div>
    <?php endif; ?>

    <!-- Controles globales -->
<<<<<<< HEAD
    <div class="card bg-dark text-white mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5><i class="fas fa-music"></i> Reproductor Global</h5>
                    <p class="mb-0 text-muted">Reproduce múltiples sonidos simultáneamente</p>
                </div>
                <div class="col-md-6 text-end">
                    <button id="playAll" class="btn btn-success me-2">
                        <i class="fas fa-play"></i> Reproducir Todos
                    </button>
                    <button id="stopAll" class="btn btn-danger me-2">
                        <i class="fas fa-stop"></i> Detener Todos
                    </button>
                    <a href="<?php echo e(route('sonidos.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Sonido
                    </a>
                </div>
=======
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
>>>>>>> ramaProgram-v3
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <!-- Filtros -->
    <div class="mb-4 text-center">
        <button class="btn btn-outline-light filter-btn active" data-category="all">Todos</button>
        <button class="btn btn-outline-light filter-btn" data-category="naturaleza">Naturaleza</button>
        <button class="btn btn-outline-light filter-btn" data-category="meditacion">Meditación</button>
        <button class="btn btn-outline-light filter-btn" data-category="urbano">Urbano</button>
        <button class="btn btn-outline-light filter-btn" data-category="blanco">Blanco</button>
        <button class="btn btn-outline-light filter-btn" data-category="instrumental">Instrumental</button>
    </div>

    <!-- Lista de sonidos -->
    <div class="row" id="sonidos-container">
        <?php $__empty_1 = true; $__currentLoopData = $sonidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sonido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4 col-lg-3 mb-4 sound-item" data-category="<?php echo e($sonido->categoria); ?>">
                <div class="card sound-card bg-white" data-sound-id="<?php echo e($sonido->id_sonido); ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo e($sonido->nombre); ?></h5>
                        <span class="badge bg-primary mb-3"><?php echo e(ucfirst($sonido->categoria)); ?></span>

                        <!-- Audio -->
                        <audio class="audio-player" preload="metadata" controls loop>
                            <source src="<?php echo e(asset('storage/' . $sonido->archivo_audio)); ?>" type="audio/mpeg">
                            Tu navegador no soporta reproducción de audio.
                        </audio>

                        <!-- Control de volumen -->
                        <div class="volume-control my-3">
                            <i class="fas fa-volume-up text-secondary"></i>
                            <input type="range" class="form-range volume-slider" min="0" max="100" value="70" style="width: 80px;">
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-success btn-sm play-btn">
                                <i class="fas fa-play"></i>
                            </button>
                            <form action="<?php echo e(route('sonidos.destroy', $sonido->id_sonido)); ?>" method="POST" class="delete-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este sonido?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Mostrar ruta para depuración -->
                        <small class="text-muted d-block mt-2">
                            <code><?php echo e(asset('storage/' . $sonido->archivo_audio)); ?></code>
                        </small>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> No hay sonidos disponibles.
                    <a href="<?php echo e(route('sonidos.create')); ?>" class="alert-link">Agrega el primero</a>
                </div>
=======
    <!-- Lista de sonidos -->
    <div class="sound-list">
        <h4 class="text-center mb-4"><i class="fas fa-list-ul me-2"></i>Lista de sonidos disponibles</h4>

        <?php if(count($archivos) > 0): ?>
            <?php $__currentLoopData = $archivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $archivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="sound-item" data-sound-index="<?php echo e($index); ?>">
                    <!-- Botón Play/Pause -->
                    <button class="btn btn-primary btn-play play-btn">
                        <i class="fas fa-play"></i>
                    </button>

                    <!-- Información del sonido -->
                    <div class="sound-info">
                        <i class="fas fa-file-audio text-primary"></i>
                        <span class="fw-bold"><?php echo e($archivo); ?></span>
                    </div>

                    <!-- Control de volumen -->
                    <div class="volume-control">
                        <i class="fas fa-volume-up"></i>
                        <input type="range" class="form-range volume-slider" min="0" max="100" value="70">
                    </div>

                    <!-- Audio oculto -->
                    <audio class="audio-player d-none" preload="metadata">
                        <source src="<?php echo e(asset('audio/' . $archivo)); ?>" type="audio/mpeg">
                    </audio>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="alert alert-info text-center mb-0">
                <i class="fas fa-info-circle"></i> No hay sonidos disponibles. Sube uno para comenzar.
>>>>>>> ramaProgram-v3
            </div>
        <?php endif; ?>
    </div>

    <!-- Botón volver -->
    <div class="text-center mt-4">
<<<<<<< HEAD
        <a href="<?php echo e(route('usuario_con_cuenta.index')); ?>" class="btn btn-outline-light btn-lg">
            <i class="fas fa-arrow-left"></i> Volver al Inicio
=======
        <a href="<?php echo e(route('usuario_con_cuenta.index')); ?>" class="btn btn-outline-light">
            <i class="fas fa-arrow-left me-2"></i>Volver al inicio
>>>>>>> ramaProgram-v3
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
<<<<<<< HEAD
    const soundCards = document.querySelectorAll('.sound-card');
    let playingAudios = [];

    soundCards.forEach(card => {
        const audio = card.querySelector('.audio-player');
        const playBtn = card.querySelector('.play-btn');
        const volumeSlider = card.querySelector('.volume-slider');

        audio.volume = volumeSlider.value / 100;

        playBtn.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                card.classList.add('playing');
                playingAudios.push(audio);
            } else {
                audio.pause();
                playBtn.innerHTML = '<i class="fas fa-play"></i>';
                card.classList.remove('playing');
=======
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
                
>>>>>>> ramaProgram-v3
                playingAudios = playingAudios.filter(a => a !== audio);
            }
        });

<<<<<<< HEAD
=======
        // Control de volumen
>>>>>>> ramaProgram-v3
        volumeSlider.addEventListener('input', function() {
            audio.volume = this.value / 100;
        });
    });

<<<<<<< HEAD
    document.getElementById('playAll').addEventListener('click', () => {
        soundCards.forEach(card => {
            const audio = card.querySelector('.audio-player');
            const playBtn = card.querySelector('.play-btn');
            audio.play();
            playBtn.innerHTML = '<i class="fas fa-pause"></i>';
            card.classList.add('playing');
        });
    });

    document.getElementById('stopAll').addEventListener('click', () => {
=======
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
>>>>>>> ramaProgram-v3
        playingAudios.forEach(audio => {
            audio.pause();
            audio.currentTime = 0;
        });
<<<<<<< HEAD
        soundCards.forEach(card => {
            const playBtn = card.querySelector('.play-btn');
            playBtn.innerHTML = '<i class="fas fa-play"></i>';
            card.classList.remove('playing');
        });
=======

        soundItems.forEach(item => {
            const playBtn = item.querySelector('.play-btn');
            const icon = playBtn.querySelector('i');
            
            icon.classList.remove('fa-pause');
            icon.classList.add('fa-play');
            playBtn.classList.remove('btn-success');
            playBtn.classList.add('btn-primary');
            item.classList.remove('playing');
        });

>>>>>>> ramaProgram-v3
        playingAudios = [];
    });
</script>
</body>
<<<<<<< HEAD
</html>
<?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\Dream\resources\views/ventana sonido/index.blade.php ENDPATH**/ ?>
=======
</html><?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\Dream\resources\views/ventana sonido/index.blade.php ENDPATH**/ ?>
>>>>>>> ramaProgram-v3
