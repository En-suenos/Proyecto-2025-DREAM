<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Dream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .profile-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 20px;
        }
        .profile-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            margin: -2rem -2rem 2rem -2rem;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }
        .back-link {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #764ba2;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Tarjeta Principal -->
                <div class="card profile-card shadow-lg">
                    <div class="card-body p-4">
                        <!-- Header del Perfil -->
                        <div class="profile-header text-center text-white">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&h=150&q=80" 
                                 class="profile-img rounded-circle mb-3" alt="Foto de perfil">
                            <h3 class="mb-1">Juan Pérez Rodríguez</h3>
                            <p class="mb-0 opacity-75">
                                <i class="fas fa-star text-warning"></i>
                                Usuario Premium
                            </p>
                        </div>

                        <div class="row">
                            <!-- Columna Izquierda - Estadísticas -->
                            <div class="col-md-4 mb-4">
                                <div class="stats-card text-center">
                                    <i class="fas fa-moon text-primary fa-2x mb-3"></i>
                                    <div class="stat-number">12</div>
                                    <p class="text-muted mb-0">Sesiones de Sueño</p>
                                </div>
                                <div class="stats-card text-center">
                                    <i class="fas fa-clock text-success fa-2x mb-3"></i>
                                    <div class="stat-number">45h</div>
                                    <p class="text-muted mb-0">Tiempo Total</p>
                                </div>
                                <div class="stats-card text-center">
                                    <i class="fas fa-chart-line text-info fa-2x mb-3"></i>
                                    <div class="stat-number">8.5</div>
                                    <p class="text-muted mb-0">Calificación</p>
                                </div>
                            </div>

                            <!-- Columna Derecha - Formulario -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <h4 class="card-title mb-4">
                                            <i class="fas fa-user-edit text-primary me-2"></i>
                                            Editar Perfil
                                        </h4>
                                        
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="nombre" class="form-label">
                                                        <i class="fas fa-user me-2 text-muted"></i>
                                                        Nombre
                                                    </label>
                                                    <input type="text" class="form-control" id="nombre" value="Juan Pérez">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="apellido" class="form-label">
                                                        <i class="fas fa-user me-2 text-muted"></i>
                                                        Apellido
                                                    </label>
                                                    <input type="text" class="form-control" id="apellido" value="Rodríguez">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="email" class="form-label">
                                                    <i class="fas fa-envelope me-2 text-muted"></i>
                                                    Email
                                                </label>
                                                <input type="email" class="form-control" id="email" value="juan.perez@dream.com">
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="telefono" class="form-label">
                                                        <i class="fas fa-phone me-2 text-muted"></i>
                                                        Teléfono
                                                    </label>
                                                    <input type="tel" class="form-control" id="telefono" value="+1234567890">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="fecha_nacimiento" class="form-label">
                                                        <i class="fas fa-calendar me-2 text-muted"></i>
                                                        Fecha de Nacimiento
                                                    </label>
                                                    <input type="date" class="form-control" id="fecha_nacimiento" value="1990-05-15">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="preferencias" class="form-label">
                                                    <i class="fas fa-music me-2 text-muted"></i>
                                                    Preferencias de Sonido
                                                </label>
                                                <select class="form-control" id="preferencias">
                                                    <option selected>Sonidos Naturales</option>
                                                    <option>Música Relajante</option>
                                                    <option>Sonidos Blancos</option>
                                                    <option>Meditación Guiada</option>
                                                </select>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i>
                                                    Guardar Cambios
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary">
                                                    <i class="fas fa-lock me-2"></i>
                                                    Cambiar Contraseña
                                                </button>
                                            </div>
                                        </form>

                                        <!-- Enlace de regreso -->
                                        <div class="text-center mt-4">
                                            <a href="/" class="back-link">
                                                <i class="fas fa-arrow-left me-2"></i>
                                                Volver al Inicio
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Efectos interactivos simples
        document.addEventListener('DOMContentLoaded', function() {
            // Animación al hacer hover en las tarjetas de stats
            const statsCards = document.querySelectorAll('.stats-card');
            statsCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Validación básica del formulario
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Simular guardado exitoso
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                
                Toast.fire({
                    icon: 'success',
                    title: 'Perfil actualizado correctamente'
                });
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\resources\views/ventana perfil/index.blade.php ENDPATH**/ ?>