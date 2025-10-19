<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reproductor de Música con estilo de aplicación móvil moderno.">
    <title>Reproductor de musica de dormir</title>
    
<<<<<<< HEAD
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

=======
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
 
>>>>>>> ramaView2
    <style>
        /* Variables y Estilos Base */
        :root {
            --color-fondo-app: #121212;
            --color-fondo-oscuro: #1e1e1e;
            --color-texto-claro: #ffffff;
            --color-resalte-naranja: #ff5722;
            --color-resalte-azul: #007bff;
            --color-resalte-fuerte: #bb86fc; /* Púrpura/Lila para acentos */
            --color-separador: #333333;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--color-fondo-app);
            color: var(--color-texto-claro);
            margin: 0;
            padding: 0;
            display: flex; /* Para simular la estructura de la app completa */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden; /* Oculta barras de desplazamiento si la 'app' cabe en la pantalla */
        }
<<<<<<< HEAD

        /* Contenedor principal que simula la pantalla del teléfono */
        .app-container {
            width: 380px; /* Ancho típico de un smartphone en vista vertical */
            height: 800px; /* Altura para simular la pantalla */
            background-color: var(--color-fondo-oscuro);
            border-radius: 20px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            display: flex;
            flex-direction: column;
=======
        .hidden {
            display: none; 
>>>>>>> ramaView2
        }

        /* Encabezado (Header) de la app */
        .app-header {
            background-color: var(--color-fondo-app);
            padding: 15px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
            border-bottom: 1px solid var(--color-separador);
        }

        /* Barra de navegación de categorías (CANCIONES, LISTA DE REPRODUCCIÓN) */
        .nav-tabs-mobile {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            padding: 10px 15px;
            background-color: var(--color-fondo-oscuro);
        }

        .nav-link-mobile {
            text-decoration: none;
            color: var(--color-texto-claro);
            font-size: 0.9rem;
            font-weight: 500;
            padding-bottom: 5px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s, border-bottom 0.3s;
            text-transform: uppercase;
        }

        .nav-link-mobile.active {
            opacity: 1;
            border-bottom: 3px solid var(--color-resalte-fuerte);
            font-weight: bold;
        }

        /* Contenido de la lista de canciones */
        .song-list-content {
            flex-grow: 1; /* Ocupa el espacio restante */
            overflow-y: auto; /* Permite desplazamiento si la lista es larga */
            padding-bottom: 10px;
        }

        /* Item de la lista: Barajar Todo */
        .shuffle-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 15px;
            cursor: pointer;
            transition: background-color 0.2s;
            color: var(--color-resalte-fuerte);
            font-weight: bold;
        }

        .shuffle-icon {
            font-size: 1.2rem;
        }
        
        /* Estilo de la canción individual */
        .song-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid var(--color-separador);
            transition: background-color 0.2s;
        }

        .song-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .song-item-image {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            margin-right: 15px;
            object-fit: cover;
        }

        .song-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.2;
        }

        .song-title {
            font-size: 1rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .song-artist {
            font-size: 0.85rem;
            color: #aaaaaa; /* Tono de gris para el artista */
        }
        
        .song-details {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .song-duration {
            font-size: 0.75rem;
            color: #777777; /* Tono de gris más oscuro para la duración */
        }

        /* Etiqueta de calidad (HQ) */
        .song-quality-tag {
            background-color: var(--color-resalte-naranja);
            color: #fff;
            padding: 1px 5px;
            border-radius: 3px;
            font-size: 0.6rem;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        /* Icono de opciones (tres puntos) */
        .song-options-icon {
            font-size: 1.5rem;
            color: #888888;
        }
        
        /* Clase para la canción actual (ejemplo: Esa Diva) */
        .song-item.playing .song-title {
            color: var(--color-resalte-fuerte);
        }
        
        /* Ocultar vistas no necesarias en este ejemplo */
        .hidden { display: none; }
    </style>
</head>
<body>
<<<<<<< HEAD

    <div class="app-container">
        <header class="app-header">
            Reproductor de Música
        </header>

        <nav class="nav-tabs-mobile">
            <a href="#" class="nav-link-mobile active" id="tab-canciones">CANCIONES</a>
            <a href="#" class="nav-link-mobile" id="tab-playlist">LISTA DE REPRODUCCIÓN</a>
        </nav>

        <div id="canciones-content" class="song-list-content">

            <div class="shuffle-item" onclick="shuffleAll()">
                <i class="bi bi-shuffle shuffle-icon"></i>
                <span>Barajar Todo</span>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/FF5722/FFFFFF?text=A1" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">Still Luvin</div>
                    <div class="song-artist">Delassa, Quevedo, Bigla The...</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">3:09</span>
                    <span class="song-quality-tag" style="background-color: var(--color-resalte-azul);">HQ</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
=======
    
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" onclick="mostrarVista('principal')">☰ PlayList</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Mostrar menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#" onclick="mostrarVista('perfil')">Mi perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="mostrarVista('playlists')">PlayLists</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="mostrarVista('asistente')">Asistente</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="mostrarVista('opciones')">Opciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="iniciarSueno()">Iniciar sueño</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="mostrarLogin()">Iniciar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

   
    <main class="container main-content">
        
        <div id="principal" class="hidden">
            <h1>Ventana principal con cuenta</h1>
            <p>Bienvenido, usuario logueado. Accede a: <a href="#" onclick="mostrarVista('perfil')">Mi perfil</a>, <a href="#" onclick="mostrarVista('playlists')">PlayLists</a>, etc.</p>
        </div>

        
        <div id="perfil" class="hidden">
            <h2>Ventana de Mi perfil</h2>
            <ul>
                <li><a href="#" onclick="mostrarVista('notificaciones')">Notificaciones</a></li>
                <li><a href="#" onclick="mostrarVista('idiomas')">Idiomas</a></li>
                <li><a href="#" onclick="mostrarVista('sonidosFavoritos')">Sonidos favoritos</a></li>
                <li><a href="#" onclick="mostrarVista('misDatos')">Mis datos</a></li>
            </ul>
            <button onclick="regresar('principal')">Regresa a la ventana principal</button>
        </div>

        <div id="notificaciones" class="hidden">
            <h2>Ventana de Notificaciones</h2>
            <p>Lista cronológica: Notificación 1, Notificación 2.</p>
            <button onclick="marcarLeidas()">Marcar todas como leídas</button>
            <button onclick="regresar('perfil')">Regresa al perfil</button>
        </div>

        
        <div id="idiomas" class="hidden">
            <h2>Ventana de Idiomas</h2>
            <select id="paisSelect">
                <option value="es">España</option>
                <option value="us">Estados Unidos</option>
            </select>
            <select id="idiomaSelect">
                <option value="es">Español</option>
                <option value="en">Inglés</option>
            </select>
            <button onclick="actualizarIdioma()">Actualizar idioma</button>
            <p id="mensajeIdioma"></p>
            <button onclick="regresar('perfil')">Regresa al perfil</button>
        </div>

        <div id="sonidosFavoritos" class="hidden">
            <h2>Ventana de Sonidos Favoritos</h2>
            <ul>
                <li>Sonido1</li>
                <li>Sonido2</li>
                <li>Sonido3</li>

            </ul>
            <button onclick="regresar('perfil')">Regresa al perfil</button>
        </div>


        <div id="playlists" class="hidden">
            <h2>Ventana de PlayList</h2>
            <button onclick="crearLista()">Crear nueva lista</button>
            <button onclick="agregarSonidos()">Agregar/quitar sonidos</button>
            <button onclick="reordenarElementos()">Reordenar elementos</button>
            <button onclick="reproducirTodo()">Reproducir todo</button>
            <button onclick="regresar('principal')">Regresa al perfil</button>
        </div>

        <div id="misDatos" class="hidden">
            <h2>Ventana de Mis Datos</h2>
            <form id="formDatos">
                <input type="text" id="nombre" placeholder="Nombre">
                <input type="text" id="apellido" placeholder="Apellido">
                <input type="text" id="dni" placeholder="DNI">
                <input type="email" id="correo" placeholder="Correo">
                <input type="password" id="contrasena" placeholder="Contraseña">
                <button type="submit">Guardar</button>
            </form>
            <button onclick="regresar('perfil')">Regresa al perfil</button>
        </div>

        <!-- Vista de Asistente -->
        <div id="asistente" class="hidden">
            <h2>Ventana de Asistente</h2>
            <p>Charla con AI: <input type="text" id="inputAI" placeholder="Escribe un mensaje"></p>
            <button onclick="interactuarAI()">Enviar</button>
            <p>Sugerencias AI: Sugerencia 1, Sugerencia 2.</p>
            <button onclick="regresar('principal')">Regresa a la ventana principal</button>
        </div>

        <div id="login" class="hidden">
            <h2>Iniciar Sesión</h2>
            <form id="formLogin">
                <input type="email" id="correoLogin" placeholder="Correo">
                <input type="password" id="contrasenaLogin" placeholder="Contraseña">
                <button type="submit">Ingresar</button>
            </form>
            <p id="mensajeLogin"></p>
            <button onclick="regresar('principal')">Regresa</button>
        </div>

        <div id="principalSinSesion" class="hidden">
            <h2>Ventana principal sin iniciar sesión</h2>
            <p>Muestra la opción de PlayList: <a href="#" onclick="mostrarVista('playlists')">PlayList</a></p>
            <button onclick="mostrarLogin()">Iniciar sesión</button>
        </div>
    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
  
    <script>
        function mostrarVista(vista) {
           
            document.querySelectorAll('.main-content > div').forEach(div => div.classList.add('hidden'));
            document.getElementById(vista).classList.remove('hidden');
            
           
            if (vista === 'principal' && !localStorage.getItem('usuario')) {
                mostrarVista('principalSinSesion');
            }
        }
>>>>>>> ramaView2

            <div class="song-item">
                <img src="https://via.placeholder.com/50/4CAF50/FFFFFF?text=A2" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">GUAYA</div>
                    <div class="song-artist">RK, Quevedo</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/9C27B0/FFFFFF?text=A3" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">BAILE INOLVIDABLE</div>
                    <div class="song-artist">Bad Bunny</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item playing">
                <img src="https://via.placeholder.com/50/E91E63/FFFFFF?text=A4" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">Esa Diva</div>
                    <div class="song-artist">Melody</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/2196F3/FFFFFF?text=A5" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">NINFO</div>
                    <div class="song-artist">JC Reyes, De la Rosa...</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">3:30</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/FF9800/FFFFFF?text=A6" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">6 DE FEBRERO</div>
                    <div class="song-artist">Aitana</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/673AB7/FFFFFF?text=A7" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">MAS QUE ALGO</div>
                    <div class="song-artist">Mora, Omar Courtz</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            </div>
        
    </div>

<<<<<<< HEAD
    <script>
        function shuffleAll() {
            alert('¡Barajando todas las canciones!')
        }
        document.getElementById('tab-playlist').addEventListener('click', function(e) {
=======
        function iniciarSueno() {
            alert('Iniciando modo sueño...');
        
        }

        function validarLogin() {
            const correo = document.getElementById('correoLogin').value;
            const contrasena = document.getElementById('contrasenaLogin').value;
            if (correo && contrasena) {
                localStorage.setItem('usuario', correo); 
                document.getElementById('mensajeLogin').innerHTML = '¡Se guardaron los datos correctamente!';
                mostrarVista('principal');
            } else {
                document.getElementById('mensajeLogin').innerHTML = 'Valida los campos.';
            }
        }

        document.getElementById('formLogin').addEventListener('submit', function(e) {
>>>>>>> ramaView2
            e.preventDefault();
            this.classList.add('active');
            document.getElementById('tab-canciones').classList.remove('active');
            
            alert('Cambiando a Lista de Reproducción');
        });

<<<<<<< HEAD
        document.getElementById('tab-canciones').addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.add('active');
            document.getElementById('tab-playlist').classList.remove('active');
        });
        
=======
        function regresar(vista) { mostrarVista(vista); }
        function marcarLeidas() { alert('Marcadas como leídas'); }
        function actualizarIdioma() { document.getElementById('mensajeIdioma').innerHTML = 'Idioma actualizado correctamente'; }
        
        window.onload = function() {
            if (localStorage.getItem('usuario')) {
                mostrarVista('principal');
            } else {
                mostrarVista('principalSinSesion');
            }
        };
>>>>>>> ramaView2
    </script>
</body>
</html>
