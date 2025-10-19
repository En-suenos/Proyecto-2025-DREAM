<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - SoundScape</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Tus estilos aquí... */
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="main-container p-4 text-white">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h1 class="fw-bold mb-2">
                            <i class="fas fa-headphones me-2"></i>SoundScape
                        </h1>
                        <div class="badge bg-warning">
                            <i class="fas fa-user-clock me-1"></i> Sin iniciar sesión
                        </div>
                    </div>

                    <!-- Navegación rápida -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <select id="idiomaSelect" class="form-select form-select-sm bg-transparent text-white border-light me-3" onchange="cambiarIdioma()">
                                <option value="es" selected>Español</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                        <div class="d-flex">
                            <!-- CORREGIDO: usar guiones -->
                            <a href="<?php echo e(route('inicio-sesion.index')); ?>" class="btn btn-outline-light me-2">
                                <i class="fas fa-sign-in-alt me-1"></i>Inicio de Sesión
                            </a>
                            <button class="btn btn-outline-light notification-badge me-2" onclick="mostrarNotificaciones()">
                                <i class="fas fa-bell me-1"></i>Notificaciones
                                <span class="badge bg-danger">3</span>
                            </button>
                            <button class="btn btn-outline-light" onclick="mostrarAI()">
                                <i class="fas fa-robot me-1"></i>Asistencia AI
                            </button>
                        </div>
                    </div>

                    <!-- Resto del contenido... -->

                    <!-- Botones de acción -->
                    <button class="btn btn-primary w-100 mb-3" onclick="iniciarModoSueno()">
                        <i class="fas fa-moon me-2"></i>Iniciar sueño - Inicio el modo sueño
                    </button>
                    
                    <!-- CORREGIDO: usar guiones -->
                    <a href="<?php echo e(route('inicio-sesion.index')); ?>" class="btn btn-success w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión - Para iniciar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tu JavaScript aquí...
    </script>
</body>
</html><?php /**PATH C:\laragon\www\sueñito\Dream\resources\views/ventana principal/index.blade.php ENDPATH**/ ?>