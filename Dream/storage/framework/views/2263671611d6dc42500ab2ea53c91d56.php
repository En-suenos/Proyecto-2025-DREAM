<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Playlists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a2a6c, #2c3e50);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
            padding-top: 90px; /* Ajuste para navbar */
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(26, 42, 108, 0.9);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #4fc3f7;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .navbar-toggler {
            border: none;
            background: none;
            color: #fff;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-collapse {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(26, 42, 108, 0.95);
            backdrop-filter: blur(10px);
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .navbar-collapse.show {
            display: block;
        }

        .navbar-nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 0;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
            padding: 10px 0;
        }

        .nav-link:hover {
            color: #4fc3f7;
        }

        @media (min-width: 769px) {
            .navbar-toggler {
                display: none;
            }

            .navbar-collapse {
                position: static;
                background: none;
                box-shadow: none;
                padding: 0;
                display: block !important;
            }

            .navbar-nav {
                flex-direction: row;
                gap: 20px;
            }

            .nav-link {
                padding: 0;
            }
        }

        .main-content {
            max-width: 1200px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .playlists-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            animation: gentleFloat 8s ease-in-out infinite;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        h1 {
            color: #4fc3f7;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            text-shadow: 0 0 20px rgba(79, 195, 247, 0.7);
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: #fff;
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .card.bg-secondary {
            background: linear-gradient(45deg, #6c757d, #495057);
        }

        .card.bg-primary {
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
        }

        .card.bg-success {
            background: linear-gradient(45deg, #66bb6a, #43a047);
        }

        .card-body {
            padding: 20px;
        }

        .btn-outline-light {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            transition: all 0.4s ease;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px) scale(1.05);
            border-color: #4fc3f7;
            color: #fff;
        }

        @media (max-width: 768px) {
            .main-content {
                max-width: 100%;
                padding: 0 20px;
            }
            
            .playlists-container {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">SleepWell</a>
        <button class="navbar-toggler" type="button" onclick="toggleNavbar()">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <a class="nav-link" href="#"><i class="fas fa-globe me-1"></i>Idioma</a>
                <a class="nav-link" href="#"><i class="fas fa-cog me-1"></i>Configuración</a>
            </div>
        </div>
    </nav>

    <main class="container main-content">
        <div class="playlists-container">
            <h1><i class="fas fa-music me-2"></i>Mis Playlists</h1>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-plus fa-3x mb-3"></i>
                            <h5>Crear Nueva Playlist</h5>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5>Relajación Total</h5>
                            <p class="mb-1">8 sonidos</p>
                            <small>Última modificación: Hoy</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5>Focus & Concentration</h5>
                            <p class="mb-1">6 sonidos</p>
                            <small>Última modificación: Ayer</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="<?php echo e(route('usuario_con_cuenta.index')); ?>" class="btn btn-outline-light">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleNavbar() {
            const navbarCollapse = document.getElementById('navbarNav');
            navbarCollapse.classList.toggle('show');
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\carpeta principal\Proyecto-2025-DREAM\Dream\resources\views/ventana playlista/index.blade.php ENDPATH**/ ?>