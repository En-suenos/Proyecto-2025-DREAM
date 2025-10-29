<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproducir - {{ $playlist->nombre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a2a6c, #2c3e50);
            min-height: 100vh;
            color: white;
            padding-top: 20px;
        }
        .player-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 1000px;
            margin: 0 auto;
        }
        .playlist-header {
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .player-controls {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }
        .btn-play {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50%;
            width: 70px;
            height: 70px;
            font-size: 24px;
            transition: all 0.3s ease;
        }
        .btn-play:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .btn-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            transition: all 0.3s ease;
        }
        .btn-control:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }
        .volume-control {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .volume-slider {
            width: 120px;
        }
        .progress-container {
            margin: 20px 0;
        }
        .progress {
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-bar {
            background: linear-gradient(90deg, #4fc3f7, #29b6f6);
            transition: width 0.1s ease;
        }
        .track-list {
            max-height: 400px;
            overflow-y: auto;
        }
        .track-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .track-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        .track-item.playing {
            background: linear-gradient(135deg, rgba(79, 195, 247, 0.2), rgba(41, 182, 246, 0.2));
            border-color: #4fc3f7;
        }
        .track-info {
            display: flex;
            justify-content: between;
            align-items: center;
        }
        .track-number {
            width: 30px;
            text-align: center;
            font-weight: bold;
            color: #4fc3f7;
        }
        .track-duration {
            color: #ccc;
            font-size: 0.9em;
        }
        .current-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .current-track-title {
            font-size: 1.3em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .current-track-info {
            color: #ccc;
            font-size: 0.9em;
        }
        .playback-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            font-size: 0.9em;
            color: #ccc;
        }
        /* Scrollbar personalizado */
        .track-list::-webkit-scrollbar {
            width: 8px;
        }
        .track-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .track-list::-webkit-scrollbar-thumb {
            background: rgba(79, 195, 247, 0.5);
            border-radius: 10px;
        }
        .track-list::-webkit-scrollbar-thumb:hover {
            background: rgba(79, 195, 247, 0.7);
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="player-container">
            <!-- Header -->
            <div class="playlist-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1><i class="fas fa-play-circle me-2"></i>{{ $playlist->nombre }}</h1>
                        @if($playlist->descripcion)
                            <p class="text-muted mb-0">{{ $playlist->descripcion }}</p>
                        @endif
                        <small class="text-muted">{{ count($sonidosActivos) }} sonidos activos</small>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('playlists.show', $playlist) }}" class="btn btn-outline-light me-2">
                            <i class="fas fa-edit me-1"></i>Gestionar
                        </a>
                        <a href="{{ route('playlists.index') }}" class="btn btn-outline-light">
                            <i class="fas fa-arrow-left me-1"></i>Volver
                        </a>
                    </div>
                </div>
            </div>

            <!-- Track actual -->
            <div class="current-track">
                <div class="current-track-title" id="currentTrackTitle">
                    <i class="fas fa-music me-2"></i>Selecciona un sonido para comenzar
                </div>
                <div class="current-track-info" id="currentTrackInfo">
                    Playlist: {{ $playlist->nombre }}
                </div>
                <div class="playback-info">
                    <span id="currentTime">0:00</span>
                    <span id="totalTime">0:00</span>
                </div>
            </div>

            <!-- Controles principales -->
            <div class="player-controls">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <button class="btn btn-control" id="btnPrev" title="Anterior">
                            <i class="fas fa-step-backward"></i>
                        </button>
                        <button class="btn btn-play mx-3" id="btnPlayPause" title="Reproducir/Pausar">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="btn btn-control" id="btnNext" title="Siguiente">
                            <i class="fas fa-step-forward"></i>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <div class="progress-container">
                            <div class="progress">
                                <div class="progress-bar" id="progressBar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="volume-control justify-content-end">
                            <i class="fas fa-volume-up"></i>
                            <input type="range" class="form-range volume-slider" id="volumeSlider" 
                                   min="0" max="100" value="70" title="Volumen">
                            <span id="volumeValue">70%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de sonidos -->
            <div class="track-list">
                <h4 class="mb-3"><i class="fas fa-list me-2"></i>Lista de Reproducción</h4>
                
                @if(count($sonidosActivos) > 0)
                    @foreach($sonidosActivos as $index => $sonido)
                        <div class="track-item" data-track-index="{{ $index }}" data-src="{{ $sonido['ruta'] }}">
                            <div class="track-info">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="track-number">{{ $index + 1 }}</div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fw-bold">{{ $sonido['nombre'] }}</div>
                                        <small class="text-muted">Volumen: {{ $sonido['volumen'] }}%</small>
                                    </div>
                                </div>
                                <div class="track-duration" id="duration-{{ $index }}">--:--</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        No hay sonidos activos en esta playlist. 
                        <a href="{{ route('playlists.show', $playlist) }}" class="alert-link">Agrega algunos sonidos</a>.
                    </div>
                @endif
            </div>

            <!-- Modos de reproducción -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="loopMode" checked>
                        <label class="form-check-label" for="loopMode">
                            <i class="fas fa-redo me-1"></i>Repetición
                        </label>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="form-check form-switch d-inline-block me-3">
                        <input class="form-check-input" type="checkbox" id="shuffleMode">
                        <label class="form-check-label" for="shuffleMode">
                            <i class="fas fa-random me-1"></i>Aleatorio
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        class PlaylistPlayer {
            constructor() {
                this.audio = new Audio();
                this.tracks = document.querySelectorAll('.track-item');
                this.currentTrackIndex = 0;
                this.isPlaying = false;
                this.isShuffled = false;
                this.isLooping = true;
                this.originalOrder = Array.from(this.tracks).map((_, index) => index);
                this.shuffledOrder = [];
                
                this.initializeElements();
                this.initializeEvents();
                this.preloadDurations();
            }

            initializeElements() {
                this.btnPlayPause = document.getElementById('btnPlayPause');
                this.btnPrev = document.getElementById('btnPrev');
                this.btnNext = document.getElementById('btnNext');
                this.volumeSlider = document.getElementById('volumeSlider');
                this.volumeValue = document.getElementById('volumeValue');
                this.progressBar = document.getElementById('progressBar');
                this.currentTrackTitle = document.getElementById('currentTrackTitle');
                this.currentTrackInfo = document.getElementById('currentTrackInfo');
                this.currentTime = document.getElementById('currentTime');
                this.totalTime = document.getElementById('totalTime');
                this.loopMode = document.getElementById('loopMode');
                this.shuffleMode = document.getElementById('shuffleMode');
            }

            initializeEvents() {
                // Controles de reproducción
                this.btnPlayPause.addEventListener('click', () => this.togglePlayPause());
                this.btnPrev.addEventListener('click', () => this.previousTrack());
                this.btnNext.addEventListener('click', () => this.nextTrack());
                
                // Control de volumen
                this.volumeSlider.addEventListener('input', () => this.updateVolume());
                
                // Eventos del audio
                this.audio.addEventListener('loadedmetadata', () => this.onTrackLoaded());
                this.audio.addEventListener('timeupdate', () => this.updateProgress());
                this.audio.addEventListener('ended', () => this.onTrackEnded());
                
                // Clicks en tracks
                this.tracks.forEach((track, index) => {
                    track.addEventListener('click', () => this.playTrack(index));
                });
                
                // Modos de reproducción
                this.loopMode.addEventListener('change', () => {
                    this.isLooping = this.loopMode.checked;
                });
                
                this.shuffleMode.addEventListener('change', () => {
                    this.isShuffled = this.shuffleMode.checked;
                    if (this.isShuffled) {
                        this.shuffleTracks();
                    } else {
                        this.restoreOrder();
                    }
                });
            }

            preloadDurations() {
                this.tracks.forEach((track, index) => {
                    const tempAudio = new Audio(track.dataset.src);
                    tempAudio.addEventListener('loadedmetadata', () => {
                        const duration = this.formatTime(tempAudio.duration);
                        document.getElementById(`duration-${index}`).textContent = duration;
                    });
                });
            }

            playTrack(index) {
                this.currentTrackIndex = index;
                const track = this.tracks[this.getActualIndex(index)];
                const src = track.dataset.src;
                
                this.audio.src = src;
                this.audio.load();
                
                this.updateTrackDisplay();
                this.highlightCurrentTrack();
                
                this.audio.play().then(() => {
                    this.isPlaying = true;
                    this.updatePlayButton();
                }).catch(error => {
                    console.error('Error al reproducir:', error);
                });
            }

            togglePlayPause() {
                if (this.audio.src) {
                    if (this.isPlaying) {
                        this.audio.pause();
                    } else {
                        this.audio.play();
                    }
                    this.isPlaying = !this.isPlaying;
                    this.updatePlayButton();
                } else if (this.tracks.length > 0) {
                    this.playTrack(0);
                }
            }

            previousTrack() {
                let newIndex = this.currentTrackIndex - 1;
                if (newIndex < 0) {
                    newIndex = this.tracks.length - 1;
                }
                this.playTrack(newIndex);
            }

            nextTrack() {
                let newIndex = this.currentTrackIndex + 1;
                if (newIndex >= this.tracks.length) {
                    newIndex = 0;
                }
                this.playTrack(newIndex);
            }

            onTrackEnded() {
                if (this.isLooping) {
                    this.nextTrack();
                } else {
                    this.isPlaying = false;
                    this.updatePlayButton();
                }
            }

            onTrackLoaded() {
                this.totalTime.textContent = this.formatTime(this.audio.duration);
            }

            updateProgress() {
                if (this.audio.duration) {
                    const progress = (this.audio.currentTime / this.audio.duration) * 100;
                    this.progressBar.style.width = `${progress}%`;
                    this.currentTime.textContent = this.formatTime(this.audio.currentTime);
                }
            }

            updateVolume() {
                const volume = this.volumeSlider.value / 100;
                this.audio.volume = volume;
                this.volumeValue.textContent = `${this.volumeSlider.value}%`;
            }

            updatePlayButton() {
                const icon = this.btnPlayPause.querySelector('i');
                if (this.isPlaying) {
                    icon.className = 'fas fa-pause';
                } else {
                    icon.className = 'fas fa-play';
                }
            }

            updateTrackDisplay() {
                const track = this.tracks[this.getActualIndex(this.currentTrackIndex)];
                const trackName = track.querySelector('.fw-bold').textContent;
                this.currentTrackTitle.innerHTML = `<i class="fas fa-music me-2"></i>${trackName}`;
                this.currentTrackInfo.textContent = `Playlist: {{ $playlist->nombre }} • Track ${this.currentTrackIndex + 1} de ${this.tracks.length}`;
            }

            highlightCurrentTrack() {
                this.tracks.forEach(track => track.classList.remove('playing'));
                this.tracks[this.getActualIndex(this.currentTrackIndex)].classList.add('playing');
            }

            shuffleTracks() {
                this.shuffledOrder = [...this.originalOrder];
                for (let i = this.shuffledOrder.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [this.shuffledOrder[i], this.shuffledOrder[j]] = [this.shuffledOrder[j], this.shuffledOrder[i]];
                }
            }

            restoreOrder() {
                this.shuffledOrder = [...this.originalOrder];
            }

            getActualIndex(displayIndex) {
                if (this.isShuffled && this.shuffledOrder.length > 0) {
                    return this.shuffledOrder[displayIndex];
                }
                return displayIndex;
            }

            formatTime(seconds) {
                const mins = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${mins}:${secs.toString().padStart(2, '0')}`;
            }
        }

        // Inicializar el reproductor cuando la página cargue
        document.addEventListener('DOMContentLoaded', () => {
            new PlaylistPlayer();
        });
    </script>
</body>
</html>