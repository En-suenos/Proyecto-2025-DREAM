<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación de Asistente AI con interfaz moderna y configuración opcional de API.">
    <title>Asistente AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* [Estilos CSS permanecen iguales, pero agregué algunos ajustes menores para profesionalismo] */
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
            transition: color 0.3s;
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
        
        .api-key-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }
        
        .dark-mode .api-key-section {
            background-color: #2d2d44;
        }
        
        .api-key-toggle {
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
        }
        
        .api-key-input-container {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .api-status {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            font-size: 0.9rem;
        }
        
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #6c757d;
            transition: background-color 0.3s;
        }
        
        .status-dot.active {
            background-color: #28a745;
        }
        
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
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
            
            .api-key-input-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <main class="app-container">
        <header class="header">
            <h1 class="app-title">
                <i class="fas fa-robot" aria-hidden="true"></i> Asistente AI
            </h1>
            <button class="theme-toggle" id="themeToggle" aria-label="Cambiar tema">
                <i class="fas fa-moon" aria-hidden="true"></i>
            </button>
        </header>

        <div id="asistente">
            <!-- Sección de configuración de API Key -->
            <div class="api-key-section" role="region" aria-labelledby="api-config-title">
                <p id="api-config-title"><strong>Configuración opcional:</strong> Para respuestas avanzadas, agrega tu clave de OpenAI.</p>
                
                <div class="api-status">
                    <div class="status-dot" id="statusDot" aria-hidden="true"></div>
                    <span id="statusText">Modo gratuito activado</span>
                </div>
                
                <button class="api-key-toggle" id="apiKeyToggle" aria-expanded="false" aria-controls="apiKeyContainer">
                    <i class="fas fa-chevron-down" aria-hidden="true"></i> Configurar API Key
                </button>
                
                <div class="api-key-input-container hidden" id="apiKeyContainer">
                    <input type="password" id="apiKeyInput" class="form-control" placeholder="Ingresa tu clave de API de OpenAI" aria-label="Clave de API de OpenAI">
                    <button onclick="saveApiKey()" class="btn btn-primary" id="saveApiBtn">
                        <i class="fas fa-save" aria-hidden="true"></i> Guardar
                    </button>
                    <button onclick="removeApiKey()" class="btn btn-outline-secondary" id="removeApiBtn">
                        <i class="fas fa-trash" aria-hidden="true"></i> Eliminar
                    </button>
                </div>
                
                <small class="text-muted">Tu clave se guarda localmente y no se comparte.</small>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-comments" aria-hidden="true"></i>
                            Charla con AI
                        </div>
                        <div class="card-body">
                            <div class="chat-container" id="chatContainer" role="log" aria-live="polite" aria-label="Historial de chat">
                                <!-- Mensajes se cargan aquí -->
                            </div>
                            
                            <div class="input-group">
                                <input type="text" id="inputAI" class="form-control" placeholder="Escribe tu mensaje aquí..." aria-label="Mensaje para el asistente AI">
                                <button onclick="interactuarAI()" id="sendButton" class="btn btn-primary" aria-label="Enviar mensaje">
                                    <i class="fas fa-paper-plane" aria-hidden="true"></i> Enviar
                                </button>
                            </div>
                            
                            <div class="suggestions">
                                <div class="suggestion-chip" onclick="insertSuggestion('¿Qué puedes hacer?')" role="button" tabindex="0">¿Qué puedes hacer?</div>
                                <div class="suggestion-chip" onclick="insertSuggestion('Cuéntame un chiste')" role="button" tabindex="0">Cuéntame un chiste</div>
                                <div class="suggestion-chip" onclick="insertSuggestion('Recomiéndame música')" role="button" tabindex="0">Recomiéndame música</div>
                                <div class="suggestion-chip" onclick="insertSuggestion('Ayúdame a relajarme')" role="button" tabindex="0">Ayúdame a relajarme</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-history" aria-hidden="true"></i>
                            Historial de Conversación
                        </div>
                        <div class="card-body p-0">
                            <div class="table-container">
                                <table id="asistenteTable" class="table table-striped" role="table" aria-label="Historial de conversación">
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable(0)" role="columnheader" aria-sort="none">Mensaje <i class="fas fa-sort" aria-hidden="true"></i></th>
                                            <th onclick="sortTable(1)" role="columnheader" aria-sort="none">De <i class="fas fa-sort" aria-hidden="true"></i></th>
                                            <th onclick="sortTable(2)" role="columnheader" aria-sort="none">Hora <i class="fas fa-sort" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody id="asistenteTableBody">
                                        <!-- Contenido de la tabla -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-lightbulb" aria
