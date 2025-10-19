<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <meta name="description" content="Página de Inicio de Sesión para la Aplicación Reproductor de Música.">
    <title>Inicio de Sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
        }
        .alert-custom {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form id="formLogin">
            <div class="mb-3">
                <label for="correoLogin" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correoLogin" placeholder="Correo" required>
            </div>
            <div class="mb-3">
                <label for="contrasenaLogin" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasenaLogin" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
        <div id="mensajeLogin" class="alert alert-info alert-custom" style="display: none;"></div>
        <p class="text-center mt-3">
            ¿No tienes cuenta? <a href="#" onclick="mostrarRegistro()">Regístrate aquí</a>
        </p>
        <p class="text-center">
            <a href="#" onclick="volverApp()">Volver a la aplicación</a>
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validarLogin() {
            const correo = document.getElementById('correoLogin').value;
            const contrasena = document.getElementById('contrasenaLogin').value;
            const mensaje = document.getElementById('mensajeLogin');
            
            if (correo && contrasena) {
                localStorage.setItem('usuario', correo);
                mensaje.className = 'alert alert-success alert-custom';
                mensaje.innerHTML = '¡Inicio de sesión exitoso! Redirigiendo...';
                mensaje.style.display = 'block';
                setTimeout(() => {
                    window.location.href = 'index.html'; // Redirigir a la app principal (ajusta la ruta)
                }, 2000);
            } else {
                mensaje.className = 'alert alert-danger alert-custom';
                mensaje.innerHTML = 'Por favor, completa todos los campos.';
                mensaje.style.display = 'block';
            }
        }

        function mostrarRegistro() {
            alert('Funcionalidad de registro no implementada aún.'); // Placeholder
        }

        function volverApp() {
            window.location.href ="{{route('ventana principal.index')}}"; // Redirigir a la app principal (ajusta la ruta)
        }

        document.getElementById('formLogin').addEventListener('submit', function(e) {
            e.preventDefault();
            validarLogin();
=======
    <title>Iniciar Sesión</title>
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
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Iniciar Sesión</h2>
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="{{ route('ventana-principal') }}" class="text-decoration-none">
                                ← Volver a la ventana principal
                            </a>
                        </div>
                        
                        <div class="table-container mt-4">
                            <h3 class="mt-4">Sesiones Recientes (Ejemplo)</h3>
                            <table id="sesionesTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th onclick="sortTable(0)">ID</th> 
                                        <th onclick="sortTable(1)">Correo</th>
                                        <th onclick="sortTable(2)">Fecha</th>
                                        <th onclick="sortTable(3)">Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const data = [
            { id: 1, correo: 'usuario1@example.com', fecha: '2023-10-01', estado: 'Éxito' },
            { id: 2, correo: 'usuario2@example.com', fecha: '2023-10-02', estado: 'Fallido' },
            { id: 3, correo: 'usuario3@example.com', fecha: '2023-10-03', estado: 'Éxito' },
            { id: 4, correo: 'usuario4@example.com', fecha: '2023-10-04', estado: 'Éxito' }
        ];

        function loadTable() {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';  
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.id}</td>
                    <td>${item.correo}</td>
                    <td>${item.fecha}</td>
                    <td>${item.estado}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        window.onload = loadTable;
        function sortTable(columnIndex) {
            const table = document.getElementById('sesionesTable');
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

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            if (email && password) {
                alert('Inicio de sesión exitoso. ¡Redirigiendo!');
                
            } else {
                alert('Por favor, completa los campos.');
            }
>>>>>>> ramaView2
        });
    </script>
</body>
</html>
<<<<<<< HEAD
=======

</html>
>>>>>>> ramaView2
