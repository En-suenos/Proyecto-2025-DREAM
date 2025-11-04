<script>
import { Head, Link } from '@inertiajs/vue3';
onMounted(() => {
    const script = document.createElement('script');
    script.src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js";
    script.async = true;
    document.body.appendChild(script);
});
</script>

<template>
    <Head title="Inicio" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <div class="container py-5">
        <div class="class="row justify-content-center> 
            <div class="col-md-10 col-lg-8 ">
                <div class="main-container p-5 text-white ">
                    <!-- Header -->
                    <div class="text-center mb-4" >
                        <h1 class="fw-bold mb-2">
                            <i class="fas fa-headphones me-2"></i>SoundScape
                        </h1>
                        <div class="badge bg-warning">
                            <i class="fas fa-user-clock me-1"></i> Sin iniciar sesión
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="text-center mb-4">
                    <p class="tagline"> "Mientras sueñas, tu cerebro combina recuerdos y emociones para crear nuevas ideas y fortalecer la memoria"</p>
                    </div>

                    <button class="btn btn-primary w-200 mb-3 buttons-container" onclick="iniciarModoSueno()">
                        <i class="fas fa-moon me-2"></i>Iniciar sueño
                    </button>
                    
                </div>
            </div>
            <nav class="navbar">
                 <a class="navbar-brand" href="#">SleepWell</a>
                    <div class="navbar-nav">
         
                    <a class="nav-link" href="#"><i class="fas fa-globe me-1"></i>Idioma</a>
                    <a class="nav-link" href="#"><i class="fas fa-cog me-1"></i>Configuración</a>
                   </div>
            </nav>

            <div class="container">
                <div class="logo">SleepWell</div>
                    <p class="tagline">Tu compañero inteligente para un sueño reparador</p>
                    
                    <div class="buttons-container">
                        <a href="{{ route('inicio_sesion.index') }}" class="btn btn-login">
                            <i class="fas fa-sign-in-alt btn-icon"></i>
                            <span class="btn-text">Inicio de Sesión</span>
                        </a>
                        
                        
                        <a href="#" class="btn btn-notification">
                            <i class="fas fa-bell btn-icon"></i>
                            <span class="btn-text">Notificaciones</span>
                        </a>
                    </div>
                    <footer>
                        <p class="tagline">Mientras duermes, tu cerebro se limpia de toxinas acumuladas durante el día, como si se “reiniciara” para funcionar mejor al despertar.</p>
                        <p>SleepWell &copy; 2023 - Mejora tu sueño, mejora tu vida</p>
                        <small>Versión 1.0.0 | <a href="#" style="color: #4fc3f7;">Política de Privacidad</a></small>
                    </footer>
                </div>
        
            </div>
            
        
    </div>
    
</template>

<style>
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
            padding-top: 90px; /* o el alto de tu navbar */

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
          top: -160px; /* Desliza hacia arriba para ocultar */
        }

        
</style>

<!-- JavaScript personalizado -->
<script>
let currentAudio = null;

function reproducirSonido(src) {
    if (currentAudio) {
        currentAudio.pause();
    }

    const audio = document.querySelector(`audio[src="${src}"]`);

    const audio = document.querySelector(audio[src="${src}"]);

    if (audio) {
        audio.play();
        currentAudio = audio;
    }
}

function pausarSonido() {
    if (currentAudio) {
        currentAudio.pause();
    }
}

function detenerSonido() {
    if (currentAudio) {
        currentAudio.pause();
        currentAudio.currentTime = 0;
    }
}

function mostrarNotificaciones() {
    const notif = document.getElementById('notificaciones');
    notif.style.display = notif.style.display === 'none' ? 'block' : 'none';
}

function marcarLeidas() {
    alert('Notificaciones marcadas como leídas.');
    document.querySelector('.notification-badge .badge').textContent = '0';
}

function mostrarAI() {
    const ai = document.getElementById('asistencia-ai');
    ai.style.display = ai.style.display === 'none' ? 'block' : 'none';
}

function enviarMensajeAI() {
    const input = document.getElementById('input-ai');
    const message = input.value.trim();
    if (message) {
        const chat = document.getElementById('chat-messages');

        chat.innerHTML += `<div class="chat-message user-message"><strong>Tú:</strong> ${message}</div>`;
        input.value = '';
        // Simular respuesta AI
        setTimeout(() => {
            chat.innerHTML += `<div class="chat-message ai-message"><strong>AI:</strong> Gracias por tu mensaje. Recomiendo probar el sonido de lluvia para relajarte.</div>`;

        chat.innerHTML += <div class="chat-message user-message"><strong>Tú:</strong> ${message}</div>;
        input.value = '';
        // Simular respuesta AI
        setTimeout(() => {
            chat.innerHTML += <div class="chat-message ai-message"><strong>AI:</strong> Gracias por tu mensaje. Recomiendo probar el sonido de lluvia para relajarte.</div>;

            chat.scrollTop = chat.scrollHeight;
        }, 1000);
    }
}

// // Función para reproducir sonidos al iniciar modo sueño
// function iniciarModoSueno() {
//     // Crear elemento de audio
//     const audio = new Audio();
    
//     // Lista de sonidos disponibles (ajusta estas rutas según tu estructura en Laravel)
//     const sonidos = [
//         "{{ asset('audio/Sonido-3.mp3') }}",
//         "{{ asset('audio/Sonido-4.mp3') }}",
//         "{{ asset('audio/Sonido-5.mp3') }}",
//         "{{ asset('audio/Sonido-6.mp3') }}"
//     ];
    
//     // Seleccionar un sonido aleatorio
//     const sonidoAleatorio = sonidos[Math.floor(Math.random() * sonidos.length)];
    
//     // Configurar el audio
//     audio.src = sonidoAleatorio;
//     audio.loop = true;
//     audio.volume = 0.10;
    
//     // Reproducir el sonido
//     audio.play().then(() => {
//         console.log('Reproduciendo sonido relajante...');
        
//         // Mostrar mensaje de confirmación
//         const boton = document.querySelector('.btn-sueno');
//         const icono = boton.querySelector('i');
//         const texto = boton.querySelector('span') || document.createElement('span');
        
//         // Cambiar el botón a estado de reproducción
//         icono.className = 'fas fa-pause-circle';
//         texto.textContent = ' Detener Sueño';
//         if (!boton.querySelector('span')) {
//             boton.appendChild(texto);
//         }
        
//         // Cambiar la función del botón para detener
//         boton.onclick = function() {
//             detenerModoSueno(audio, boton);
//         };
        
//         // Mostrar notificación
//         mostrarNotificacion('Modo sueño activado', 'Sonidos relajantes reproduciéndose...');
        
//     }).catch(error => {
//         console.error('Error al reproducir el sonido:', error);
//         alert('No se pudo reproducir el sonido. Verifica que los archivos de audio estén disponibles.');
//     });
// }

// function detenerModoSueno(audio, boton) {
//     // Detener la reproducción
//     audio.pause();
//     audio.currentTime = 0;
    
//     // Restaurar el botón a su estado original
//     const icono = boton.querySelector('i');
//     const texto = boton.querySelector('span');
    
//     icono.className = 'fas fa-play-circle';
//     texto.textContent = ' Iniciar Sueño';
    
//     // Restaurar la función original
//     boton.onclick = function() {
//         iniciarModoSueno();
//     };
    
//     // Mostrar notificación
//     mostrarNotificacion('Modo sueño desactivado', 'Sonidos detenidos');
}
</script>