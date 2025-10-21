<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Dream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }
        .profile-img {
            width: 120px;
            height: 120px;
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
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
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
        }
    </style>
</head>
<body class="bg-light">
    <!--
    <div class="container py-5">
        <div class="row justify-content-center">
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
                            <a href="{{ route('ventana-principal.index') }}" class="back-link">
                                <i class="fas fa-arrow-left me-2"></i>Volver al inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- Modal de confirmación -->
     <!--
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
    </div>-->

    <!-- Modal para cambiar foto -->
     <!--
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
    </script>-->
</body>
</html>
