<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación PlayList con múltiples vistas y autenticación.">
    <title>Aplicación PlayList</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
 
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .hidden {
            display: none; 
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .main-content {
            margin-top: 20px;
        }
        .alert-custom {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    
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

        function mostrarLogin() {
            mostrarVista('login');
        }

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
            e.preventDefault();
            validarLogin();
        });

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
    </script>
</body>
</html>
