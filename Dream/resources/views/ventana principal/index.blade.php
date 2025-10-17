<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventana Principal - Sin Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="main-container p-4 text-white">
                    <div class="text-center mb-4">
                        <h1 class="fw-bold mb-2">
                            <i class="fas fa-headphones me-2"></i>SoundScape
                        </h1>
                        <div class="badge bg-warning">
                            <i class="fas fa-user-clock me-1"></i> Sin iniciar sesión
                        </div>
                    </div>

                    <div class="card bg-transparent border-light mb-4">
                        <div class="card-body">
                            <h4><i class="fas fa-music me-2"></i>PlayList</h4>
                            <p class="mb-3">Muestro todos los sonidos</p>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action bg-transparent text-white border-light">
                                    <i class="fas fa-volume-up me-2"></i>Sonido de Lluvia
                                </a>
                                <a href="#" class="list-group-item list-group-item-action bg-transparent text-white border-light">
                                    <i class="fas fa-water me-2"></i>Olas del Mar
                                </a>
                                <a href="#" class="list-group-item list-group-item-action bg-transparent text-white border-light">
                                    <i class="fas fa-tree me-2"></i>Bosque Tropical
                                </a>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-moon me-2"></i>Iniciar sueño - Inicio el modo sueño
                    </button>
                    
                    <a href="{{ route('inicio-sesion') }}" class="btn btn-success w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión - Para iniciar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>