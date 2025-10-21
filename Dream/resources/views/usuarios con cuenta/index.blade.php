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
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        .navbar {
            background: linear-gradient(135deg, #007bff, #0056b3);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-bottom: 3px solid #004085;
        }
        .navbar-brand {
            font-weight: 700;
            color: white !important;
            font-size: 1.5rem;
        }
        .navbar-brand:hover {
            color: #e9ecef !important;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #e9ecef !important;
        }
        .main-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 30px;
            margin-bottom: 50px;
            min-height: 60vh;
        }
        .hidden {
            display: none;
        }
        h2 {
            color: #007bff;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }
        h3 {
            color: #495057;
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
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        ul li a:hover {
            color: #0056b3;
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
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        th:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
        }
        th i {
            margin-left: 5px;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            transition: background 0.3s ease;
        }
        tr:hover td {
            background-color: #f8f9fa;
        }
        .badge {
            font-size: 0.85em;
        }
        .btn-custom {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 20px;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #007bff, #0056b3);
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
        }
        .card-body {
            padding: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            color: #6c757d;
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
            background: linear-gradient(135deg, #6c757d, #495057);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 20px;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" onclick="mostrarVista('principal')"><i class="fas fa-music"></i> PlayList</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Mostrar menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- NAVEGACIÓN CORREGIDA - SIN CONFLICTOS -->
                    <li class="nav-item">
                        <!--<a class="nav-link" href="{{ route('mi-perfil') }}">-->
                        <a href="#" onclick="mostrarVista('perfil')" class="nav-link">
                            <i class="fas fa-user"></i> Mi perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('playlists.index') }}">
                            <i class="fas fa-list"></i> PlayLists
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asistente-ia.index') }}">
                            <i class="fas fa-robot"></i> Asistente
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="mostrarVista('opciones')">
                            <i class="fas fa-cog"></i> Opciones
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="iniciarSueno()">
                            <i class="fas fa-moon"></i> Iniciar sueño
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ventana-principal.index') }}">
                            <i class="fas fa-sign-in-alt"></i> Cerrar sesión
                        </a>
                    </li>
                </ul>
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
                <h2>Bienvenido, {{ $usuario->nombre }}</h2>
                <p>Explora tus playlists, configura tu perfil y disfruta de la música.</p>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-list fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Mis PlayLists</h5>
                                <p class="card-text">Gestiona tus listas de reproducción favoritas.</p>
                                <a href="{{route('sonidos.index')}}" class="btn btn-custom">Ver PlayLists</a>
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
                                <a href="{{route('asistente-ia.index')}}" class="btn btn-custom">Usar Asistente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('ventana-principal.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cerrar sesion
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
                                <li><a href="#" onclick="mostrarVista('notificaciones')"><i class="fas fa-bell"></i> Notificaciones</a></li>
                                <li><a href="#" onclick="mostrarVista('idiomas')"><i class="fas fa-language"></i> Idiomas</a></li>
                                <li><a href="#" onclick="mostrarVista('sonidosFavoritos')"><i class="fas fa-heart"></i> Sonidos favoritos</a></li>
                                <li><a href="#" onclick="mostrarVista('misDatos')"><i class="fas fa-id-card"></i> Mis datos</a></li>
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

        <!-- Placeholders para otras vistas -->
        <div id="playlists" class="hidden fade-in text-center">
            <h2>PlayLists</h2>
            <p>Aquí puedes gestionar tus listas de reproducción.</p>
            <button class="btn btn-custom" onclick="regresar('principal')">Regresar</button>
        </div>
        <div id="asistente" class="hidden fade-in text-center">
            <h2>Asistente</h2>
            <p>Tu asistente musical está aquí para ayudarte.</p>
            <button class="btn btn-custom" onclick="regresar('principal')">Regresar</button>
        </div>
        <div id="opciones" class="hidden fade-in text-center">
            <h2>Opciones</h2>
            <p>Configura tus preferencias de la aplicación.</p>
            <button class="btn btn-custom" onclick="regresar('principal')">Regresar</button>
        </div>
        <div id="login" class="hidden fade-in text-center">
            <h2>Iniciar Sesión</h2>
            <p>Formulario de login aquí.</p>
            <button class="btn btn-custom" onclick="regresar('principal')">Regresar</button>
        </div>
    </main>

    <div class="footer">
        <p>&copy; 2024 Aplicación PlayList. Todos los derechos reservados. | <a href="#" class="text-decoration-none">Política de Privacidad</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        function mostrarVista(vista) {
            document.querySelectorAll('.main-content > div').forEach(div => {
                div.classList.add('hidden');
                div.classList.remove('fade-in');
            });
            const targetDiv = document.getElementById(vista);
            targetDiv.classList.remove('hidden');
            setTimeout(() => targetDiv.classList.add('fade-in'), 10);
            if (vista === 'perfil') {
                loadPerfilTable(); 
            }
        }
        const usuario = {
           nombre: "{{ $usuario->nombre }}",
           correo: "{{ $usuario->correo }}",
           tipo_usuario: "{{ ucfirst($usuario->tipo_usuario) }}",
           fecha_registro: "{{ \Carbon\Carbon::parse($usuario->fecha_registro)->format('d/m/Y') }}"
       };

        let perfilData = [
            { campo: 'Nombre', valor: usuario.nombre },
            { campo: 'Correo', valor: usuario.correo },
            { campo: 'Tipo de Usuario', valor: usuario.tipo_usuario },
            { campo: 'Fecha de Registro', valor: usuario.fecha_registro },
            { campo: 'Último Acceso', valor: 'Hoy' }
        ];

        function loadPerfilTable() {
            const tableBody = document.getElementById('perfilTableBody');
            tableBody.innerHTML = '';  
            perfilData.forEach(item => {
                const row = document.createElement('tr');
                let valorDisplay = item.valor;
                if (item.campo === 'Último Acceso' && item.valor === 'Hoy') {
                    valorDisplay = `<span class="badge bg-success">${item.valor}</span>`;
                }
                if (item.campo === 'Tipo de Usuario') {
                    const badgeClass = item.valor === 'Premium' ? 'bg-warning' : item.valor === 'Admin' ? 'bg-danger' : 'bg-info';
                    valorDisplay = `<span class="badge ${badgeClass}">${item.valor}</span>`;
               }
                row.innerHTML = `<td><i class="fas fa-info-circle text-primary"></i> ${item.campo}</td><td>${valorDisplay}</td>`;
                tableBody.appendChild(row);
            });
        }

        function sortTable(columnIndex) {
            const table = document.getElementById('perfilTable'); 
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            const isAscending = table.getAttribute('data-sort') !== 'asc' || table.getAttribute('data-column') !== columnIndex.toString();
            table.setAttribute('data-sort', isAscending ? 'asc' : 'desc');
            table.setAttribute('data-column', columnIndex);
            
            rows.sort((a, b) => {
                const aText = a.children[columnIndex].textContent.trim();
                const bText = b.children[columnIndex].textContent.trim();
                if (isAscending) {
                    return aText.localeCompare(bText, 'es', { numeric: true });
                } else {
                    return bText.localeCompare(aText, 'es', { numeric: true });
                }
            });
            
            rows.forEach(row => tbody.appendChild(row));
        }

       
        function mostrarLogin() { mostrarVista('login'); }
        function iniciarSueno() { alert('Iniciando modo sueño...'); }
        function regresar(vista) { mostrarVista(vista); }
    </script>
</body>
</html>