<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje Final de Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
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
        .success-message {
            background-color: #d4edda;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="success-message">
                    <h2>¡Bienvenido! Inicio de sesión exitoso.</h2>
                    <p>Aquí está un resumen de tu cuenta. Esta es una versión sin autenticación para demostración.</p>
                </div>
                
                <div class="table-container">
                    <table id="successTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)">Campo</th>
                                <th onclick="sortTable(1)">Valor</th>
                            </tr>
                        </thead>
                        <tbody id="successTableBody">
                            <!-- La tabla se poblará dinámicamente con JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Datos de ejemplo (simulados, sin login)
        let successData = [
            { campo: 'Correo', valor: 'usuario@example.com' },
            { campo: 'Nombre', valor: 'Juan' },
            { campo: 'Fecha de Registro', valor: '01/10/2023' },
            { campo: 'Último Acceso', valor: 'Hoy' }
        ];

        // Función para poblar la tabla
        function loadSuccessTable() {
            const tableBody = document.getElementById('successTableBody');
            tableBody.innerHTML = '';  // Limpiar contenido
            successData.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${item.campo}</td><td>${item.valor}</td>`;
                tableBody.appendChild(row);
            });
        }

        // Llamar a la función al cargar la página
        window.onload = loadSuccessTable;

        // Función para ordenar la tabla
        function sortTable(columnIndex) {
            const table = document.getElementById('successTable');
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
    </script>
</body>
</html>
