<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Dream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<<<<<<< HEAD
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
=======
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-body {
            padding: 2rem;
>>>>>>> ramaView2
        }
        .profile-img {
            width: 120px;
            height: 120px;
<<<<<<< HEAD
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            transition: all 0.3s ease;
=======
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }
        .profile-img:hover {
            transform: scale(1.05);
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 12px;
            transition: border-color 0.3s, box-shadow 0.3s;
>>>>>>> ramaView2
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
<<<<<<< HEAD
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
=======
            border-radius: 25px;
            padding: 12px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-outline-secondary {
            border-radius: 25px;
            transition: all 0.3s;
        }
        .btn-outline-secondary:hover {
            background-color: #667eea;
            border-color: #667eea;
        }
        .back-link {
            color: #667eea;
            font-weight: 500;
        }
        .back-link:hover {
            color: #764ba2;
            text-decoration: none;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px 0 0 10px;
        }
        .invalid-feedback {
            display: none;
        }
        .was-validated .form-control:invalid ~ .invalid-feedback {
            display: block;
>>>>>>> ramaView2
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
<<<<<<< HEAD
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
=======
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4 text-primary"><i class="fas fa-user-circle me-2"></i>Mi Perfil</h2>
                        
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="https://via.placeholder.com/150" class="rounded-circle profile-img" id="profileImg" alt="Foto de perfil">
                                <button class="btn btn-sm btn-outline-secondary position-absolute bottom-0 end-0 rounded-circle" id="changePhotoBtn" title="Cambiar foto">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                            <h4 id="userName" class="mt-3">Usuario Ejemplo</h4>
                            <p class="text-muted" id="userEmail">usuario@ejemplo.com</p>
                        </div>

                        <form id="profileForm" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label"><i class="fas fa-user me-2"></i>Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="nombre" value="Juan Pérez" required>
                                        <div class="invalid-feedback">
                                            Por favor, ingresa un nombre válido.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" value="usuario@ejemplo.com" required>
                                        <div class="invalid-feedback">
                                            Por favor, ingresa un email válido.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label"><i class="fas fa-phone me-2"></i>Teléfono</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control" id="telefono" value="+1234567890" pattern="^\+?[1-9]\d{1,14}$">
                                    <div class="invalid-feedback">
                                        Por favor, ingresa un número de teléfono válido.
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Guardar Cambios</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('ventana-principal') }}" class="back-link">
                                <i class="fas fa-arrow-left me-2"></i>Volver al inicio
                            </a>
>>>>>>> ramaView2
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
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
=======
    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="confirmBtn">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para cambiar foto -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">Cambiar Foto de Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" class="form-control" id="photoInput" accept="image/*">
                    <small class="text-muted">Selecciona una imagen (máx. 5MB)</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="uploadBtn">Subir</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cargar datos del perfil desde localStorage
        function loadProfile() {
            const profile = JSON.parse(localStorage.getItem('userProfile')) || {
                name: 'Usuario Ejemplo',
                email: 'usuario@ejemplo.com',
                phone: '+1234567890',
                photo: 'https://via.placeholder.com/150'
            };
            document.getElementById('userName').textContent = profile.name;
            document.getElementById('userEmail').textContent = profile.email;
            document.getElementById('nombre').value = profile.name;
            document.getElementById('email').value = profile.email;
            document.getElementById('telefono').value = profile.phone;
            document.getElementById('profileImg').src = profile.photo;
        }

        // Guardar cambios
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (!this.checkValidity()) {
                e.stopPropagation();
                this.classList.add('was-validated');
                return;
            }

            const profile = {
                name: document.getElementById('nombre').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('telefono').value,
                photo: document.getElementById('profileImg').src
            };

            localStorage.setItem('userProfile', JSON.stringify(profile));
            document.getElementById('userName').textContent = profile.name;
            document.getElementById('userEmail').textContent = profile.email;

            document.getElementById('modalMessage').textContent = 'Cambios guardados exitosamente.';
            const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();
        });

        // Cambiar foto
        document.getElementById('changePhotoBtn').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('photoModal'));
            modal.show();
        });

        document.getElementById('uploadBtn').addEventListener('click', function() {
            const fileInput = document.getElementById('photoInput');
            const file = fileInput.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) { // 5MB limit
                    alert('La imagen es demasiado grande. Máximo 5MB.');
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImg').src = e.target.result;
                    const profile = JSON.parse(localStorage.getItem('userProfile')) || {};
                    profile.photo = e.target.result;
                    localStorage.setItem('userProfile', JSON.stringify(profile));
                    bootstrap.Modal.getInstance(document.getElementById('photoModal')).hide();
                };
                reader.readAsDataURL(file);
            }
        });

        window.onload = loadProfile;
>>>>>>> ramaView2
    </script>
</body>
</html>
