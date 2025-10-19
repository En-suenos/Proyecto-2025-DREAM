<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaneo de Rostro con API Externa</title>
    <style>
        /* Mismo CSS que antes */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            text-align: center;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin: 10px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        .video-container {
            position: relative;
            display: inline-block;
            margin: 20px 0;
        }
        #video {
            border: 1px solid #ddd;
            border-radius: 4px;
            max-width: 100%;
            height: auto;
        }
        #canvas {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        #faceStatus {
            margin-top: 20px;
            font-weight: bold;
        }
        .alert {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Escaneo de Rostro con API Externa</h1>
        
        <button id="startFaceScanBtn">Iniciar Escaneo de Rostro</button>
        <button id="captureAndAnalyzeBtn">Capturar y Analizar</button>
        
        <div class="video-container">
            <video id="video" width="640" height="480" autoplay muted></video>
            <canvas id="canvas" width="640" height="480"></canvas>
        </div>
        
        <p id="faceStatus">Haz clic en "Iniciar Escaneo de Rostro" para comenzar.</p>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        let stream;

        // Función para iniciar la cámara
        async function startFaceScan() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
                document.getElementById('faceStatus').textContent = "Cámara activada. Haz clic en 'Capturar y Analizar'.";
            } catch (error) {
                document.getElementById('faceStatus').textContent = `Error: ${error.message}`;
            }
        }

        // Función para capturar un frame y enviarlo a la API
        async function captureAndAnalyze() {
            if (!stream) {
                alert("Primero inicia el escaneo de rostro.");
                return;
            }

            // Dibujar el frame actual en el canvas
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convertir canvas a blob (imagen)
            canvas.toBlob(async (blob) => {
                const formData = new FormData();
                formData.append('image', blob);

                // Llamada a la API (ejemplo con Azure Face API)
                const apiKey = 'YOUR_API_KEY';  // Reemplaza con tu clave
                const endpoint = 'YOUR_ENDPOINT';  // Ej: https://your-resource.cognitiveservices.azure.com/face/v1.0/detect

                try {
                    const response = await fetch(`${endpoint}?returnFaceAttributes=emotion`, {
                        method: 'POST',
                        headers: {
                            'Ocp-Apim-Subscription-Key': apiKey,
                            'Content-Type': 'application/octet-stream'
                        },
                        body: blob
                    });

                    if (!response.ok) throw new Error('Error en la API');

                    const data = await response.json();
                    processApiResponse(data);
                } catch (error) {
                    document.getElementById('faceStatus').textContent = `Error en la API: ${error.message}`;
                }
            });
        }

        // Procesar la respuesta de la API
        function processApiResponse(data) {
            if (data.length === 0) {
                document.getElementById('faceStatus').textContent = "No se detectó ningún rostro.";
                return;
            }

            let statusText = `Rostro(s) detectado(s): ${data.length}`;
            let isSleepy = false;

            data.forEach((face, index) => {
                const emotions = face.faceAttributes.emotion;
                // Ejemplo: Si la emoción "neutral" o "sad" es alta, o si hay baja "happiness", podría indicar sueño/fatiga
                // Para sueño específico, podrías usar un modelo personalizado o analizar "eyes closed" si la API lo soporta
                if (emotions.neutral > 0.7 || emotions.sad > 0.5) {
                    isSleepy = true;
                    statusText += ` - ¡Posible sueño/fatiga en rostro ${index + 1}!`;
                }
            });

            const statusElement = document.getElementById('faceStatus');
            statusElement.textContent = statusText;
            if (isSleepy) {
                statusElement.classList.add('alert');
            } else {
                statusElement.classList.remove('alert');
            }
        }

        // Event Listeners
        document.getElementById('startFaceScanBtn').addEventListener('click', startFaceScan);
        document.getElementById('captureAndAnalyzeBtn').addEventListener('click', captureAndAnalyze);
    </script>
</body>
</html>

<?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\resources\views/ventana detector facial/index.blade.php ENDPATH**/ ?>