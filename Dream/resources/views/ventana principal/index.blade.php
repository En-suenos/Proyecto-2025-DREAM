<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - SoundScape</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Cargar Vue.js desde CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    
    <style>
        /* Mantener todos tus estilos CSS existentes */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a2a6c, #2c3e50);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
            padding-top: 90px;
        }

        .container {
            max-width: 600px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #4fc3f7;
            text-shadow: 0 0 20px rgba(79, 195, 247, 0.7);
            text-align: center;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 20px rgba(79, 195, 247, 0.7);
            }
            to {
                text-shadow: 0 0 30px rgba(79, 195, 247, 1);
            }
        }

        .tagline {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 40px;
            text-align: center;
            max-width: 400px;
        }

        .buttons-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            width: 100%;
        }

        .btn {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 20px;
            font-size: 1rem;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.4s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
        }

        .btn-icon {
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .btn-text {
            font-weight: 500;
            font-size: 0.9rem;
        }

        .btn-login {
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            border: none;
        }

        .btn-assistant {
            background: linear-gradient(45deg, #7e57c2, #5e35b1);
            border: none;
        }

        .btn-playlist {
            background: linear-gradient(45deg, #66bb6a, #43a047);
            border: none;
        }

        .btn-notification {
            background: linear-gradient(45deg, #ffa726, #fb8c00);
            border: none;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(26, 42, 108, 0.9);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: top 0.4s ease;
        }

        .navbar.hide {
            top: -160px;
        }

        .navbar-brand {
            color: #4fc3f7;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .navbar-nav {
            display: flex;
            gap: 20px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #4fc3f7;
        }

        footer {
            margin-top: 60px;
            text-align: center;
            opacity: 0.8;
            font-size: 0.9rem;
            padding: 20px;
        }

        .sound-item {
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .sound-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .notification-badge {
            position: relative;
        }
        .notification-badge .badge {
            position: absolute;
            top: -5px;
            right: -5px;
        }
        .ai-chat {
            max-height: 300px;
            overflow-y: auto;
        }
        .chat-message {
            margin-bottom: 10px;
        }
        .user-message {
            text-align: right;
        }
        .ai-message {
            text-align: left;
        }

        @media (max-width: 768px) {
            .buttons-container {
                grid-template-columns: 1fr;
            }
            
            .btn {
                padding: 18px;
                font-size: 0.95rem;
            }
            
            .navbar-nav {
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .container {
                max-width: 100%;
                padding: 0 20px;
            }
            
            .btn {
                padding: 16px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor principal de Vue -->
    <div id="app">
        <!-- Navbar con Vue -->
        <nav class="navbar" :class="{ 'hide': navbarHidden }">
            <a class="navbar-brand" href="#">SleepWell</a>
            <div class="navbar-nav">
                <a class="nav-link" href="#"><i class="fas fa-globe me-1"></i>Idioma</a>
                <a class="nav-link" href="#"><i class="fas fa-cog me-1"></i>Configuración</a>
            </div>
        </nav>

        <!-- Contenido existente adaptado para Vue -->
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="main-container p-5 text-white">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h1 class="fw-bold mb-2">
                                <i class="fas fa-headphones me-2"></i>SoundScape
                            </h1>
                            <div class="badge bg-warning">
                                <i class="fas fa-user-clock me-1"></i> Sin iniciar sesión
                            </div>
                        </div>

                        <!-- Botones de acción con Vue -->
                        <div class="text-center mb-4">
                            <p class="tagline">"Mientras sueñas, tu cerebro combina recuerdos y emociones para crear nuevas ideas y fortalecer la memoria"</p>
                        </div>

                        <button class="btn btn-primary w-100 mb-3" @click="toggleModoSueno">
                            <i :class="modoSuenoActivo ? 'fas fa-pause-circle' : 'fas fa-moon'" class="me-2"></i>
                            {{ modoSuenoActivo ? 'Detener sueño' : 'Iniciar sueño' }}
                        </button>

                        <a href="{{ route('inicio_sesion.index') }}" class="btn btn-success w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenedor de botones principales con Vue -->
        <div class="container">
            <div class="logo">SleepWell</div>
            <p class="tagline">Tu compañero inteligente para un sueño reparador</p>
            
            <div class="buttons-container">
                <a href="{{ route('inicio_sesion.index') }}" class="btn btn-login" @click="handleButtonClick">
                    <i class="fas fa-sign-in-alt btn-icon"></i>
                    <span class="btn-text">Inicio de Sesión</span>
                </a>
                
                <a href="#" class="btn btn-notification" @click="showNotification">
                    <i class="fas fa-bell btn-icon"></i>
                    <span class="btn-text">Notificaciones</span>
                </a>
            </div>
            
            <footer>
                <p class="tagline">Mientras duermes, tu cerebro se limpia de toxinas acumuladas durante el día, como si se "reiniciara" para funcionar mejor al despertar.</p>
                <p>SleepWell &copy; 2023 - Mejora tu sueño, mejora tu vida</p>
                <small>Versión 1.0.0 | <a href="#" style="color: #4fc3f7;">Política de Privacidad</a></small>
            </footer>
        </div>

        <!-- Toast Container para Vue -->
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1050"></div>
    </div>

    <!-- Incluir Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript de Vue -->
    <script>
        const { createApp } = Vue;
        
        createApp({
            data() {
                return {
                    navbarHidden: false,
                    lastScrollTop: 0,
                    modoSuenoActivo: false,
                    currentAudio: null,
                    sonidos: [
                        "{{ asset('audio/Sonido-7.mp3') }}",
                        "{{ asset('audio/Sonido-4.mp3') }}",
                        "{{ asset('audio/Sonido-5.mp3') }}",
                        "{{ asset('audio/Sonido-6.mp3') }}"
                    ]
                }
            },
            mounted() {
                this.setupScrollListener();
                this.setupButtonAnimations();
            },
            methods: {
                setupScrollListener() {
                    window.addEventListener('scroll', this.handleScroll);
                },
                handleScroll() {
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    
                    if (scrollTop > this.lastScrollTop) {
                        this.navbarHidden = true;
                    } else {
                        this.navbarHidden = false;
                    }
                    
                    this.lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                },
                setupButtonAnimations() {
                    const observerOptions = {
                        threshold: 0.1,
                        rootMargin: '0px 0px -50px 0px'
                    };

                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach((entry, index) => {
                            if (entry.isIntersecting) {
                                setTimeout(() => {
                                    entry.target.style.opacity = '1';
                                    entry.target.style.transform = 'translateY(0)';
                                }, index * 100);
                            }
                        });
                    }, observerOptions);

                    document.querySelectorAll('.btn').forEach(btn => {
                        btn.style.opacity = '0';
                        btn.style.transform = 'translateY(20px)';
                        btn.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                        observer.observe(btn);
                    });
                },
                toggleModoSueno() {
                    if (this.modoSuenoActivo) {
                        this.detenerModoSueno();
                    } else {
                        this.iniciarModoSueno();
                    }
                },
                iniciarModoSueno() {
                    const audio = new Audio();
                    const sonidoAleatorio = this.sonidos[Math.floor(Math.random() * this.sonidos.length)];
                    
                    audio.src = sonidoAleatorio;
                    audio.loop = true;
                    audio.volume = 0.10;
                    
                    audio.play().then(() => {
                        this.modoSuenoActivo = true;
                        this.currentAudio = audio;
                        this.mostrarNotificacion('Modo sueño activado', 'Sonidos relajantes reproduciéndose...');
                    }).catch(error => {
                        console.error('Error al reproducir el sonido:', error);
                        this.mostrarToast('No se pudo reproducir el sonido. Verifica que los archivos de audio estén disponibles.');
                    });
                },
                detenerModoSueno() {
                    if (this.currentAudio) {
                        this.currentAudio.pause();
                        this.currentAudio.currentTime = 0;
                        this.currentAudio = null;
                    }
                    this.modoSuenoActivo = false;
                    this.mostrarNotificacion('Modo sueño desactivado', 'Sonidos detenidos');
                },
                handleButtonClick(event) {
                    // Animación de clic
                    event.target.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        event.target.style.transform = '';
                    }, 150);
                },
                showNotification(event) {
                    event.preventDefault();
                    this.mostrarToast('Funcionalidad de notificaciones próximamente disponible.');
                },
                mostrarNotificacion(titulo, mensaje) {
                    const notificacion = document.createElement('div');
                    notificacion.className = 'alert alert-info position-fixed';
                    notificacion.style.cssText = `
                        top: 100px;
                        right: 20px;
                        z-index: 1050;
                        min-width: 300px;
                        background: rgba(255, 255, 255, 0.9);
                        color: #333;
                        border: none;
                        border-radius: 10px;
                        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                    `;
                    notificacion.innerHTML = `
                        <strong>${titulo}</strong><br>
                        ${mensaje}
                    `;
                    
                    document.body.appendChild(notificacion);
                    
                    setTimeout(() => {
                        notificacion.remove();
                    }, 3000);
                },
                mostrarToast(message) {
                    let toastContainer = document.querySelector('.toast-container');
                    if (!toastContainer) {
                        toastContainer = document.createElement('div');
                        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
                        toastContainer.style.zIndex = '1050';
                        document.body.appendChild(toastContainer);
                    }

                    const toast = document.createElement('div');
                    toast.className = 'toast align-items-center text-white bg-primary border-0';
                    toast.setAttribute('role', 'alert');
                    toast.innerHTML = `
                        <div class="d-flex">
                            <div class="toast-body">${message}</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    `;
                    
                    toastContainer.appendChild(toast);
                    const bsToast = new bootstrap.Toast(toast);
                    bsToast.show();
                    
                    toast.addEventListener('hidden.bs.toast', () => {
                        toast.remove();
                    });
                }
            },
            beforeUnmount() {
                window.removeEventListener('scroll', this.handleScroll);
                if (this.currentAudio) {
                    this.currentAudio.pause();
                }
            }
        }).mount('#app');
    </script>
</body>
</html>