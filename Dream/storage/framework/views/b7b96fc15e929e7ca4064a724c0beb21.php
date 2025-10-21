<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Página Principal - SoundScape</title>


    <title>Página Principal - SoundScape</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
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
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
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

                    <!-- Navegación rápida con idioma a la izquierda -->
                     <!--
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <select id="idiomaSelect" class="form-select form-select-sm bg-transparent text-white border-light me-3" onchange="cambiarIdioma()">
                                <option value="es" selected>Español</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                        
                        <div class="d-flex">

                            <!- Enlace a la vista de inicio de sesión 
                            <a href="<?php echo e(route('inicio_sesion.index')); ?>" class="btn btn-outline-light me-2">

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
                    </div> -->

                    <!-- Sección de Sonidos -->
                     <!--
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
                    </div>-->

                    <!-- Sección de Notificaciones (oculta por defecto) -->
                     <!--
                    <div id="notificaciones" class="card bg-transparent border-light mb-4" style="display: none;">
                        <div class="card-body">
                            <h4><i class="fas fa-bell me-2"></i>Notificaciones</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-info-circle me-2">Nueva actualización disponible.</li>
                                <li class="mb-2"><i class="fas fa-music me-2">Canción recomendada: "Relajación Total".</li>
                                <li><i class="fas fa-user me-2">Recuerda iniciar sesión para guardar tus preferencias.</li>
                            </ul>
                            <button class="btn btn-sm btn-outline-light" onclick="marcarLeidas()">Marcar como leídas</button>
                        </div>
                    </div>
                     -->

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
                    <div class="text-center mb-4">
                    <p class="tagline"> "Mientras sueñas, tu cerebro combina recuerdos y emociones para crear nuevas ideas y fortalecer la memoria"</p>
                    </div>

                    <button class="btn btn-primary w-200 mb-3 buttons-container" onclick="iniciarModoSueno()">
                        <i class="fas fa-moon me-2"></i>Iniciar
                    </button>

                    <!--
                     <a href="<?php echo e(route('inicio_sesion.index')); ?>" class="btn btn-success w-200"> 
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión
                     </a> -->
            
                     

                    <!--
                    <a href="login.html" class="btn btn-success w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión
                    </a>-->
                </div>
            </div>

    <nav class="navbar">
        <a class="navbar-brand" href="#">SleepWell</a>
        <div class="navbar-nav">
           <!-- <a class="nav-link" href="<?php echo e(route('perfil.index')); ?>"><i class="fas fa-user me-1"></i>Perfil</a>-->
            <a class="nav-link" href="#"><i class="fas fa-globe me-1"></i>Idioma</a>
            <a class="nav-link" href="#"><i class="fas fa-cog me-1"></i>Configuración</a>
        </div>
    </nav>

    <div class="container">
        <div class="logo">SleepWell</div>
        <p class="tagline">Tu compañero inteligente para un sueño reparador</p>
        
        <div class="buttons-container">
            <a href="<?php echo e(route('inicio_sesion.index')); ?>" class="btn btn-login">
                <i class="fas fa-sign-in-alt btn-icon"></i>
                <span class="btn-text">Inicio de Sesión</span>
            </a>
            
            <a href="#" class="btn btn-assistant">
                <i class="fas fa-robot btn-icon"></i>
                <span class="btn-text">Asistente de Sueño</span>
            </a>
            
            <a href="#" class="btn btn-playlist">
                <i class="fas fa-music btn-icon"></i>
                <span class="btn-text">Playlist Relajante</span>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Funcionalidad mejorada para los botones
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn');
            
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Agregar animación de clic
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                    
                    // Aquí puedes agregar lógica adicional, como tracking o validaciones
                    const buttonText = this.querySelector('.btn-text').textContent;
                    console.log(`Navegando a: ${buttonText}`);
                    
                    // Si no hay ruta definida, mostrar mensaje
                    if (!this.href || this.href === '#') {
                        e.preventDefault();
                        showToast(`Funcionalidad "${buttonText}" próximamente disponible.`);
                    }
                });
            });
        });

        // Función para mostrar toasts (notificaciones temporales)
        function showToast(message) {
            // Crear elemento toast si no existe
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
            toast.innerHTML = 
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            ;
            
            toastContainer.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            // Remover toast después de que se oculte
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }

        // Animación de entrada escalonada para botones
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
    </script>
    <script>
    let lastScrollTop = 0;
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // Deslizando hacia abajo → ocultar navbar
            navbar.classList.add('hide');
        } else {
            // Deslizando hacia arriba → mostrar navbar
            navbar.classList.remove('hide');
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Evita valores negativos
    });
    </script>

</body>
</html>
<?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\resources\views/ventana principal/index.blade.php ENDPATH**/ ?>