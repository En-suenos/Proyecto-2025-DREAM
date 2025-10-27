<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SleepAssistant - Ayuda para Problemas de Sueño</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        }
    </style>
</head>
<body>
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

        // Mostrar indicador de escritura
        function showTypingIndicator() {
            const chatContainer = document.getElementById('chatContainer');
            
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message ai-message';
            typingDiv.id = 'typingIndicator';
            
            typingDiv.innerHTML = `
                <div class="message-bubble typing-indicator">
                    <span>SleepAssistant está escribiendo</span>
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

        // Remover indicador de escritura
        function removeTypingIndicator() {
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }

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
    </script>
</body>
</html><?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\Dream\resources\views/ventana asistente AI/index.blade.php ENDPATH**/ ?>