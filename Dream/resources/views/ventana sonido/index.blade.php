<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Sonidos - SleepWell</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4fc3f7;
            --secondary-color: #7e57c2;
            --success-color: #66bb6a;
            --dark-color: #1e3c72;
            --light-color: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-top: 20px;
        }
        
        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-shadow: 0 0 15px rgba(79, 195, 247, 0.5);
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .sound-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .sound-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
            background: rgba(255, 255, 255, 0.15);
        }
        
        .sound-card-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sound-card-body {
            padding: 20px;
        }
        
        .sound-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        
        .sound-title i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .sound-description {
            opacity: 0.8;
            margin-bottom: 15px;
        }
        
        .sound-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        
        .play-btn {
            background: linear-gradient(45deg, var(--primary-color), #29b6f6);
            border: none;
            color: white;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .play-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(79, 195, 247, 0.4);
        }
        
        .play-btn i {
            margin-right: 8px;
        }
        
        .volume-control {
            display: flex;
            align-items: center;
            width: 60%;
        }
        
        .volume-control i {
            margin-right: 10px;
            opacity: 0.8;
        }
        
        .volume-slider {
            width: 100%;
            -webkit-appearance: none;
            height: 5px;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            outline: none;
        }
        
        .volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--primary-color);
            cursor: pointer;
        }
        
        .progress-container {
            margin-top: 15px;
        }
        
        .progress-bar {
            height: 6px;
            border-radius: 3px;
            background: rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }
        
        .progress {
            height: 100%;
            background: var(--primary-color);
            width: 0%;
            transition: width 0.1s linear;
        }
        
        .time-display {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            opacity: 0.7;
            margin-top: 5px;
        }
        
        .sound-categories {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
        }
        
        .category-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 50px;
            padding: 8px 20px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .category-btn.active, .category-btn:hover {
            background: var(--primary-color);
            transform: scale(1.05);
        }
        
        .back-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-top: 20px;
        }
        
        .back-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            color: white;
        }
        
        .back-btn i {
            margin-right: 8px;
        }
        
        .currently-playing {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(30, 60, 114, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .currently-playing.show {
            transform: translateY(0);
        }
        
        .current-sound-info {
            display: flex;
            align-items: center;
        }
        
        .current-sound-info i {
            font-size: 1.5rem;
            margin-right: 15px;
            color: var(--primary-color);
        }
        
        .current-sound-text h5 {
            margin-bottom: 0;
            font-size: 1rem;
        }
        
        .current-sound-text p {
            margin-bottom: 0;
            font-size: 0.8rem;
            opacity: 0.8;
        }
        
        .current-sound-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        @media (max-width: 768px) {
            .sound-controls {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .volume-control {
                width: 100%;
            }
            
            .currently-playing {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .current-sound-info {
                justify-content: center;
            }
        }
        
        .favorite-btn {
            background: transparent;
            border: none;
            color: #ffc107;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }
        
        .favorite-btn:hover {
            transform: scale(1.2);
        }
        
        .sound-duration {
            font-size: 0.8rem;
            opacity: 0.7;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-music me-2"></i>Biblioteca de Sonidos</h1>
            <p>Descubre sonidos relajantes para mejorar tu sueño y concentración</p>
        </div>
        
        <div class="sound-categories">
            <button class="category-btn active" data-category="all">Todos</button>
            <button class="category-btn" data-category="nature">Naturaleza</button>
            <button class="category-btn" data-category="ambient">Ambientales</button>
            <button class="category-btn" data-category="white">Ruido Blanco</button>
            <button class="category-btn" data-category="water">Agua</button>
        </div>
        
        <div class="row" id="sounds-container">
            <div class="col-lg-6 mb-4" data-categories="nature water">
                <div class="sound-card">
                    <div class="sound-card-header">
                        <h3 class="sound-title"><i class="fas fa-cloud-rain"></i>Sonido de Lluvia</h3>
                        <p class="sound-description">Relajante lluvia constante con truenos suaves</p>
                        <div class="sound-duration">Duración: 60 min</div>
                    </div>
                    <div class="sound-card-body">
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" id="progress-rain"></div>
                            </div>
                            <div class="time-display">
                                <span id="current-time-rain">0:00</span>
                                <span id="duration-rain">1:00:00</span>
                            </div>
                        </div>
                        <div class="sound-controls">
                            <button class="play-btn" data-sound="rain">
                                <i class="fas fa-play"></i> Reproducir
                            </button>
                            <div class="volume-control">
                                <i class="fas fa-volume-up"></i>
                                <input type="range" class="volume-slider" min="0" max="100" value="50" data-sound="rain">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4" data-categories="nature water">
                <div class="sound-card">
                    <div class="sound-card-header">
                        <h3 class="sound-title"><i class="fas fa-water"></i>Olas del Mar</h3>
                        <p class="sound-description">Sonido de olas suaves en la playa</p>
                        <div class="sound-duration">Duración: 45 min</div>
                    </div>
                    <div class="sound-card-body">
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" id="progress-waves"></div>
                            </div>
                            <div class="time-display">
                                <span id="current-time-waves">0:00</span>
                                <span id="duration-waves">0:45:00</span>
                            </div>
                        </div>
                        <div class="sound-controls">
                            <button class="play-btn" data-sound="waves">
                                <i class="fas fa-play"></i> Reproducir
                            </button>
                            <div class="volume-control">
                                <i class="fas fa-volume-up"></i>
                                <input type="range" class="volume-slider" min="0" max="100" value="50" data-sound="waves">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4" data-categories="nature ambient">
                <div class="sound-card">
                    <div class="sound-card-header">
                        <h3 class="sound-title"><i class="fas fa-tree"></i>Bosque Sereno</h3>
                        <p class="sound-description">Sonidos del bosque con pájaros y brisa</p>
                        <div class="sound-duration">Duración: 50 min</div>
                    </div>
                    <div class="sound-card-body">
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" id="progress-forest"></div>
                            </div>
                            <div class="time-display">
                                <span id="current-time-forest">0:00</span>
                                <span id="duration-forest">0:50:00</span>
                            </div>
                        </div>
                        <div class="sound-controls">
                            <button class="play-btn" data-sound="forest">
                                <i class="fas fa-play"></i> Reproducir
                            </button>
                            <div class="volume-control">
                                <i class="fas fa-volume-up"></i>
                                <input type="range" class="volume-slider" min="0" max="100" value="50" data-sound="forest">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4" data-categories="white ambient">
                <div class="sound-card">
                    <div class="sound-card-header">
                        <h3 class="sound-title"><i class="fas fa-fan"></i>Ventilador</h3>
                        <p class="sound-description">Sonido constante de ventilador para enmascarar ruidos</p>
                        <div class="sound-duration">Duración: 8 horas</div>
                    </div>
                    <div class="sound-card-body">
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" id="progress-fan"></div>
                            </div>
                            <div class="time-display">
                                <span id="current-time-fan">0:00</span>
                                <span id="duration-fan">8:00:00</span>
                            </div>
                        </div>
                        <div class="sound-controls">
                            <button class="play-btn" data-sound="fan">
                                <i class="fas fa-play"></i> Reproducir
                            </button>
                            <div class="volume-control">
                                <i class="fas fa-volume-up"></i>
                                <input type="range" class="volume-slider" min="0" max="100" value="50" data-sound="fan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Llamas -->
            <div class="col-lg-6 mb-4" data-categories="nature ambient">
                <div class="sound-card">
                    <div class="sound-card-header">
                        <h3 class="sound-title"><i class="fas fa-fire"></i>Fuego Crepitante</h3>
                        <p class="sound-description">Sonido relajante de llamas crepitantes</p>
                        <div class="sound-duration">Duración: 30 min</div>
                    </div>
                    <div class="sound-card-body">
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" id="progress-fire"></div>
                            </div>
                            <div class="time-display">
                                <span id="current-time-fire">0:00</span>
                                <span id="duration-fire">0:30:00</span>
                            </div>
                        </div>
                        <div class="sound-controls">
                            <button class="play-btn" data-sound="fire">
                                <i class="fas fa-play"></i> Reproducir
                            </button>
                            <div class="volume-control">
                                <i class="fas fa-volume-up"></i>
                                <input type="range" class="volume-slider" min="0" max="100" value="50" data-sound="fire">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4" data-categories="white ambient">
                <div class="sound-card">
                    <div class="sound-card-header">
                        <h3 class="sound-title"><i class="fas fa-wave-square"></i>Ruido Blanco</h3>
                        <p class="sound-description">Sonido constante para mejorar la concentración</p>
                        <div class="sound-duration">Duración: 2 horas</div>
                    </div>
                    <div class="sound-card-body">
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" id="progress-white"></div>
                            </div>
                            <div class="time-display">
                                <span id="current-time-white">0:00</span>
                                <span id="duration-white">2:00:00</span>
                            </div>
                        </div>
                        <div class="sound-controls">
                            <button class="play-btn" data-sound="white">
                                <i class="fas fa-play"></i> Reproducir
                            </button>
                            <div class="volume-control">
                                <i class="fas fa-volume-up"></i>
                                <input type="range" class="volume-slider" min="0" max="100" value="50" data-sound="white">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <a href="{{ route('ventana-principal') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Volver a la página principal
            </a>
        </div>
    </div>
    <div class="currently-playing" id="currently-playing">
        <div class="current-sound-info">
            <i class="fas fa-music"></i>
            <div class="current-sound-text">
                <h5 id="current-sound-title">Sonido de Lluvia</h5>
                <p id="current-sound-desc">Reproduciendo...</p>
            </div>
        </div>
        <div class="current-sound-controls">
            <button class="play-btn" id="current-play-btn">
                <i class="fas fa-pause"></i> Pausar
            </button>
            <button class="favorite-btn" id="favorite-btn">
                <i class="far fa-heart"></i>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const playButtons = document.querySelectorAll('.play-btn');
            const volumeSliders = document.querySelectorAll('.volume-slider');
            const progressBars = document.querySelectorAll('.progress');
            const currentTimeDisplays = document.querySelectorAll('.time-display span:first-child');
            const categoryButtons = document.querySelectorAll('.category-btn');
            const soundsContainer = document.getElementById('sounds-container');
            const currentlyPlaying = document.getElementById('currently-playing');
            const currentSoundTitle = document.getElementById('current-sound-title');
            const currentSoundDesc = document.getElementById('current-sound-desc');
            const currentPlayBtn = document.getElementById('current-play-btn');
            const favoriteBtn = document.getElementById('favorite-btn');
        
            let currentSound = null;
            let isPlaying = false;
            let progressIntervals = {};
            let audioElements = {};

            const soundData = {
                rain: { 
                    title: 'Sonido de Lluvia', 
                    desc: 'Relajante lluvia constante con truenos suaves',
                    duration: 3600
                },
                waves: { 
                    title: 'Olas del Mar', 
                    desc: 'Sonido de olas suaves en la playa',
                    duration: 2700 
                },
                forest: { 
                    title: 'Bosque Sereno', 
                    desc: 'Sonidos del bosque con pájaros y brisa',
                    duration: 3000
                },
                fan: { 
                    title: 'Ventilador', 
                    desc: 'Sonido constante de ventilador para enmascarar ruidos',
                    duration: 28800
                },
                fire: { 
                    title: 'Fuego Crepitante', 
                    desc: 'Sonido relajante de llamas crepitantes',
                    duration: 1800
                },
                white: { 
                    title: 'Ruido Blanco', 
                    desc: 'Sonido constante para mejorar la concentración',
                    duration: 7200
                }
            };
            
            function initSoundControls() {
                playButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const soundId = this.getAttribute('data-sound');
                        togglePlayback(soundId, this);
                    });
                });
                
                volumeSliders.forEach(slider => {
                    slider.addEventListener('input', function() {
                        const soundId = this.getAttribute('data-sound');
                        setVolume(soundId, this.value);
                    });
                });
                
                Object.keys(soundData).forEach(soundId => {
                    const duration = soundData[soundId].duration;
                    const durationDisplay = document.getElementById(`duration-${soundId}`);
                    if (durationDisplay) {
                        durationDisplay.textContent = formatTime(duration);
                    }
                });
            }
            function togglePlayback(soundId, button) {
                if (currentSound === soundId && isPlaying) {
                    pauseSound(soundId, button);
                    return;
                }
                
                if (currentSound && currentSound !== soundId) {
                    pauseSound(currentSound);
                }
                

                playSound(soundId, button);
            }
            
            function playSound(soundId, button) {
            
                currentSound = soundId;
                isPlaying = true;
                updatePlayButtons(soundId, true);
                showCurrentlyPlaying(soundId);
                simulatePlayback(soundId);
                if (button) {
                    button.innerHTML = '<i class="fas fa-pause"></i> Pausar';
                }
                currentPlayBtn.innerHTML = '<i class="fas fa-pause"></i> Pausar';
            }
            
            function pauseSound(soundId, button) {
                isPlaying = false;  
                updatePlayButtons(soundId, false);
                if (progressIntervals[soundId]) {
                    clearInterval(progressIntervals[soundId]);
                    delete progressIntervals[soundId];
                }
                if (button) {
                    button.innerHTML = '<i class="fas fa-play"></i> Reproducir';
                }
                currentPlayBtn.innerHTML = '<i class="fas fa-play"></i> Reproducir';
            }
            function updatePlayButtons(activeSoundId, playing) {
                playButtons.forEach(button => {
                    const soundId = button.getAttribute('data-sound');
                    if (soundId === activeSoundId) {
                        button.innerHTML = playing ? 
                            '<i class="fas fa-pause"></i> Pausar' : 
                            '<i class="fas fa-play"></i> Reproducir';
                    } else {
                        button.innerHTML = '<i class="fas fa-play"></i> Reproducir';
                    }
                });
            }
            function showCurrentlyPlaying(soundId) {
                const sound = soundData[soundId];
                currentSoundTitle.textContent = sound.title;
                currentSoundDesc.textContent = sound.desc;
                currentlyPlaying.classList.add('show');
            }
            
            function hideCurrentlyPlaying() {
                currentlyPlaying.classList.remove('show');
                currentSound = null;
                isPlaying = false;
            }
            
            function simulatePlayback(soundId) {
                const progressBar = document.getElementById(`progress-${soundId}`);
                const currentTimeDisplay = document.getElementById(`current-time-${soundId}`);
                const duration = soundData[soundId].duration;
                
                let currentTime = 0;
                if (progressIntervals[soundId]) {
                    clearInterval(progressIntervals[soundId]);
                }
                
                progressIntervals[soundId] = setInterval(() => {
                    if (currentTime >= duration) {
                        clearInterval(progressIntervals[soundId]);
                        delete progressIntervals[soundId];
                        pauseSound(soundId);
                        return;
                    }
                    
                    currentTime++;
                    const progressPercent = (currentTime / duration) * 100;
                    
                    if (progressBar) {
                        progressBar.style.width = `${progressPercent}%`;
                    }
                    
                    if (currentTimeDisplay) {
                        currentTimeDisplay.textContent = formatTime(currentTime);
                    }
                }, 1000);
            }
            function setVolume(soundId, volume) {

                console.log(`Volumen de ${soundId} ajustado a ${volume}%`);
            }
            function formatTime(seconds) {
                const hrs = Math.floor(seconds / 3600);
                const mins = Math.floor((seconds % 3600) / 60);
                const secs = seconds % 60;
                
                if (hrs > 0) {
                    return `${hrs}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                } else {
                    return `${mins}:${secs.toString().padStart(2, '0')}`;
                }
            }
            function initCategoryFilters() {
                categoryButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        categoryButtons.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                        
                        const category = this.getAttribute('data-category');
                        
                        const soundCards = soundsContainer.querySelectorAll('.col-lg-6');
                        soundCards.forEach(card => {
                            const categories = card.getAttribute('data-categories');
                            
                            if (category === 'all' || categories.includes(category)) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    });
                });
            }
            
            function initCurrentlyPlayingControls() {
                currentPlayBtn.addEventListener('click', function() {
                    if (currentSound) {
                        if (isPlaying) {
                            pauseSound(currentSound);
                        } else {
                            playSound(currentSound);
                        }
                    }
                });
                
                favoriteBtn.addEventListener('click', function() {
                    this.classList.toggle('fas');
                    this.classList.toggle('far');
                });
            }
    
            initSoundControls();
            initCategoryFilters();
            initCurrentlyPlayingControls();
        });
    </script>
</body>
</html>