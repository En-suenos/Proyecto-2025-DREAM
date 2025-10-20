<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación PlayList con múltiples vistas y autenticación.">
    <title>PlayList</title>
    
    
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
                    <li class="nav-item"><a class="nav-link" href="{{route('perfil.index')}}">Mi perfil</a></li> <!-- Enlace a la vista de perfil, se conecta con rutas -->
                    <li class="nav-item"><a class="nav-link" href="{{route('playlists.index')}}">PlayLists</a></li> <!-- Enlace a la vista de PlayLists, se conecta con rutas -->
                    <li class="nav-item"><a class="nav-link" href="{{route('asistente ia.index')}}">Asistente</a></li> <!-- Enlace a la vista de Asistente IA, se conecta con routas-->
                    <li class="nav-item"><a class="nav-link" href="#" onclick="mostrarVista('opciones')">Opciones</a></li>

                    <li class="nav-item"><a class="nav-link" href="#" onclick="iniciarSueno()">Iniciar sueño</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('inicio_sesion.index')}}">Iniciar sesión</a></li> <!-- Enlace a la vista de inicio de sesión, se conecta con rutas -->

                    <li class="nav-item"><a class="nav-link" href="#" onclick="mostrarLogin()">Iniciar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

 
    <main class="container main-content">
     
        <div id="perfil" class="hidden">
            <h2>Mi perfil</h2>
            <ul>
                <li><a href="#" onclick="mostrarVista('notificaciones')">Notificaciones</a></li>
                <li><a href="#" onclick="mostrarVista('idiomas')">Idiomas</a></li>
                <li><a href="#" onclick="mostrarVista('sonidosFavoritos')">Sonidos favoritos</a></li>
                <li><a href="#" onclick="mostrarVista('misDatos')">Mis datos</a></li>
            </ul>
            
           
            <div class="table-container mt-4">
                <h3>Detalles de tu Cuenta</h3>
                <table id="perfilTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">Campo</th>
                            <th onclick="sortTable(1)">Valor</th>
                        </tr>
                    </thead>
                    <tbody id="perfilTableBody">
                       
                    </tbody>
                </table>
            </div>
            <a href="{{route('ventana principal.index')}}" class="btn btn-secondary mt-3">
                Regresa a la ventana principal
            </a> <!-- Botón para regresar a la ventana principal -->
        </div>
    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        function mostrarVista(vista) {
            document.querySelectorAll('.main-content > div').forEach(div => {
                div.classList.add('hidden');
                div.classList.remove('fade-in');
            });
            const targetDiv = document.getElementById(vista);
            targetDiv.classList.remove('hidden');
            setTimeout(() => targetDiv.classList.add('fade-in'), 10); // Trigger animation
            if (vista === 'perfil') {
                loadPerfilTable(); 
            }
        }
        let perfilData = [
            { campo: 'Nombre', valor: 'Juan' },
            { campo: 'Apellido', valor: 'Pérez' },
            { campo: 'Correo', valor: 'juan@example.com' },
            { campo: 'Fecha de Registro', valor: '01/10/2023' },
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
