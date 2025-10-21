<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SleepAssistant - Ayuda para Problemas de Sueño</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Agregado: Script de Transformers.js -->
    <script src="https://cdn.jsdelivr.net/npm/@huggingface/transformers@3.0.0/dist/transformers.min.js"></script>
    <style>
<<<<<<< HEAD
=======
        /* El CSS permanece igual, lo omito por brevedad, pero inclúyelo completo en tu archivo */
>>>>>>> ramaView2
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #2c4d7a;
            --accent-color: #6c63ff;
            --light-blue: #e3f2fd;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .app-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .chat-container {
            height: 400px;
            overflow-y: auto;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .message {
            margin-bottom: 15px;
            display: flex;
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
            padding: 12px 16px;
            border-radius: 18px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .user-message .message-bubble {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .ai-message .message-bubble {
            background: white;
            color: #333;
            border: 1px solid #ddd;
        }
        
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            color: #666;
            font-style: italic;
        }
        
        .typing-dots {
            display: flex;
            gap: 4px;
        }
        
        .typing-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary-color);
            animation: typing 1.4s infinite ease-in-out;
        }
        
        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }
        
        @keyframes typing {
            0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }
        
        .info-box {
            background: var(--light-blue);
            border: 1px solid #bbdefb;
            border-radius: 10px;
            padding: 15px;
<<<<<<< HEAD
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
        
<<<<<<< HEAD
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
        
=======
>>>>>>> ramaView2
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
=======
            margin-bottom: 20px;
        }
        
        .sleep-tips {
            background: #f0f8ff;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }
        
        .tip-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .sounds-panel {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .sound-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .sound-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .sound-card.active {
            border-color: var(--primary-color);
            background: #e8f4fd;
        }
        
        .sound-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }
        
        .volume-slider {
            flex: 1;
        }
        
        .sound-icon {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 10px;
        }
        
        .timer-control {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.8rem;
            cursor: pointer;
>>>>>>> InterfasC
        }
    </style>
</head>
<body>
<<<<<<< HEAD
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
=======
    <div class="app-container">
        <div class="header">
            <h1><i class="fas fa-moon"></i> SleepAssistant</h1>
            <p>Tu especialista en problemas de sueño - Mejora tu descanso nocturno</p>
        </div>

        <div class="container mt-4">
            <!-- Información -->
            <div class="info-box">
                <h4><i class="fas fa-info-circle"></i> Especialista en Sueño</h4>
                <p class="mb-0">Soy tu asistente especializado en problemas de sueño. Ahora con sonidos relajantes integrados para ayudarte a dormir mejor.</p>
            </div>

            <!-- Panel de Sonidos Relajantes -->
            <div class="sounds-panel">
                <h4><i class="fas fa-music"></i> Sonidos Relajantes</h4>
                <p class="mb-3">Selecciona un sonido para ayudarte a relajarte y conciliar el sueño:</p>
                
                <div class="sound-card" onclick="toggleSound('rain')" id="rainSound">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-cloud-rain sound-icon"></i>
                        <div>
                            <h6 class="mb-1">Lluvia Suave</h6>
                            <small>Sonido de lluvia relajante</small>
>>>>>>> InterfasC
                        </div>
                    </div>
                    <div class="sound-controls">
                        <input type="range" class="volume-slider" min="0" max="100" value="50" oninput="setVolume('rain', this.value)">
                        <button class="timer-control" onclick="setTimer('rain')">30 min</button>
                    </div>
                </div>
                
                <div class="sound-card" onclick="toggleSound('waves')" id="wavesSound">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-water sound-icon"></i>
                        <div>
                            <h6 class="mb-1">Olas del Mar</h6>
                            <small>Sonido de olas relajantes</small>
                        </div>
                    </div>
                    <div class="sound-controls">
                        <input type="range" class="volume-slider" min="0" max="100" value="50" oninput="setVolume('waves', this.value)">
                        <button class="timer-control" onclick="setTimer('waves')">30 min</button>
                    </div>
                </div>
                
                <div class="sound-card" onclick="toggleSound('forest')" id="forestSound">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tree sound-icon"></i>
                        <div>
                            <h6 class="mb-1">Bosque Nocturno</h6>
                            <small>Sonidos de la naturaleza</small>
                        </div>
                    </div>
                    <div class="sound-controls">
                        <input type="range" class="volume-slider" min="0" max="100" value="50" oninput="setVolume('forest', this.value)">
                        <button class="timer-control" onclick="setTimer('forest')">30 min</button>
                    </div>
                </div>
                
                <div class="sound-card" onclick="toggleSound('white')" id="whiteSound">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-wind sound-icon"></i>
                        <div>
                            <h6 class="mb-1">Ruido Blanco</h6>
                            <small>Para enmascarar sonidos externos</small>
                        </div>
                    </div>
                    <div class="sound-controls">
                        <input type="range" class="volume-slider" min="0" max="100" value="50" oninput="setVolume('white', this.value)">
                        <button class="timer-control" onclick="setTimer('white')">30 min</button>
                    </div>
                </div>
                
                <div class="mt-3">
                    <button class="btn btn-outline-danger btn-sm" onclick="stopAllSounds()">
                        <i class="fas fa-stop"></i> Parar Todos los Sonidos
                    </button>
                </div>
            </div>

            <!-- Chat -->
            <div class="chat-container" id="chatContainer">
                <div class="message ai-message">
                    <div class="message-bubble">
                        <h5><i class="fas fa-moon"></i> ¡Bienvenido a SleepAssistant!</h5>
                        <p>Soy tu especialista en sueño. Ahora con <strong>sonidos relajantes integrados</strong> para ayudarte a dormir mejor.</p>
                        <p>Puedo ayudarte con:</p>
                        <ul>
                            <li>Problemas de insomnio</li>
                            <li>Rutinas para dormir mejor</li>
                            <li>Higiene del sueño</li>
                            <li>Técnicas de relajación</li>
                            <li>Sonidos para dormir</li>
                        </ul>
                        <p>Prueba los sonidos relajantes de arriba y cuéntame, ¿en qué aspecto de tu sueño te gustaría trabajar hoy?</p>
                    </div>
                </div>
            </div>
            
            <div class="input-group">
                <input type="text" id="userInput" class="form-control" placeholder="Describe tu problema de sueño o haz una pregunta..." autocomplete="off">
                <button id="sendButton" class="btn btn-primary" onclick="sendMessage()">
                    <i class="fas fa-paper-plane"></i> Enviar
                </button>
            </div>

            <div class="suggestions mt-3">
                <button class="btn btn-outline-primary btn-sm me-2" onclick="insertSuggestion('No puedo dormir por las noches')">
                    Insomnio
                </button>
                <button class="btn btn-outline-primary btn-sm me-2" onclick="insertSuggestion('Me despierto muchas veces')">
                    Sueño interrumpido
                </button>
                <button class="btn btn-outline-primary btn-sm me-2" onclick="insertSuggestion('Técnicas para relajarme antes de dormir')">
                    Relajación
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="insertSuggestion('Recomiéndame sonidos para dormir')">
                    Sonidos para dormir
                </button>
            </div>

            <!-- Consejos rápidos -->
            <div class="sleep-tips">
                <h5><i class="fas fa-lightbulb"></i> Consejos Rápidos para Dormir Mejor</h5>
                <div class="tip-card">
                    <h6><i class="fas fa-bed"></i> Horario Regular</h6>
                    <p class="mb-0">Acuéstate y levántate a la misma hora todos los días, incluso los fines de semana.</p>
                </div>
                <div class="tip-card">
                    <h6><i class="fas fa-mobile-alt"></i> Sin Pantallas</h6>
                    <p class="mb-0">Evita pantallas 1-2 horas antes de dormir. La luz azul afecta la melatonina.</p>
                </div>
                <div class="tip-card">
                    <h6><i class="fas fa-music"></i> Sonidos Relajantes</h6>
                    <p class="mb-0">Usa sonidos de lluvia, olas o ruido blanco para enmascarar sonidos molestos.</p>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
<<<<<<< HEAD
    <!-- Notificaciones -->
    <div id="notification" class="notification"></div>

=======
>>>>>>> ramaView2
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let chatHistory = [
            { mensaje: '¡Hola! Soy tu asistente AI local. ¿En qué puedo ayudarte hoy?', de: 'AI', hora: obtenerHoraActual() }
        ];
        
        let pipeline; // Variable para el modelo de Transformers.js
        let isTyping = false;
<<<<<<< HEAD
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
=======
    <script>
        let isTyping = false;
        let currentSound = null;
        let soundTimers = {};

        // Audio elements
        const sounds = {
            rain: new Audio('https://assets.mixkit.co/sfx/preview/mixkit-rain-against-window-1257.mp3'),
            waves: new Audio('https://assets.mixkit.co/sfx/preview/mixkit-waves-on-the-beach-1257.mp3'),
            forest: new Audio('https://assets.mixkit.co/sfx/preview/mixkit-forest-ambience-1257.mp3'),
            white: new Audio('https://assets.mixkit.co/sfx/preview/mixkit-wind-1257.mp3')
        };

        // Configurar los audios para loop
        Object.values(sounds).forEach(sound => {
            sound.loop = true;
            sound.volume = 0.5;
        });

        // Funciones de control de sonido
        function toggleSound(soundType) {
            const soundCard = document.getElementById(soundType + 'Sound');
>>>>>>> InterfasC
            
            if (currentSound === soundType) {
                // Parar el sonido actual
                sounds[soundType].pause();
                soundCard.classList.remove('active');
                currentSound = null;
                
                // Cancelar timer si existe
                if (soundTimers[soundType]) {
                    clearTimeout(soundTimers[soundType]);
                    delete soundTimers[soundType];
                }
            } else {
                // Parar cualquier sonido anterior
                stopAllSounds();
                
                // Reproducir nuevo sonido
                sounds[soundType].play();
                soundCard.classList.add('active');
                currentSound = soundType;
                
                addMessageToChat({
                    type: 'ai',
                    text: `🔊 Reproduciendo sonido de ${getSoundName(soundType)}. Este sonido te ayudará a relajarte y conciliar el sueño. Puedes ajustar el volumen y programar un timer.`
                });
            }
        }

        function setVolume(soundType, volume) {
            sounds[soundType].volume = volume / 100;
        }

        function setTimer(soundType) {
            const duration = 30 * 60 * 1000; // 30 minutos en milisegundos
            
            if (soundTimers[soundType]) {
                clearTimeout(soundTimers[soundType]);
            }
            
            soundTimers[soundType] = setTimeout(() => {
                sounds[soundType].pause();
                document.getElementById(soundType + 'Sound').classList.remove('active');
                currentSound = null;
                delete soundTimers[soundType];
                
                addMessageToChat({
                    type: 'ai',
                    text: '⏰ El timer ha terminado. Espero que hayas podido descansar bien. ¡Dulces sueños! 😴'
                });
            }, duration);
            
            addMessageToChat({
                type: 'ai',
                text: `⏰ Timer programado: el sonido se detendrá automáticamente en 30 minutos. Descansa tranquilo.`
            });
        }

        function stopAllSounds() {
            Object.keys(sounds).forEach(soundType => {
                sounds[soundType].pause();
                document.getElementById(soundType + 'Sound').classList.remove('active');
                
                if (soundTimers[soundType]) {
                    clearTimeout(soundTimers[soundType]);
                    delete soundTimers[soundType];
                }
            });
            currentSound = null;
        }

        function getSoundName(soundType) {
            const names = {
                rain: 'lluvia suave',
                waves: 'olas del mar',
                forest: 'bosque nocturno',
                white: 'ruido blanco'
            };
            return names[soundType];
        }

        // Base de conocimiento especializada en sueño
        const sleepKnowledge = {
            greetings: [
                "¡Hola! Soy SleepAssistant, tu especialista en sueño. ¿En qué aspecto de tu descanso nocturno te puedo ayudar hoy?",
                "¡Bienvenido! Me especializo en problemas de sueño. Cuéntame, ¿qué dificultades estás teniendo para dormir?",
                "¡Hola! Estoy aquí para ayudarte a mejorar tu calidad de sueño. ¿Qué te preocupa sobre tu descanso?"
            ],
            
            sleepSounds: `🎵 **SONIDOS PARA DORMIR - GUÍA COMPLETA**:

🔊 **LLUVIA SUCESIVA**: 
   - Enmascara sonidos externos
   - Ritmo constante y relajante
   - Ideal para personas sensibles al ruido

🌊 **OLAS DEL MAR**:
   - Sonido rítmico y natural
   - Evoca sensación de paz
   - Perfecto para visualización

🌳 **BOSQUE NOCTURNO**:
   - Sonidos de la naturaleza
   - Grillos y brisa suave
   - Conexión con lo natural

⚪ **RUIDO BLANCO**:
   - Enmascara todos los sonidos
   - Ideal para ciudades ruidosas
   - Ayuda con tinnitus

💡 **CONSEJOS DE USO**:
• Volumen bajo (30-50%)
• Usa timer de 30-60 minutos
• Combina con técnicas de respiración
• Prueba diferentes sonidos`,

            insomnia: `El insomnio es común pero tiene solución. Te recomiendo:

🔹 **ESTABLECE UNA RUTINA**: 
   - Acuéstate y levántate a la misma hora
   - Realiza actividades relajantes 1 hora antes de dormir
   - Evita siestas largas durante el día

🔹 **MEJORA TU AMBIENTE**:
   - Habitación oscura, silenciosa y fresca (18-20°C)
   - Cama cómoda y ropa de cama agradable
   - Elimina relojes visibles para evitar ansiedad

🔹 **HÁBITOS SALUDABLES**:
   - Evita cafeína después de las 2 PM
   - Cena ligera 2-3 horas antes de dormir
   - Ejercicio regular, pero no cerca de la hora de dormir

¿Qué aspecto te gustaría trabajar primero?`,

            relaxation: `Técnicas de relajación efectivas:

🧘 **RESPIRACIÓN 4-7-8**:
1. Inhala por la nariz 4 segundos
2. Mantén la respiración 7 segundos  
3. Exhala por la boca 8 segundos
4. Repite 4 veces

🌊 **RELAJACIÓN MUSCIONAL PROGRESIVA**:
Tensa y relaja cada grupo muscular por 5 segundos, empezando por los pies hasta la cabeza.

🎵 **SONIDOS RELAJANTES**:
• Usa los sonidos integrados arriba
• Combina con respiración profunda
• Enfócate en el sonido para calmar la mente

🛀 **BAÑO DE RELAJACIÓN**:
Agua tibia con sales de magnesio 1-2 horas antes de dormir.`,

            // ... (el resto del conocimiento permanece igual)
            wakeUpFrequently: `Despertarse frecuentemente puede deberse a: ...`,
            deepSleep: `Para un sueño más profundo: ...`,
            sleepRoutine: `Crea una rutina efectiva: ...`,
            sleepTracking: `Llevar un diario de sueño te ayuda: ...`,
            farewells: [
                "¡Que tengas una noche de descanso reparador! Recuerda ser constante con las técnicas.",
                "¡Dulces sueños! Practica estas técnicas y verás mejoras en tu descanso.",
                "¡Hasta luego! No dudes en consultarme si necesitas más ayuda con tu sueño."
            ]
        };

        // Enviar mensaje
        async function sendMessage() {
            if (isTyping) return;
            
            const userInput = document.getElementById('userInput');
            const message = userInput.value.trim();
            
            if (!message) return;
            
            // Agregar mensaje del usuario
            addMessageToChat({
                type: 'user',
                text: message
            });
            
            // Limpiar input
            userInput.value = '';
            
            // Deshabilitar envío
            isTyping = true;
            document.getElementById('sendButton').disabled = true;
            
            // Mostrar typing
            showTypingIndicator();
            
            // Simular procesamiento
            await new Promise(resolve => setTimeout(resolve, 800 + Math.random() * 800));
            
            // Generar respuesta especializada en sueño
            const response = generateSleepResponse(message);
            
            // Remover typing y mostrar respuesta
            removeTypingIndicator();
            addMessageToChat({
                type: 'ai',
                text: response
            });
            
            // Rehabilitar envío
            isTyping = false;
            document.getElementById('sendButton').disabled = false;
        }

        // Generar respuesta especializada en sueño
        function generateSleepResponse(message) {
            const lowerMessage = message.toLowerCase();
            
            // Saludos
            if (lowerMessage.includes('hola') || lowerMessage.includes('buenos') || lowerMessage.includes('buenas')) {
                return sleepKnowledge.greetings[Math.floor(Math.random() * sleepKnowledge.greetings.length)];
            }
            
            // Sonidos para dormir
            if (lowerMessage.includes('sonido') || lowerMessage.includes('música') || 
                lowerMessage.includes('audio') || lowerMessage.includes('relajante') ||
                lowerMessage.includes('ruido') || lowerMessage.includes('dormir')) {
                return sleepKnowledge.sleepSounds;
            }
            
            // Insomnio
            if (lowerMessage.includes('no puedo dormir') || lowerMessage.includes('insomnio') || 
                lowerMessage.includes('tardo en dormir') || lowerMessage.includes('me cuesta dormir')) {
                return sleepKnowledge.insomnia;
            }
            
            // Relajación
            if (lowerMessage.includes('relaj') || lowerMessage.includes('calmar') || 
                lowerMessage.includes('ansiedad') || lowerMessage.includes('estrés') ||
                lowerMessage.includes('nervios')) {
                return sleepKnowledge.relaxation;
            }
            
            // ... (resto de las respuestas especializadas)
            
            // Respuestas contextuales por defecto enfocadas en sueño
            const sleepResponses = [
                `Entiendo que estás buscando mejorar tu sueño. "${message}" es un aspecto importante. ¿Podrías contarme más detalles sobre tu situación específica?`,
                
                `Como especialista en sueño, puedo ayudarte con "${message}". Para darte consejos más personalizados, ¿podrías describir tu problema con más detalle?`,
                
                `El tema del sueño que mencionas "${message}" es común. Tengo varias técnicas que podrían ayudarte. ¿Qué es lo que más te afecta actualmente?`,
                
                `Sobre "${message}" en relación al sueño, tengo diferentes enfoques. ¿Te gustaría que profundice en técnicas específicas o prefieres una visión general?`
            ];
            
            return sleepResponses[Math.floor(Math.random() * sleepResponses.length)];
        }

        // Agregar mensaje al chat
        function addMessageToChat(message) {
            const chatContainer = document.getElementById('chatContainer');
            
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${message.type}-message`;
            
            messageDiv.innerHTML = `
                <div class="message-bubble">
                    ${message.text}
                </div>
            `;
            
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
<<<<<<< HEAD

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
=======

        // Mostrar indicador de escritura
        function showTypingIndicator() {
>>>>>>> InterfasC
            const chatContainer = document.getElementById('chatContainer');
            
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message ai-message';
            typingDiv.id = 'typingIndicator';
            
            typingDiv.innerHTML = `
<<<<<<< HEAD
                <i class="fas fa-robot ai-icon"></i>
                <div class="message-bubble">
                    <div class="typing-indicator">
                        AI está escribiendo
                        <div class="typing-dots">
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                        </div>
=======
                <div class="message-bubble typing-indicator">
                    <span>SleepAssistant está escribiendo</span>
                    <div class="typing-dots">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
>>>>>>> InterfasC
                    </div>
                </div>
            `;
            
            chatContainer.appendChild(typingDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

<<<<<<< HEAD
        function ocultarTypingIndicator() {
=======
        // Remover indicador de escritura
        function removeTypingIndicator() {
>>>>>>> InterfasC
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }

<<<<<<< HEAD
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
=======
        // Insertar sugerencia
        function insertSuggestion(text) {
            document.getElementById('userInput').value = text;
            document.getElementById('userInput').focus();
        }

        // Enter para enviar
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('userInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !isTyping) {
                    sendMessage();
                }
            });
            
            document.getElementById('userInput').focus();
        });
>>>>>>> InterfasC
    </script>
</body>
</html>
=======

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
                pipeline = await pipeline('text-generation', 'microsoft/DialoGPT-small');
                document.getElementById('loadingModel').style.display = 'none';
                enableChat();
                mostrarNotificacion('Modelo cargado correctamente. ¡Puedes chatear!', 'success');
            } catch (error) {
                console.error('Error cargando el modelo:', error);
                mostrarNotificacion('Error al cargar el modelo. Verifica tu conexión e intenta recargar la página.', 'error');
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
>>>>>>> ramaView2
