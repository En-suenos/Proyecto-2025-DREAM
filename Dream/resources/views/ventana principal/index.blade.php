<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - SoundScape</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
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
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="main-container p-4 text-white">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h1 class="fw-bold mb-2">
                            <i class="fas fa-headphones me-2"></i>SoundScape
                        </h1>
                        <div class="badge bg-warning">
                            <i class="fas fa-user-clock me-1"></i> Sin iniciar sesión
                        </div>
                    </div>

                    <!-- Navegación rápida con idioma a la izquierda -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <select id="idiomaSelect" class="form-select form-select-sm bg-transparent text-white border-light me-3" onchange="cambiarIdioma()">
                                <option value="es" selected>Español</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                        <div class="d-flex">
                            <a href="login.html" class="btn btn-outline-light me-2">
                                <i class="fas fa-sign-in-alt me-1"></i>Inicio de Sesión
                            </a>
                            <button class="btn btn-outline-light notification-badge me-2" onclick="mostrarNotificaciones()">
                                <i class="fas fa-bell me-1"></i>Notificaciones
                                <span class="badge bg-danger">3</span>
                            </button>
                            <button class="btn btn-outline-light" onclick="mostrarAI()">
                                <i class="fas fa-robot me-1"></i>Asistencia AI
                            </button>
                        </div>
                    </div>

                    <!-- Sección de Sonidos -->
                    <div class="card bg-transparent border-light mb-4">
                        <div class="card-body">
                            <h4><i class="fas fa-music me-2"></i>PlayList de Sonidos</h4>
                            <p class="mb-3">Explora y reproduce sonidos relajantes</p>
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action bg-transparent text-white border-light sound-item" onclick="reproducirSonido('lluvia.mp3')">
                                    <i class="fas fa-volume-up me-2"></i>Sonido de Lluvia
                                    <audio id="audio-lluvia" src="lluvia.mp3" preload="none"></audio>
                                </div>
                                <div class="list-group-item list-group-item-action bg-transparent text-white border-light sound-item" onclick="reproducirSonido('olas.mp3')">
                                    <i class="fas fa-water me-2"></i>Olas del Mar
                                    <audio id="audio-olas" src="olas.mp3" preload="none"></audio>
                                </div>
                                <div class="list-group-item list-group-item-action bg-transparent text-white border-light sound-item" onclick="reproducirSonido('bosque.mp3')">
                                    <i class="fas fa-tree me-2"></i>Bosque Tropical
                                    <audio id="audio-bosque" src="bosque.mp3" preload="none"></audio>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-secondary me-2" onclick="pausarSonido()">Pausar</button>
                                <button class="btn btn-secondary" onclick="detenerSonido()">Detener</button>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Notificaciones (oculta por defecto) -->
                    <div id="notificaciones" class="card bg-transparent border-light mb-4" style="display: none;">
                        <div class="card-body">
                            <h4><i class="fas fa-bell me-2"></i>Notificaciones</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-info-circle me-2"></i>Nueva actualización disponible.</li>
                                <li class="mb-2"><i class="fas fa-music me-2"></i>Canción recomendada: "Relajación Total".</li>
                                <li><i class="fas fa-user me-2"></i>Recuerda iniciar sesión para guardar tus preferencias.</li>
                            </ul>
                            <button class="btn btn-sm btn-outline-light" onclick="marcarLeidas()">Marcar como leídas</button>
                        </div>
                    </div>

                    <!-- Sección de Asistencia AI (oculta por defecto) -->
                    <div id="asistencia-ai" class="card bg-transparent border-light mb-4" style="display: none;">
                        <div class="card-body">
                            <h4><i class="fas fa-robot me-2"></i>Asistencia AI</h4>
                            <div class="ai-chat mb-3" id="chat-messages">
                                <div class="chat-message ai-message">
                                    <strong>AI:</strong> ¡Hola! ¿En qué puedo ayudarte hoy? Por ejemplo, puedo recomendar sonidos o responder preguntas.
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="text" id="input-ai" class="form-control" placeholder="Escribe tu mensaje...">
                                <button class="btn btn-outline-light" onclick="enviarMensajeAI()">Enviar</button>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <button class="btn btn-primary w-100 mb-3" onclick="iniciarModoSueno()">
                        <i class="fas fa-moon me-2"></i>Iniciar sueño - Inicio el modo sueño
                    </button>
                    
                    <a href="login.html" class="btn btn-success w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión - Para iniciar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript personalizado -->
    <script>
        let currentAudio = null;

        function reproducirSonido(src) {
            if (currentAudio) {
                currentAudio.pause();
            }
            const audio = document.querySelector(`audio[src="${src}"]`);
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
                    chat.scrollTop = chat.scrollHeight;
                }, 1000);
            }
        }

        function iniciarModoSueno() {
            alert('Iniciando modo sueño... Reproduciendo sonidos relajantes.');
            // Lógica adicional: reproducir una secuencia de sonidos o redirigir
        }

        function cambiarIdioma() {
            const idioma = document.getElementById('idiomaSelect').value;
            if (idioma === 'en') {
                // Simular cambio a inglés (cambiar textos clave)
                document.querySelector('h1').innerHTML = '<i class="fas fa-headphones me-2"></i>SoundScape';
                document.querySelector('.badge').innerHTML = '<i class="fas fa-user-clock me-1"></i> Not logged in';
                // Agrega más cambios si es necesario
                alert('Idioma cambiado a Inglés (simulado).');
            } else {
                // Volver a español
                document.querySelector('h1').innerHTML = '<i class="fas fa-headphones me-2"></i>SoundScape';
                document.querySelector('.badge').innerHTML = '<i class="fas fa-user-clock me-1"></i> Sin iniciar sesión';
                alert('Idioma cambiado a Español.');
            }
        }
    </script>
</body>
</html>

