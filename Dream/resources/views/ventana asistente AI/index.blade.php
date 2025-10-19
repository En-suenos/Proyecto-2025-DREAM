<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación PlayList con múltiples vistas y autenticación.">
    <title>Asistente AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Agregado: Script de Transformers.js -->
    <script src="https://cdn.jsdelivr.net/npm/@huggingface/transformers@3.0.0/dist/transformers.min.js"></script>
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
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateX(120%);
            transition: transform 0.3s ease;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.success {
            background-color: #28a745;
        }
        
        .notification.error {
            background-color: #dc3545;
        }
        
        .notification.info {
            background-color: #17a2b8;
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
        }
    </style>
</head>
<body>
    <main class="app-container">
        <header class="header">
            <h1 class="app-title">
                <i class="fas fa-robot"></i> Asistente AI (Local)
            </h1>
            <button class="theme-toggle" id="themeToggle">
                <i class="fas fa-moon"></i>
            </button>
        </header>

        <div id="asistente">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-comments me-2"></i>
                            Charla con AI (Modelo Local)
                        </div>
                        <div class="card-body">
                            <div id="loadingModel" class="alert alert-info">
                                <i class="fas fa-spinner fa-spin me-2"></i> Cargando modelo de IA local... Esto puede tomar unos minutos la primera vez.
                            </div>
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

    <!-- Notificaciones -->
    <div id="notification" class="notification"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let chatHistory = [
            { mensaje: '¡Hola! Soy tu asistente AI local. ¿En qué puedo ayudarte hoy?', de: 'AI', hora: obtenerHoraActual() }
        ];
        
        let pipeline; // Variable para el modelo de Transformers.js
        let isTyping = false;
        let sortDirection = {};

        document.addEventListener('DOMContentLoaded', async function() {
            loadChat();
            loadAsistenteTable();
            
            document.getElementById('themeToggle').addEventListener('click', toggleTheme);
            
            document.getElementById('inputAI').addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !isTyping) {
                    interactuarAI();
                }
            });

            // Cargar el modelo local
            try {
                console.log('Cargando modelo de IA...');
                pipeline = await transformers.pipeline('text-generation', 'Xenova/distilgpt2');
                document.getElementById('loadingModel').style.display = 'none';
                enableChat();
                mostrarNotificacion('Modelo cargado correctamente. ¡Puedes chatear!', 'success');
            } catch (error) {
                console.error('Error cargando el modelo:', error);
                mostrarNotificacion('Error al cargar el modelo. Usando respuestas predefinidas.', 'error');
                // Fallback: habilitar chat incluso si el modelo no carga
                document.getElementById('loadingModel').style.display = 'none';
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
                
                // Acortar mensajes largos para la tabla
                let mensajeCorto = item.mensaje;
                if (mensajeCorto.length > 50) {
                    mensajeCorto = mensajeCorto.substring(0, 50) + '...';
                }
                
                row.innerHTML = `
                    <td>${mensajeCorto}</td>
                    <td><span class="badge ${item.de === 'Usuario' ? 'bg-primary' : 'bg-success'}">${item.de}</span></td>
                    <td>${item.hora}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        function sortTable(columnIndex) {
            const table = document.getElementById('asistenteTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            // Determinar dirección de ordenamiento
            if (!sortDirection[columnIndex]) {
                sortDirection[columnIndex] = 'asc';
            } else {
                sortDirection[columnIndex] = sortDirection[columnIndex] === 'asc' ? 'desc' : 'asc';
            }
            
            // Ordenar filas
            rows.sort((a, b) => {
                const aText = a.children[columnIndex].textContent.trim();
                const bText = b.children[columnIndex].textContent.trim();
                
                let comparison = 0;
                if (columnIndex === 2) { // Columna de hora
                    const aTime = new Date('1970/01/01 ' + aText);
                    const bTime = new Date('1970/01/01 ' + bText);
                    comparison = aTime - bTime;
                } else {
                    comparison = aText.localeCompare(bText, 'es', { sensitivity: 'base' });
                }
                
                return sortDirection[columnIndex] === 'desc' ? -comparison : comparison;
            });
            
            // Actualizar iconos de ordenamiento
            const headers = table.querySelectorAll('th');
            headers.forEach((header, index) => {
                const icon = header.querySelector('i');
                if (index === columnIndex) {
                    icon.className = sortDirection[columnIndex] === 'asc' ? 'fas fa-sort-up' : 'fas fa-sort-down';
                } else {
                    icon.className = 'fas fa-sort';
                }
            });
            
            // Reinsertar filas ordenadas
            rows.forEach(row => tbody.appendChild(row));
        }

        async function interactuarAI() {
            const input = document.getElementById('inputAI');
            const mensaje = input.value.trim();
            
            if (!mensaje || isTyping) return;
            
            // Agregar mensaje del usuario al historial
            chatHistory.push({
                mensaje: mensaje,
                de: 'Usuario',
                hora: obtenerHoraActual()
            });
            
            // Limpiar input
            input.value = '';
            
            // Actualizar UI
            loadChat();
            loadAsistenteTable();
            
            // Mostrar indicador de escritura
            mostrarTypingIndicator();
            
            // Deshabilitar entrada mientras la AI responde
            isTyping = true;
            disableChat();
            
            try {
                let respuesta;
                
                if (pipeline) {
                    // Usar el modelo de IA local
                    const result = await pipeline(mensaje, {
                        max_length: 100,
                        num_return_sequences: 1,
                        temperature: 0.7,
                        do_sample: true
                    });
                    respuesta = result[0].generated_text;
                } else {
                    // Respuesta predefinida si el modelo no está disponible
                    respuesta = generarRespuestaPredefinida(mensaje);
                }
                
                // Agregar respuesta de la AI al historial
                setTimeout(() => {
                    ocultarTypingIndicator();
                    
                    chatHistory.push({
                        mensaje: respuesta,
                        de: 'AI',
                        hora: obtenerHoraActual()
                    });
                    
                    loadChat();
                    loadAsistenteTable();
                    actualizarSugerencias();
                    
                    isTyping = false;
                    enableChat();
                    
                }, 1000); // Simular tiempo de procesamiento
                
            } catch (error) {
                console.error('Error en la generación de respuesta:', error);
                ocultarTypingIndicator();
                
                // Respuesta de error
                chatHistory.push({
                    mensaje: 'Lo siento, hubo un error al procesar tu mensaje. Por favor, intenta de nuevo.',
                    de: 'AI',
                    hora: obtenerHoraActual()
                });
                
                loadChat();
                loadAsistenteTable();
                
                isTyping = false;
                enableChat();
            }
        }

        function generarRespuestaPredefinida(mensaje) {
            const mensajeLower = mensaje.toLowerCase();
            
            if (mensajeLower.includes('hola') || mensajeLower.includes('hi') || mensajeLower.includes('hey')) {
                return '¡Hola! Es un placer saludarte. ¿En qué puedo ayudarte hoy?';
            } else if (mensajeLower.includes('cómo estás') || mensajeLower.includes('qué tal')) {
                return '¡Estoy funcionando perfectamente! Listo para ayudarte con lo que necesites.';
            } else if (mensajeLower.includes('chiste')) {
                const chistes = [
                    '¿Por qué los pájaros vuelan hacia el sur? ¡Porque caminar les tomaría demasiado tiempo!',
                    '¿Qué le dice un jamón a otro jamón? ¡Nos vemos en el sándwich!',
                    '¿Por qué los programadores prefieren el modo oscuro? ¡Porque la luz atrae los bugs!'
                ];
                return chistes[Math.floor(Math.random() * chistes.length)];
            } else if (mensajeLower.includes('música') || mensajeLower.includes('canción')) {
                return 'Te recomiendo escuchar música relajante como sonidos de naturaleza, música clásica o bandas sonoras de películas. ¿Te gustaría que te sugiera algún género específico?';
            } else if (mensajeLower.includes('relaj') || mensajeLower.includes('calmar')) {
                return 'Para relajarte, te sugiero: respirar profundamente, escuchar sonidos de la naturaleza, o practicar meditación. ¿Quieres que te guíe en algún ejercicio de relajación?';
            } else if (mensajeLower.includes('qué puedes hacer') || mensajeLower.includes('ayuda')) {
                return 'Puedo ayudarte con: responder preguntas, contar chistes, recomendar música, sugerir técnicas de relajación, y mantener conversaciones amenas. ¿Qué te gustaría hacer?';
            } else {
                const respuestasGenericas = [
                    'Interesante pregunta. Déjame pensar en eso...',
                    '¡Vaya! Esa es una perspectiva interesante.',
                    'Me encanta conversar contigo. ¿Hay algo específico en lo que te pueda ayudar?',
                    'Eso suena fascinante. ¿Podrías contarme más?',
                    'Gracias por compartir eso conmigo. ¿En qué más puedo asistirte?'
                ];
                return respuestasGenericas[Math.floor(Math.random() * respuestasGenericas.length)];
            }
        }

        function mostrarTypingIndicator() {
            const chatContainer = document.getElementById('chatContainer');
            const typingDiv = document.createElement('div');
            typingDiv.className = 'chat-message ai-message';
            typingDiv.id = 'typingIndicator';
            typingDiv.innerHTML = `
                <i class="fas fa-robot ai-icon"></i>
                <div class="message-bubble">
                    <div class="typing-indicator">
                        AI está escribiendo
                        <div class="typing-dots">
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                        </div>
                    </div>
                </div>
            `;
            chatContainer.appendChild(typingDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function ocultarTypingIndicator() {
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }

        function insertSuggestion(texto) {
            if (isTyping) return;
            document.getElementById('inputAI').value = texto;
        }

        function limpiarChat() {
            if (confirm('¿Estás seguro de que quieres limpiar toda la conversación?')) {
                chatHistory = [
                    { mensaje: '¡Hola! Soy tu asistente AI local. ¿En qué puedo ayudarte hoy?', de: 'AI', hora: obtenerHoraActual() }
                ];
                loadChat();
                loadAsistenteTable();
                mostrarNotificacion('Chat limpiado correctamente', 'info');
            }
        }

        function regresar(destino) {
            mostrarNotificacion(Redirigiendo a ${destino}..., 'info');
            // En una aplicación real, aquí redirigirías a la vista principal
            console.log(Redirigiendo a: ${destino});
        }

        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
            const icon = document.querySelector('#themeToggle i');
            if (document.body.classList.contains('dark-mode')) {
                icon.className = 'fas fa-sun';
                localStorage.setItem('theme', 'dark');
            } else {
                icon.className = 'fas fa-moon';
                localStorage.setItem('theme', 'light');
            }
        }

        function enableChat() {
            document.getElementById('inputAI').disabled = false;
            document.getElementById('sendButton').disabled = false;
        }

        function disableChat() {
            document.getElementById('inputAI').disabled = true;
            document.getElementById('sendButton').disabled = true;
        }

        function actualizarSugerencias() {
            const suggestionsText = document.getElementById('suggestionsText');
            const ultimoMensaje = chatHistory[chatHistory.length - 1].mensaje.toLowerCase();
            
            if (ultimoMensaje.includes('música')) {
                suggestionsText.innerHTML = `
                    <strong>Sugerencias basadas en tu conversación:</strong><br>
                    • <span class="suggestion-chip" onclick="insertSuggestion('Recomiéndame música clásica')">Música clásica</span>
                    • <span class="suggestion-chip" onclick="insertSuggestion('Qué música es buena para dormir')">Música para dormir</span>
                    • <span class="suggestion-chip" onclick="insertSuggestion('Artistas de música ambiental')">Música ambiental</span>
                `;
            } else if (ultimoMensaje.includes('relaj')) {
                suggestionsText.innerHTML = `
                    <strong>Sugerencias basadas en tu conversación:</strong><br>
                    • <span class="suggestion-chip" onclick="insertSuggestion('Ejercicios de respiración')">Ejercicios de respiración</span>
                    • <span class="suggestion-chip" onclick="insertSuggestion('Meditación guiada')">Meditación guiada</span>
                    • <span class="suggestion-chip" onclick="insertSuggestion('Sonidos relajantes')">Sonidos relajantes</span>
                `;
            } else {
                suggestionsText.innerHTML = `
                    <strong>Sugerencias personalizadas:</strong><br>
                    Basado en nuestra conversación, puedo ayudarte con técnicas de relajación, recomendaciones musicales, o simplemente mantener una charla amena.
                `;
            }
        }

        function mostrarNotificacion(mensaje, tipo) {
            const notification = document.getElementById('notification');
            notification.textContent = mensaje;
            notification.className = notification ${tipo} show;
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Cargar tema guardado
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            document.querySelector('#themeToggle i').className = 'fas fa-sun';
        }
    </script>
</body>
</html>