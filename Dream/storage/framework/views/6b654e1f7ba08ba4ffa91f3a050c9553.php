<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación PlayList con múltiples vistas y autenticación.">
    <title>Vista de usuario con cuenta</title>
    
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
            padding-top: 90px; /* Ajuste para navbar */
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

        .navbar-toggler {
            border: none;
            background: none;
            color: #fff;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-collapse {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(26, 42, 108, 0.95);
            backdrop-filter: blur(10px);
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .navbar-collapse.show {
            display: block;
        }

        .navbar-nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 0;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
            padding: 10px 0;
        }

        .nav-link:hover {
            color: #4fc3f7;
        }

        @media (min-width: 769px) {
            .navbar-toggler {
                display: none;
            }

            .navbar-collapse {
                position: static;
                background: none;
                box-shadow: none;
                padding: 0;
                display: block !important;
            }

            .navbar-nav {
                flex-direction: row;
                gap: 20px;
            }

            .nav-link {
                padding: 0;
            }
        }

        .main-content {
            max-width: 1200px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            animation: fadeInUp 1s ease-out;
            margin-top: 30px;
            margin-bottom: 50px;
            min-height: 60vh;
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

        .main-content > div {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            animation: gentleFloat 8s ease-in-out infinite;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .hidden {
            display: none;
        }

        h2 {
            color: #4fc3f7;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 0 20px rgba(79, 195, 247, 0.7);
        }

        h3 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 15px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        ul li a {
            color: #4fc3f7;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        ul li a:hover {
            color: #29b6f6;
            text-decoration: underline;
        }

        .table-container {
            margin-top: 30px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
            position: relative;
            user-select: none;
        }

        th:hover {
            background: linear-gradient(45deg, #29b6f6, #0277bd);
        }

        th.asc::after {
            content: " ▲";
            font-size: 0.8em;
            opacity: 0.7;
        }

        th.desc::after {
            content: " ▼";
            font-size: 0.8em;
            opacity: 0.7;
        }

        th i {
            margin-left: 5px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: background 0.3s ease;
            color: #fff;
        }

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .badge {
            font-size: 0.85em;
        }

        .btn-custom {
            background: linear-gradient(45deg, #66bb6a, #43a047);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.4s ease;
            margin-top: 20px;
        }

        .btn-custom:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(102, 187, 106, 0.4);
            color: white;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: #fff;
        }

        .card-body {
            padding: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #ccc;
            font-size: 0.9em;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.4s ease;
            margin-top: 20px;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px) scale(1.05);
            border-color: #4fc3f7;
            color: #fff;
        }

        .text-center a {
            color: #4fc3f7;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .main-content {
                max-width: 100%;
                padding: 0 20px;
            }
            
            .main-content > div {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#" onclick="mostrarVista('principal')"><i class="fas fa-music"></i> PlayList</a>
        <button class="navbar-toggler" type="button" onclick="toggleNavbar()">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <a class="nav-link" href="#" onclick="mostrarVista('perfil')">
                    <i class="fas fa-user"></i> Mi perfil
                </a>
                <a class="nav-link" href="#" onclick="mostrarVista('playlists')">
                    <i class="fas fa-list"></i> PlayLists
                </a>
                <a class="nav-link" href="#" onclick="mostrarVista('asistente')">
                    <i class="fas fa-robot"></i> Asistente
                </a>
                <a class="nav-link" href="#" onclick="mostrarVista('opciones')">
                    <i class="fas fa-cog"></i> Opciones
                </a>
                <a class="nav-link" href="#" onclick="iniciarSueno()">
                    <i class="fas fa-moon"></i> Iniciar sueño
                </a>
                <a class="nav-link" href="#" onclick="mostrarVista('login')">
                    <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                </a>
            </div>
        </div>
    </nav>

    <main class="container main-content">
        <!-- Vista Principal -->
        <div id="principal" class="fade-in">
            <div class="text-center">
                <div class="avatar">
                    <i class="fas fa-music"></i>
                </div>
                <h2>Bienvenido, Usuario</h2>
                <p>Explora tus playlists, configura tu perfil y disfruta de la música.</p>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-list fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Mis PlayLists</h5>
                                <p class="card-text">Gestiona tus listas de reproducción favoritas.</p>
                                <a href="#" onclick="mostrarVista('playlists')" class="btn btn-custom">Ver PlayLists</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-user fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Mi Perfil</h5>
                                <p class="card-text">Configura tu información personal.</p>
                                <a href="#" onclick="mostrarVista('perfil')" class="btn btn-custom">Ir al Perfil</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-robot fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Asistente</h5>
                                <p class="card-text">Obtén ayuda con recomendaciones musicales.</p>
                                <a href="#" onclick="mostrarVista('asistente')" class="btn btn-custom">Usar Asistente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Regresar a la ventana principal
                </a>
            </div>
        </div>

        <!-- Vista Perfil -->
        <div id="perfil" class="hidden fade-in">
            <div class="text-center">
                <div class="avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h2>Mi Perfil</h2>
                <p>Administra tu información personal y preferencias.</p>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-bell"></i> Opciones Rápidas</h5>
                            <ul class="mt-3">
                                <li><a href="#"><i class="fas fa-bell"></i> Notificaciones</a></li>
                                <li><a href="#"><i class="fas fa-language"></i> Idiomas</a></li>
                                <li><a href="#"><i class="fas fa-heart"></i> Sonidos favoritos</a></li>
                                <li><a href="#"><i class="fas fa-id-card"></i> Mis datos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-container">
                        <h3><i class="fas fa-table"></i> Detalles de tu Cuenta</h3>
                        <table id="perfilTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th onclick="sortTable(0)">Campo <i class="fas fa-sort"></i></th>
                                    <th onclick="sortTable(1)">Valor <i class="fas fa-sort"></i></th>
                                </tr>
                            </thead>
                            <tbody id="perfilTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-custom" onclick="regresar('principal')"><i class="fas fa-arrow-left"></i> Regresar</button>
            </div>
        </div>

        <!-- Vista PlayLists -->
        <div id="playlists" class="hidden fade-in">
            <div class="text-center">
                <h2>Mis PlayLists</h2>
                <p>Gestiona todas tus listas de reproducción.</p>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-sun fa-2x text-warning mb-3"></i>
                            <h5>Relajación Matutina</h5>
                            <p>12 canciones</p>
                            <button class="btn btn-sm btn-custom">Reproducir</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-moon fa-2x text-info mb-3"></i>
                            <h5>Sueño Profundo</h5>
                            <p>8 canciones</p>
                            <button class="btn btn-sm btn-custom">Reproducir</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-water fa-2x text-primary mb-3"></i>
                            <h5>Sonidos de Naturaleza</h5>
                            <p>15 canciones</p>
                            <button class="btn btn-sm btn-custom">Reproducir</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-custom" onclick="regresar('principal')"><i class="fas fa-arrow-left"></i> Regresar</button>
            </div>
        </div>

        <!-- Vista Asistente -->
        <div id="asistente" class="hidden fade-in">
            <div class="text-center">
                <div class="avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <h2>Asistente Musical</h2>
                <p>¿En qué puedo ayudarte hoy?</p>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-lightbulb"></i> Recomendaciones</h5>
                            <p>Obtén recomendaciones personalizadas basadas en tu estado de ánimo.</p>
                            <button class="btn btn-custom btn-sm">Solicitar</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-plus-circle"></i> Nueva PlayList</h5>
                            <p>Crea una nueva lista de reproducción automáticamente.</p>
                            <button class="btn btn-custom btn-sm">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-custom" onclick="regresar('principal')"><i class="fas fa-arrow-left"></i> Regresar</button>
            </div>
        </div>

        <!-- Vista Opciones -->
        <div id="opciones" class="hidden fade-in">
            <div class="text-center">
                <h2>Opciones</h2>
                <p>Configura tu experiencia en la aplicación.</p>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-volume-up"></i> Audio</h5>
                            <div class="form-group">
                                <label>Volumen general</label>
                                <input type="range" class="form-range" min="0" max="100" value="75">
                            </div>
                            <div class="form-group mt-3">
                                <label>Calidad de audio</label>
                                <select class="form-select">
                                    <option>Alta</option>
                                    <option>Media</option>
                                    <option>Baja</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-palette"></i> Apariencia</h5>
                            <div class="form-group">
                                <label>Tema</label>
                                <select class="form-select">
                                    <option>Oscuro</option>
                                    <option>Claro</option>
                                    <option>Automático</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label>Idioma</label>
                                <select class="form-select">
                                    <option>Español</option>
                                    <option>Inglés</option>
                                    <option>Francés</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-custom" onclick="regresar('principal')"><i class="fas fa-arrow-left"></i> Regresar</button>
            </div>
        </div>

        <!-- Vista Login -->
        <div id="login" class="hidden fade-in">
            <div class="text-center">
                <div class="avatar">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <h2>Iniciar Sesión</h2>
                <p>Accede a tu cuenta para continuar.</p>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="tu@email.com">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control" placeholder="Tu contraseña">
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="remember">
                                    <label class="form-check-label" for="remember">Recordarme</label>
                                </div>
                                <button type="submit" class="btn btn-custom w-100">Iniciar Sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-secondary" onclick="regresar('principal')"><i class="fas fa-arrow-left"></i> Regresar</button>
            </div>
        </div>
    </main>

    <div class="footer">
        <p>&copy; 2024 Aplicación PlayList. Todos los derechos reservados. | <a href="#" class="text-decoration-none">Política de Privacidad</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleNavbar() {
            const navbarCollapse = document.getElementById('navbarNav');
            navbarCollapse.classList.toggle('show');
        }

        function mostrarVista(vistaId) {
            // Ocultar todas las vistas
            const vistas = document.querySelectorAll('.main-content > div');
            vistas.forEach(vista => {
                vista.classList.add('hidden');
            });

            // Mostrar la vista seleccionada
            const vistaSeleccionada = document.getElementById(vistaId);
            if (vistaSeleccionada) {
                vistaSeleccionada.classList.remove('hidden');
                vistaSeleccionada.classList.add('fade-in');
            }

            // Cerrar el menú móvil si está abierto
            const navbarCollapse = document.getElementById('navbarNav');
            navbarCollapse.classList.remove('show');

            // Si es la vista de perfil, cargar los datos
            if (vistaId === 'perfil') {
                cargarDatosPerfil();
            }
        }

        function regresar(vistaId) {
            mostrarVista(vistaId);
        }

        function iniciarSueno() {
            alert('Modo sueño activado. Reproduciendo sonidos relajantes...');
            // Aquí iría la lógica para iniciar el modo sueño
        }

        function cargarDatosPerfil() {
            const tablaBody = document.getElementById('perfilTableBody');
            if (!tablaBody) return;

            // Datos de ejemplo
            const datosPerfil = [
                { campo: 'Nombre', valor: 'Juan Pérez' },
                { campo: 'Email', valor: 'juan.perez@email.com' },
                { campo: 'Miembro desde', valor: 'Enero 2024' },
                { campo: 'PlayLists creadas', valor: '5' },
                { campo: 'Preferencias musicales', valor: 'Relajación, Naturaleza' },
                { campo: 'Idioma', valor: 'Español' },
                { campo: 'Notificaciones', valor: 'Activadas' },
                { campo: 'Tipo de cuenta', valor: 'Premium' }
            ];

            // Limpiar tabla
            tablaBody.innerHTML = '';

            // Llenar tabla con datos
            datosPerfil.forEach(dato => {
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td><strong>${dato.campo}</strong></td>
                    <td>${dato.valor}</td>
                `;
                tablaBody.appendChild(fila);
            });
        }

        function sortTable(columnIndex) {
            const table = document.getElementById('perfilTable');
            const tbody = document.getElementById('perfilTableBody');
            const rows = Array.from(tbody.getElementsByTagName('tr'));
            const headers = table.getElementsByTagName('th');

            // Determinar dirección de ordenamiento
            const isAscending = !headers[columnIndex].classList.contains('asc');
            
            // Remover clases de todos los headers
            Array.from(headers).forEach(header => {
                header.classList.remove('asc', 'desc');
            });

            // Agregar clase al header actual
            headers[columnIndex].classList.add(isAscending ? 'asc' : 'desc');

            // Ordenar filas
            rows.sort((a, b) => {
                const aValue = a.getElementsByTagName('td')[columnIndex].textContent;
                const bValue = b.getElementsByTagName('td')[columnIndex].textContent;
                
                if (columnIndex === 1) { // Columna de valor (podría contener números)
                    const aNum = parseInt(aValue);
                    const bNum = parseInt(bValue);
                    if (!isNaN(aNum) && !isNaN(bNum)) {
                        return isAscending ? aNum - bNum : bNum - aNum;
                    }
                }
                
                return isAscending 
                    ? aValue.localeCompare(bValue) 
                    : bValue.localeCompare(aValue);
            });

            // Reinsertar filas ordenadas
            rows.forEach(row => tbody.appendChild(row));
        }

        // Inicializar la vista principal al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            mostrarVista('principal');
        });

        // Cerrar menú móvil al hacer clic fuera de él
        document.addEventListener('click', function(event) {
            const navbar = document.querySelector('.navbar');
            const navbarCollapse = document.getElementById('navbarNav');
            const toggler = document.querySelector('.navbar-toggler');
            
            if (!navbar.contains(event.target) && navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });

        // Prevenir que los clics dentro del menú lo cierren
        document.getElementById('navbarNav').addEventListener('click', function(event) {
            event.stopPropagation();
        });

        // Manejar el envío del formulario de login
        document.querySelector('#login form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Inicio de sesión simulado. En una aplicación real, esto conectaría con el backend.');
            mostrarVista('principal');
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\carpeta principal\Proyecto-2025-DREAM\Dream\resources\views/usuarios con cuenta/index.blade.php ENDPATH**/ ?>