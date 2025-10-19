<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación PlayList con múltiples vistas y autenticación.">
    <title>Asistente AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6c63ff;
            --secondary-color: #4a44b5;
            --accent-color: #ff6b6b;
            --light-bg: #f8f9fa;
            --dark-bg: #1e1e2d;
            --text-light: #ffffff;
            --text-dark: #2d3748;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            transition: background-color 0.3s, color 0.3s;
        }
        
        body.dark-mode {
            background-color: var(--dark-bg);
            color: var(--text-light);
        }
        
        .hidden {
            display: none !important;
        }
        
        .app-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .dark-mode .header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .app-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .theme-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-dark);
        }
        
        .dark-mode .theme-toggle {
            color: var(--text-light);
        }
        
        .card {
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            border: none;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .dark-mode .card {
            background-color: #2d2d44;
            color: var(--text-light);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }
        
        .dark-mode .card-header {
            background-color: var(--secondary-color);
        }
        
        .chat-container {
            max-height: 400px;
            overflow-y: auto;
            padding: 15px;
            background-color: #f0f2f5;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .dark-mode .chat-container {
            background-color: #252536;
        }
        
        .chat-message {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        
        .user-message {
            justify-content: flex-end;
        }
        
        .ai-message {
            justify-content: flex-start;
        }
        
        .message-bubble {
            max-width: 70%;
            padding: 12px 15px;
            border-radius: 18px;
            position: relative;
        }
        
        .user-message .message-bubble {
            background-color: var(--primary-color);
            color: white;
            border-bottom-right-radius: 5px;
        }
        
        .ai-message .message-bubble {
            background-color: white;
            color: var(--text-dark);
            border-bottom-left-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .dark-mode .ai-message .message-bubble {
            background-color: #3a3a52;
            color: var(--text-light);
        }
        
        .message-time {
            font-size: 0.75rem;
            opacity: 0.7;
            margin-top: 5px;
        }
        
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 10px 15px;
            color: #666;
            font-style: italic;
        }
        
        .dark-mode .typing-indicator {
            color: #aaa;
        }
        
        .typing-dots {
            display: flex;
            gap: 3px;
        }
        
        .typing-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #666;
            animation: typing 1.4s infinite ease-in-out;
        }
        
        .dark-mode .typing-dot {
            background-color: #aaa;
        }
        
        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }
        
        @keyframes typing {
            0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }
        
        .input-group {
            margin-bottom: 15px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .btn-primary:disabled {
            background-color: #a0a0c0;
            border-color: #a0a0c0;
            transform: none;
            cursor: not-allowed;
        }
        
        .btn-outline-secondary {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .table-container {
            overflow-x: auto;
            max-height: 300px;
            overflow-y: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .table th:hover {
            background-color: var(--secondary-color);
        }
        
        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .dark-mode .table th {
            background-color: var(--secondary-color);
        }
        
        .dark-mode .table td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            background-color: #2d2d44;
            color: var(--text-light);
        }
        
        .suggestions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }
        
        .suggestion-chip {
            background-color: #e9ecef;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .suggestion-chip:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .dark-mode .suggestion-chip {
            background-color: #3a3a52;
            color: var(--text-light);
        }
        
        .ai-icon {
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        
        .user-icon {
            font-size: 1.5rem;
            color: var(--accent-color);
        }
        
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        .api-key-container {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }
        
        .dark-mode .api-key-container {
            background-color: #2d2d44;
        }
        
        .api-key-input {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        @media (max-width: 768px) {
            .app-container {
                padding: 15px;
            }
            
            .message-bubble {
                max-width: 85%;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 10px;
            }
            
            .action-buttons button {
                width: 100%;
            }
            
            .api-key-input {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <main class="app-container">
        <header class="header">
            <h1 class="app-title">
                <i class="fas fa-robot"></i> Asistente AI
            </h1>
            <button class="theme-toggle" id="themeToggle">
                <i class="fas fa-moon"></i>
            </button>
        </header>

        <div id="asistente">
            <div class="api-key-container">
                <p><strong>Configuración de API:</strong> Para usar el asistente AI real, necesitas una clave de API de OpenAI.</p>
                <div class="api-key-input">
                    <input type="password" id="apiKeyInput" class="form-control" placeholder="Ingresa tu clave de API de OpenAI">
                    <button onclick="saveApiKey()" class="btn btn-primary">Guardar Clave</button>
                </div>
                <small class="text-muted">Tu clave se guarda localmente y no se envía a nuestros servidores.</small>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-comments me-2"></i>
                            Charla con AI
                        </div>
                        <div class="card-body">
                            <div class="chat-container" id="chatContainer">
                            </div>
                            
                            <div class="input-group">
                                <input type="text" id="inputAI" class="form-control" placeholder="Escribe tu mensaje aquí..." disabled>
                                <button onclick="interactuarAI()" id="sendButton" class="btn btn-primary" disabled>
                                    <i class="fas fa-paper-plane"></i> Enviar
                                </button>
                            </div>
                            
                            <div class="suggestions">
                                <div class="suggestion-chip" onclick="insertSuggestion('¿Qué puedes hacer?')">¿Qué puedes hacer?</div>
                                <div class="suggestion-chip" onclick="insertSuggestion('Cuéntame un chiste')">Cuéntame un chiste</div>
                                <div class="suggestion-chip" onclick="insertSuggestion('Recomiéndame música')">Recomiéndame música</div>
                                <div class="suggestion-chip" onclick="insertSuggestion('Ayúdame a relajarme')">Ayúdame a relajarme</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-history me-2"></i>
                            Historial de Conversación
                        </div>
                        <div class="card-body p-0">
                            <div class="table-container">
                                <table id="asistenteTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable(0)">Mensaje <i class="fas fa-sort"></i></th>
                                            <th onclick="sortTable(1)">De <i class="fas fa-sort"></i></th>
                                            <th onclick="sortTable(2)">Hora <i class="fas fa-sort"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody id="asistenteTableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-lightbulb me-2"></i>
                            Sugerencias AI
                        </div>
                        <div class="card-body">
                            <p id="suggestionsText">Una vez que empieces a chatear, aparecerán sugerencias personalizadas aquí.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="action-buttons mt-4">
                <button onclick="regresar('principal')" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Regresar
                </button>
                <button onclick="limpiarChat()" class="btn btn-outline-danger">
                    <i class="fas fa-trash me-2"></i> Limpiar Chat
                </button>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let chatHistory = [
            { mensaje: '¡Hola! Soy tu asistente AI. ¿En qué puedo ayudarte hoy?', de: 'AI', hora: obtenerHoraActual() }
        ];
        
        let apiKey = localStorage.getItem('openai_api_key');
        let isTyping = false;
        document.addEventListener('DOMContentLoaded', function() {
            loadChat();
            loadAsistenteTable();
            
            document.getElementById('themeToggle').addEventListener('click', toggleTheme);
            
            document.getElementById('inputAI').addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !isTyping) {
                    interactuarAI();
                }
            });
            if (apiKey) {
                document.getElementById('apiKeyInput').value = '••••••••••••••••';
                enableChat();
            }
        });

        function obtenerHoraActual() {
            return new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        }
        function loadChat() {
            const chatContainer = document.getElementById('chatContainer');
            chatContainer.innerHTML = '';
            
            chatHistory.forEach(item => {
                const messageDiv = document.createElement('div');
                messageDiv.className = item.de === 'Usuario' ? 'chat-message user-message' : 'chat-message ai-message';
                
                const icon = item.de === 'Usuario' ? 
                    '<i class="fas fa-user user-icon"></i>' : 
                    '<i class="fas fa-robot ai-icon"></i>';
                
                messageDiv.innerHTML = `
                    ${item.de === 'AI' ? icon : ''}
                    <div class="message-bubble">
                        ${item.mensaje}
                        <div class="message-time">${item.hora}</div>
                    </div>
                    ${item.de === 'Usuario' ? icon : ''}
                `;
                
                chatContainer.appendChild(messageDiv);
            });
            
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
        function loadAsistenteTable() {
            const tableBody = document.getElementById('asistenteTableBody');
            tableBody.innerHTML = '';
            chatHistory.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.mensaje}</td>
                    <td>${item.de}</td>
                    <td>${item.hora}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        function saveApiKey() {
            const apiKeyInput = document.getElementById('apiKeyInput');
            const key = apiKeyInput.value.trim();
            
            if (key && key.length > 10) {
                apiKey = key;
                localStorage.setItem('openai_api_key', key);
                apiKeyInput.value = '••••••••••••••••';
                enableChat();
                mostrarNotificacion('API key guardada correctamente', 'success');
            } else {
                mostrarNotificacion('Por favor, ingresa una API key válida', 'error');
            }
        }
        function enableChat() {
            document.getElementById('inputAI').disabled = false;
            document.getElementById('sendButton').disabled = false;
        }
        async function interactuarAI() {
            const input = document.getElementById('inputAI').value.trim();
            if (!input) {
                mostrarNotificacion('Por favor, escribe un mensaje.', 'error');
                return;
            }
            
            if (!apiKey) {
                mostrarNotificacion('Primero debes configurar tu API key de OpenAI.', 'error');
                return;
            }
            
            const now = obtenerHoraActual();
            
            chatHistory.push({ mensaje: input, de: 'Usuario', hora: now });
            loadChat();
            document.getElementById('inputAI').value = '';
            document.getElementById('sendButton').disabled = true;
            document.getElementById('inputAI').disabled = true;
            isTyping = true;
            
            mostrarIndicadorEscritura();
            
            try {

                const respuesta = await llamarOpenAI(input);
                
                ocultarIndicadorEscritura();
                
                chatHistory.push({ mensaje: respuesta, de: 'AI', hora: obtenerHoraActual() });
                loadChat();
                loadAsistenteTable();

                generarSugerencias(respuesta);
                
            } catch (error) {
                console.error('Error al llamar a la API:', error);
                ocultarIndicadorEscritura();
                
                chatHistory.push({ 
                    mensaje: 'Lo siento, hubo un error al procesar tu solicitud. Por favor, verifica tu API key e intenta nuevamente.', 
                    de: 'AI', 
                    hora: obtenerHoraActual() 
                });
                loadChat();
                loadAsistenteTable();
            }
            
            document.getElementById('sendButton').disabled = false;
            document.getElementById('inputAI').disabled = false;
            isTyping = false;
        }

        async function llamarOpenAI(mensaje) {
            const url = 'https://api.openai.com/v1/chat/completions';
            
            const mensajes = chatHistory.map(item => ({
                role: item.de === 'Usuario' ? 'user' : 'assistant',
                content: item.mensaje
            }));
            
            mensajes.push({ role: 'user', content: mensaje });
            
            const data = {
                model: 'gpt-3.5-turbo',
                messages: mensajes,
                max_tokens: 500,
                temperature: 0.7
            };
            
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${apiKey}`
                },
                body: JSON.stringify(data)
            });
            
            if (!response.ok) {
                throw new Error(`Error de API: ${response.status} ${response.statusText}`);
            }
            
            const result = await response.json();
            return result.choices[0].message.content;
        }
        function mostrarIndicadorEscritura() {
            const chatContainer = document.getElementById('chatContainer');
            const typingDiv = document.createElement('div');
            typingDiv.className = 'chat-message ai-message';
            typingDiv.id = 'typingIndicator';
            typingDiv.innerHTML = `
                <i class="fas fa-robot ai-icon"></i>
                <div class="message-bubble typing-indicator">
                    <span>Escribiendo</span>
                    <div class="typing-dots">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            `;
            chatContainer.appendChild(typingDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
        function ocultarIndicadorEscritura() {
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }
        function generarSugerencias(respuesta) {
            const suggestionsText = document.getElementById('suggestionsText');
        
            if (respuesta.toLowerCase().includes('música') || respuesta.toLowerCase().includes('canción')) {
                suggestionsText.innerHTML = `
                    <p>Basado en tu conversación sobre música, te sugiero:</p>
                    <ul>
                        <li>Explorar listas de reproducción por género</li>
                        <li>Descubrir nuevos artistas similares a tus gustos</li>
                        <li>Crear una lista de reproducción personalizada</li>
                    </ul>
                `;
            } else if (respuesta.toLowerCase().includes('relaj') || respuesta.toLowerCase().includes('calma')) {
                suggestionsText.innerHTML = `
                    <p>Basado en tu interés en la relajación, te sugiero:</p>
                    <ul>
                        <li>Probar meditaciones guiadas de 5 minutos</li>
                        <li>Escuchar sonidos de la naturaleza</li>
                        <li>Practicar ejercicios de respiración</li>
                    </ul>
                `;
            } else if (respuesta.toLowerCase().includes('chiste') || respuesta.toLowerCase().includes('humor')) {
                suggestionsText.innerHTML = `
                    <p>¡Veo que te gusta el humor! También puedes:</p>
                    <ul>
                        <li>Pedir chistes de diferentes categorías</li>
                        <li>Explorar curiosidades divertidas</li>
                        <li>Jugar juegos de palabras</li>
                    </ul>
                `;
            } else {
                suggestionsText.innerHTML = `
                    <p>Sugerencias generales:</p>
                    <ul>
                        <li>Pregunta sobre cualquier tema que te interese</li>
                        <li>Solicita ayuda con tareas específicas</li>
                        <li>Pide explicaciones detalladas sobre conceptos</li>
                    </ul>
                `;
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
                
                if (columnIndex === 2) {
                    const aTime = convertTimeToMinutes(aText);
                    const bTime = convertTimeToMinutes(bText);
                    return isAscending ? aTime - bTime : bTime - aTime;
                } else {
                    if (isAscending) {
                        return aText.localeCompare(bText, 'es', { numeric: true });
                    } else {
                        return bText.localeCompare(aText, 'es', { numeric: true });
                    }
                }
            });
            
            rows.forEach(row => tbody.appendChild(row));
        }

        function convertTimeToMinutes(timeStr) {
            const [time, modifier] = timeStr.split(' ');
            let [hours, minutes] = time.split(':').map(Number);
            
            if (modifier === 'PM' && hours < 12) hours += 12;
            if (modifier === 'AM' && hours === 12) hours = 0;
            
            return hours * 60 + minutes;
        }

        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
            const icon = document.querySelector('#themeToggle i');
            if (document.body.classList.contains('dark-mode')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        }

        function insertSuggestion(text) {
            document.getElementById('inputAI').value = text;
        }

        function limpiarChat() {
            if (confirm('¿Estás seguro de que quieres limpiar el historial de chat?')) {
                chatHistory = [
                    { mensaje: '¡Hola! Soy tu asistente AI. ¿En qué puedo ayudarte hoy?', de: 'AI', hora: obtenerHoraActual() }
                ];
                loadChat();
                loadAsistenteTable();
                document.getElementById('suggestionsText').innerHTML = 'Una vez que empieces a chatear, aparecerán sugerencias personalizadas aquí.';
            }
        }

        function mostrarNotificacion(mensaje, tipo) {
            
            const notificacion = document.createElement('div');
            notificacion.className = `alert alert-${tipo === 'error' ? 'danger' : 'success'} alert-dismissible fade show`;
            notificacion.innerHTML = `
                ${mensaje}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            const appContainer = document.querySelector('.app-container');
            appContainer.insertBefore(notificacion, appContainer.firstChild);
            
            setTimeout(() => {
                if (notificacion.parentNode) {
                    notificacion.remove();
                }
            }, 5000);
        }

        function mostrarVista(vista) {
            console.log("Mostrando vista: " + vista);
        }
        
        function regresar(vista) {
            alert('Regresando a: ' + vista);
        }
    </script>
</body>
</html>