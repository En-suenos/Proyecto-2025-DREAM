<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación PlayList con múltiples vistas y autenticación.">
    <title>Aplicación PlayList</title>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #f8f9fa;
            cursor: pointer;
        }
        .table-container {
            overflow-x: auto;
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
       
        <div id="misDatos" class="hidden">
            <h2>Ventana de Mis Datos</h2>
            <form id="formDatos">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" placeholder="Apellido">
                </div>
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" placeholder="DNI">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" placeholder="Correo">
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" placeholder="Contraseña">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>

            <div class="table-container mt-4">
                <h3>Datos Actuales del Usuario</h3>
                <table id="datosTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">Campo</th>
                            <th onclick="sortTable(1)">Valor</th>
                        </tr>
                    </thead>
                    <tbody id="datosTableBody">

                    </tbody>
                </table>
            </div>
            <button onclick="regresar('perfil')">Regresa al perfil</button>
        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        function mostrarVista(vista) {
            document.querySelectorAll('.main-content > div').forEach(div => div.classList.add('hidden'));
            document.getElementById(vista).classList.remove('hidden');
            if (vista === 'misDatos') {
                loadDatosTable();
            }
        }

        let userData = [
            { campo: 'Nombre', valor: 'Juan' },
            { campo: 'Apellido', valor: 'Pérez' },
            { campo: 'DNI', valor: '12345678' },
            { campo: 'Correo', valor: 'juan@example.com' },
            { campo: 'Contraseña', valor: '********' }
        ];

        function loadDatosTable() {
            const tableBody = document.getElementById('datosTableBody');
            tableBody.innerHTML = '';
            userData.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${item.campo}</td><td>${item.valor}</td>`;
                tableBody.appendChild(row);
            });
        }

        function sortTable(columnIndex) {
            const table = document.getElementById('datosTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            const isAscending = table.getAttribute('data-sort') !== 'asc' || table.getAttribute('data-column') !== columnIndex;
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

        document.getElementById('formDatos').addEventListener('submit', function(e) {
            e.preventDefault();
            const nombre = document.getElementById('nombre').value;
            const apellido = document.getElementById('apellido').value;
            const dni = document.getElementById('dni').value;
            const correo = document.getElementById('correo').value;
            const contrasena = document.getElementById('contrasena').value;

            if (nombre && apellido && dni && correo) {
                userData = [
                    { campo: 'Nombre', valor: nombre },
                    { campo: 'Apellido', valor: apellido },
                    { campo: 'DNI', valor: dni },
                    { campo: 'Correo', valor: correo },
                    { campo: 'Contraseña', valor: '********' }
                ];
                loadDatosTable();
                alert('Datos guardados exitosamente.');
            } else {
                alert('Por favor, completa los campos requeridos.');
            }
        });

        function mostrarLogin() { mostrarVista('login'); }
        function iniciarSueno() { alert('Iniciando modo sueño...'); }
        function regresar(vista) { mostrarVista(vista); }
        // ...
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\resources\views/ventana de datos/index.blade.php ENDPATH**/ ?>