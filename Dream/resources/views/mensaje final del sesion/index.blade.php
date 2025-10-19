<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje Final de Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .success-message {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        .success-message::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }
        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        .success-message h2 {
            margin-bottom: 10px;
            font-weight: 700;
        }
        .success-message p {
            margin: 0;
            opacity: 0.9;
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
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }
        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #007bff, #0056b3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin: 0 auto 20px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            color: #6c757d;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="success-message">
                    <div class="avatar">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h2><i class="fas fa-check-circle"></i> ¡Bienvenido! Inicio de sesión exitoso.</h2>
                    <p>Aquí está un resumen de tu cuenta. Esta es una versión sin autenticación para demostración.</p>
                </div>
                
                <div class="table-container">
                    <table id="successTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)">Campo <i class="fas fa-sort"></i></th>
                                <th onclick="sortTable(1)">Valor <i class="fas fa-sort"></i></th>
                            </tr>
                        </thead>
                        <tbody id="successTableBody">
                        </tbody>
                    </table>
                </div>
                
                <div class="text-center mt-4">
                    <button class="btn btn-custom me-2"><i class="fas fa-edit"></i> Editar Perfil</button>
                    <button class="btn btn-custom"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2023 Empresa Profesional. Todos los derechos reservados. | <a href="#" class="text-decoration-none">Política de Privacidad</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let successData = [
            { campo: 'Correo', valor: 'usuario@example.com' },
            { campo: 'Nombre', valor: 'Juan' },
            { campo: 'Fecha de Registro', valor: '01/10/2023' },
            { campo: 'Último Acceso', valor: 'Hoy' }
        ];
        
        function loadSuccessTable() {
            const tableBody = document.getElementById('successTableBody');
            tableBody.innerHTML = '';  
            successData.forEach(item => {
                const row = document.createElement('tr');
                let valorDisplay = item.valor;
                if (item.campo === 'Último Acceso' && item.valor === 'Hoy') {
                    valorDisplay = `<span class="badge bg-success">${item.valor}</span>`;
                }
                row.innerHTML = `<td><i class="fas fa-info-circle text-primary"></i> ${item.campo}</td><td>${valorDisplay}</td>`;
                tableBody.appendChild(row);
            });
        }
        
        window.onload = loadSuccessTable;

        function sortTable(columnIndex) {
            const table = document.getElementById('successTable');
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
    </script>
</body>
</html>

