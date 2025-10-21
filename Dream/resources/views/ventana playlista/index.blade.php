<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Playlists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-dark text-white">
    <div class="container py-5">
        <h1 class="text-center mb-5"><i class="fas fa-music me-2"></i>Mis Playlists</h1>
        
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
            <a href="{{ route('ventana-principal') }}" class="btn btn-outline-light">
                ← Volver al inicio
            </a>
        </div>
    </div>
</body>
</html>
