<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        .icono-cell {
            width: 50px;
        }
        .leida {
            background-color: #d4edda; 
            text-decoration: line-through;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4">
                            <i class="fas fa-bell me-2"></i>Notificaciones
                        </h2>
                        <div class="table-container">
                            <table id="notificacionesTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Icono</th>
                                        <th onclick="sortTable(1)">Título</th>
                                        <th onclick="sortTable(2)">Descripción</th>
                                        <th onclick="sortTable(3)">Fecha</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('ventana-principal') }}" class="btn btn-primary">
                                ← Volver al inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const data = [
            { icono: 'fas fa-music', titulo: 'Nuevo sonido disponible', descripcion: 'Se ha agregado "Bosque Mágico" a la biblioteca', fecha: 'Hoy' },
            { icono: 'fas fa-bed', titulo: 'Recordatorio de sueño', descripcion: 'Es hora de tu sesión de sueño programada', fecha: 'Ayer' },
            { icono: 'fas fa-download', titulo: 'Actualización disponible', descripcion: 'Nueva versión de la aplicación', fecha: 'Hace 3 días' }
        ];

        function loadTable() {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = ''; 
            data.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="icono-cell"><i class="${item.icono}"></i></td>
                    <td>${item.titulo}</td>
                    <td>${item.descripcion}</td>
                    <td>${item.fecha}</td>
                    <td><button onclick="marcarLeida(${index})">Marcar como leída</button></td>
                `;
                tableBody.appendChild(row);
            });
        }

  
        window.onload = loadTable;

        function sortTable(columnIndex) {
            const table = document.getElementById('notificacionesTable');
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

        function marcarLeida(index) {
            const row = document.querySelectorAll('#tableBody tr')[index];
            row.classList.add('leida'); 
            row.querySelector('button').textContent = 'Leída'; 
            row.querySelector('button').disabled = true;  
        }
    </script>
</body>
</html>
