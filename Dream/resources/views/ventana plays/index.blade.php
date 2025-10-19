<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reproductor de Música con estilo de aplicación móvil moderno.">
    <title>Reproductor de musica de dormir</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        /* Variables y Estilos Base */
        :root {
            --color-fondo-app: #121212;
            --color-fondo-oscuro: #1e1e1e;
            --color-texto-claro: #ffffff;
            --color-resalte-naranja: #ff5722;
            --color-resalte-azul: #007bff;
            --color-resalte-fuerte: #bb86fc; /* Púrpura/Lila para acentos */
            --color-separador: #333333;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--color-fondo-app);
            color: var(--color-texto-claro);
            margin: 0;
            padding: 0;
            display: flex; /* Para simular la estructura de la app completa */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden; /* Oculta barras de desplazamiento si la 'app' cabe en la pantalla */
        }

        /* Contenedor principal que simula la pantalla del teléfono */
        .app-container {
            width: 380px; /* Ancho típico de un smartphone en vista vertical */
            height: 800px; /* Altura para simular la pantalla */
            background-color: var(--color-fondo-oscuro);
            border-radius: 20px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Encabezado (Header) de la app */
        .app-header {
            background-color: var(--color-fondo-app);
            padding: 15px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
            border-bottom: 1px solid var(--color-separador);
        }

        /* Barra de navegación de categorías (CANCIONES, LISTA DE REPRODUCCIÓN) */
        .nav-tabs-mobile {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            padding: 10px 15px;
            background-color: var(--color-fondo-oscuro);
        }

        .nav-link-mobile {
            text-decoration: none;
            color: var(--color-texto-claro);
            font-size: 0.9rem;
            font-weight: 500;
            padding-bottom: 5px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s, border-bottom 0.3s;
            text-transform: uppercase;
        }

        .nav-link-mobile.active {
            opacity: 1;
            border-bottom: 3px solid var(--color-resalte-fuerte);
            font-weight: bold;
        }

        /* Contenido de la lista de canciones */
        .song-list-content {
            flex-grow: 1; /* Ocupa el espacio restante */
            overflow-y: auto; /* Permite desplazamiento si la lista es larga */
            padding-bottom: 10px;
        }

        /* Item de la lista: Barajar Todo */
        .shuffle-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 15px;
            cursor: pointer;
            transition: background-color 0.2s;
            color: var(--color-resalte-fuerte);
            font-weight: bold;
        }

        .shuffle-icon {
            font-size: 1.2rem;
        }
        
        /* Estilo de la canción individual */
        .song-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid var(--color-separador);
            transition: background-color 0.2s;
        }

        .song-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .song-item-image {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            margin-right: 15px;
            object-fit: cover;
        }

        .song-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.2;
        }

        .song-title {
            font-size: 1rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .song-artist {
            font-size: 0.85rem;
            color: #aaaaaa; /* Tono de gris para el artista */
        }
        
        .song-details {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .song-duration {
            font-size: 0.75rem;
            color: #777777; /* Tono de gris más oscuro para la duración */
        }

        /* Etiqueta de calidad (HQ) */
        .song-quality-tag {
            background-color: var(--color-resalte-naranja);
            color: #fff;
            padding: 1px 5px;
            border-radius: 3px;
            font-size: 0.6rem;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        /* Icono de opciones (tres puntos) */
        .song-options-icon {
            font-size: 1.5rem;
            color: #888888;
        }
        
        /* Clase para la canción actual (ejemplo: Esa Diva) */
        .song-item.playing .song-title {
            color: var(--color-resalte-fuerte);
        }
        
        /* Ocultar vistas no necesarias en este ejemplo */
        .hidden { display: none; }
    </style>
</head>
<body>

    <div class="app-container">
        <header class="app-header">
            Reproductor de Música
        </header>

        <nav class="nav-tabs-mobile">
            <a href="#" class="nav-link-mobile active" id="tab-canciones">CANCIONES</a>
            <a href="#" class="nav-link-mobile" id="tab-playlist">LISTA DE REPRODUCCIÓN</a>
        </nav>

        <div id="canciones-content" class="song-list-content">

            <div class="shuffle-item" onclick="shuffleAll()">
                <i class="bi bi-shuffle shuffle-icon"></i>
                <span>Barajar Todo</span>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/FF5722/FFFFFF?text=A1" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">Still Luvin</div>
                    <div class="song-artist">Delassa, Quevedo, Bigla The...</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">3:09</span>
                    <span class="song-quality-tag" style="background-color: var(--color-resalte-azul);">HQ</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>

            <div class="song-item">
                <img src="https://via.placeholder.com/50/4CAF50/FFFFFF?text=A2" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">GUAYA</div>
                    <div class="song-artist">RK, Quevedo</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/9C27B0/FFFFFF?text=A3" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">BAILE INOLVIDABLE</div>
                    <div class="song-artist">Bad Bunny</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item playing">
                <img src="https://via.placeholder.com/50/E91E63/FFFFFF?text=A4" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">Esa Diva</div>
                    <div class="song-artist">Melody</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/2196F3/FFFFFF?text=A5" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">NINFO</div>
                    <div class="song-artist">JC Reyes, De la Rosa...</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">3:30</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/FF9800/FFFFFF?text=A6" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">6 DE FEBRERO</div>
                    <div class="song-artist">Aitana</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            <div class="song-item">
                <img src="https://via.placeholder.com/50/673AB7/FFFFFF?text=A7" alt="Album Art" class="song-item-image">
                <div class="song-info">
                    <div class="song-title">MAS QUE ALGO</div>
                    <div class="song-artist">Mora, Omar Courtz</div>
                </div>
                <div class="song-details">
                    <span class="song-duration">320K</span>
                </div>
                <i class="bi bi-three-dots-vertical song-options-icon"></i>
            </div>
            
            </div>
        
    </div>

    <script>
        function shuffleAll() {
            alert('¡Barajando todas las canciones!')
        }
        document.getElementById('tab-playlist').addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.add('active');
            document.getElementById('tab-canciones').classList.remove('active');
            
            alert('Cambiando a Lista de Reproducción');
        });

        document.getElementById('tab-canciones').addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.add('active');
            document.getElementById('tab-playlist').classList.remove('active');
        });
        
    </script>
</body>
</html>
