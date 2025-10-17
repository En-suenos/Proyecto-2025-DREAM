<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Sonidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-5"><i class="fas fa-volume-up me-2"></i>Biblioteca de Sonidos</h1>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">
                                    <i class="fas fa-cloud-rain me-2"></i>Sonido de Lluvia
                                </h5>
                                <p class="card-text">Relajante lluvia constante</p>
                            </div>
                            <button class="btn btn-outline-primary btn-sm">Reproducir</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">
                                    <i class="fas fa-water me-2"></i>Olas del Mar
                                </h5>
                                <p class="card-text">Sonido de olas suaves</p>
                            </div>
                            <button class="btn btn-outline-primary btn-sm">Reproducir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('ventana-principal') }}" class="btn btn-primary">
                ← Volver al inicio
            </a>
        </div>
    </div>
</body>
</html>