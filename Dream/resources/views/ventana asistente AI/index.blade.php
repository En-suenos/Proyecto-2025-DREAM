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
            max-height: 300px; 
            overflow-y: auto;
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
     
        <div id="asistente" class="hidden">
            <h2>Ventana de Asistente AI</h2>
            <p>Charla con AI: <input type="text" id="inputAI" class="form-control mb-3" placeholder="Escribe un mensaje"></p>
            <button onclick="interactuarAI()" class="btn btn-primary">Enviar</button>
            <p>Sugerencias AI: Aquí se muestran sugerencias basadas en tu input.</p>
            
            
            <div class="table-container mt-4">
                <h3>Historial de Conversación</h3>
                <table id="asistenteTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">Mensaje</th>
                            <th onclick="sortTable(1)">De</th>
                            <th onclick="sortTable(2)">Hora</th>
                        </tr>
                    </thead>
                    <tbody id="asistenteTableBody">
                    </tbody>
                </table>
            </div>
            <button onclick="regresar('principal')">Regresa a la ventana principal</button>
        </div>
    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarVista(vista) {
            document.querySelectorAll('.main-content > div').forEach(div => div.classList.add('hidden'));
            document.getElementById(vista).classList.remove('hidden');
            if (vista === 'asistente') {
                loadAsistenteTable(); 
            }
        }
        let chatHistory = [
            { mensaje: 'Hola, ¿en qué puedo ayudarte?', de: 'AI', hora: '10:00 AM' },
            { mensaje: 'Quiero saber sobre sonidos relajantes.', de: 'Usuario', hora: '10:01 AM' }
        ];

        
        function loadAsistenteTable() {
            const tableBody = document.getElementById('asistenteTableBody');
            tableBody.innerHTML = ''; 
            chatHistory.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${item.mensaje}</td><td>${item.de}</td><td>${item.hora}</td>`;
                tableBody.appendChild(row);
            });
        }

      
        function interactuarAI() {
            const input = document.getElementById('inputAI').value;
            if (input) {
                const now = new Date().toLocaleTimeString();  
                chatHistory.push({ mensaje: input, de: 'Usuario', hora: now });
                // Simular respuesta de AI
                chatHistory.push({ mensaje: 'Respuesta AI: ' + input, de: 'AI', hora: now });
                loadAsistenteTable();  // Actualizar tabla
                document.getElementById('inputAI').value = ''; 
            } else {
                alert('Por favor, escribe un mensaje.');
            }
        }

        
        function sortTable(columnIndex) {
            const table = document.getElementById('asistenteTable'); 
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
        function mostrarLogin() { mostrarVista('login'); }
        function iniciarSueno() { alert('Iniciando modo sueño...'); }
        function regresar(vista) { mostrarVista(vista); }
    </script>
</body>
</html>
