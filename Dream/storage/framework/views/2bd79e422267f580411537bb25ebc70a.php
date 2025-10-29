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
        }
        .card-body {
            padding: 2rem;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            object-fit: cover;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .profile-img:hover {
            transform: scale(1.05);
            border-color: #667eea;
        }
        .profile-img-placeholder {
            width: 120px;
            height: 120px;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-size: 3rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .profile-img-placeholder:hover {
            transform: scale(1.05);
            border-color: #667eea;
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 12px;
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
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-outline-secondary {
            border-radius: 25px;
        }
        
        /* Estilos para el campo de contraseña con ojito */
        .password-container {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            transition: color 0.3s ease;
            z-index: 10;
            padding: 5px;
        }
        
        .toggle-password:hover {
            color: #667eea;
        }
        
        .form-control.password-input {
            padding-right: 50px;
        }

        .image-preview {
            max-width: 150px;
            max-height: 150px;
            border-radius: 10px;
            display: none;
            margin-top: 10px;
            border: 2px solid #ddd;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .image-actions {
            margin-top: 10px;
        }

        .camera-overlay {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .profile-img-container {
            position: relative;
            display: inline-block;
        }

        .hidden-file-input {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="profile-img-container">
                                <?php if($usuario->imagen): ?>
                                    <img src="<?php echo e(asset('storage/perfil/' . $usuario->imagen)); ?>" 
                                         alt="Foto de perfil" 
                                         class="profile-img rounded-circle mb-3"
                                         onclick="document.getElementById('imagen').click()">
                                <?php else: ?>
                                    <div class="profile-img-placeholder rounded-circle text-white d-inline-flex align-items-center justify-content-center mx-auto"
                                         onclick="document.getElementById('imagen').click()">
                                        <i class="fas fa-user"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="camera-overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>
                            <br>
                            <?php if($usuario->imagen): ?>
                                <form action="<?php echo e(route('perfil.eliminar-imagen')); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-outline-danger btn-sm" 
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar tu foto de perfil?')">
                                        <i class="fas fa-trash me-1"></i>Eliminar Foto
                                    </button>
                                </form>
                            <?php else: ?>
                                <small class="text-muted">Haz clic en la imagen para cambiar la foto</small>
                            <?php endif; ?>
                            <h4 class="mt-3"><?php echo e($usuario->nombre); ?></h4>
                            <p class="text-muted"><?php echo e($usuario->correo); ?></p>
                            <?php
                                $tipoBadge = $usuario->tipo_usuario === 'premium' ? 'warning' : ($usuario->tipo_usuario === 'admin' ? 'danger' : 'info');
                            ?>
                            <span class="badge bg-<?php echo e($tipoBadge); ?>"><?php echo e(ucfirst($usuario->tipo_usuario)); ?></span>
                        </div>

                        <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>

                        <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>

                        <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <h5 class="mb-3"><i class="fas fa-edit me-2"></i>Editar Información</h5>
                        
                        <form action="<?php echo e(route('perfil.update')); ?>" method="POST" enctype="multipart/form-data" id="profileForm">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            
                            <!-- Campo de imagen oculto - se activa al hacer clic en la foto -->
                            <input type="file" class="hidden-file-input" name="imagen" id="imagen" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                   onchange="handleImageSelection(this)">

                            <!-- Información de la imagen seleccionada -->
                            <div class="mb-3" id="imageInfo" style="display: none;">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <span id="selectedImageName"></span>
                                    <img id="imagePreview" class="image-preview mt-2" alt="Vista previa">
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="cancelImageSelection()">
                                            <i class="fas fa-times me-1"></i>Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nombre
                                </label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo e(old('nombre', $usuario->nombre)); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Correo Electrónico
                                </label>
                                <input type="email" class="form-control" name="correo" value="<?php echo e(old('correo', $usuario->correo)); ?>" required>
                            </div>

                            <hr class="my-4">
                            
                            <h5 class="mb-3"><i class="fas fa-key me-2"></i>Cambiar Contraseña (Opcional)</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Contraseña Actual</label>
                                <div class="password-container">
                                    <input type="password" class="form-control password-input" name="contrasena_actual" id="contrasenaActual">
                                    <button type="button" class="toggle-password" id="toggleContrasenaActual">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Dejar en blanco si no deseas cambiar la contraseña</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nueva Contraseña</label>
                                <div class="password-container">
                                    <input type="password" class="form-control password-input" name="contrasena_nueva" id="contrasenaNueva" minlength="6">
                                    <button type="button" class="toggle-password" id="toggleContrasenaNueva">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Mínimo 6 caracteres</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirmar Nueva Contraseña</label>
                                <div class="password-container">
                                    <input type="password" class="form-control password-input" name="contrasena_nueva_confirmation" id="contrasenaConfirmar" minlength="6">
                                    <button type="button" class="toggle-password" id="toggleContrasenaConfirmar">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Guardar Cambios
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <a href="<?php echo e(route('usuario_con_cuenta.index')); ?>" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-2"></i>Volver al Inicio
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card shadow mt-4">
                    <div class="card-body">
                        <h5><i class="fas fa-info-circle me-2"></i>Información de la Cuenta</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <strong>Fecha de Registro:</strong> 
                                <?php echo e(\Carbon\Carbon::parse($usuario->fecha_registro)->format('d/m/Y')); ?>

                            </li>
                            <li class="mb-2">
                                <strong>Tipo de Usuario:</strong> 
                                <span class="badge bg-<?php echo e($tipoBadge); ?>"><?php echo e(ucfirst($usuario->tipo_usuario)); ?></span>
                            </li>
                            <li class="mb-2">
                                <strong>ID de Usuario:</strong> #<?php echo e($usuario->id_usuario); ?>

                            </li>
                            <?php if($usuario->imagen): ?>
                            <li class="mb-2">
                                <strong>Foto de perfil:</strong> Sí
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar ojitos para cada campo de contraseña
            setupPasswordToggle('toggleContrasenaActual', 'contrasenaActual');
            setupPasswordToggle('toggleContrasenaNueva', 'contrasenaNueva');
            setupPasswordToggle('toggleContrasenaConfirmar', 'contrasenaConfirmar');
            
            function setupPasswordToggle(toggleId, inputId) {
                const toggleButton = document.getElementById(toggleId);
                const passwordInput = document.getElementById(inputId);
                const eyeIcon = toggleButton.querySelector('i');
                
                // Evento cuando se presiona el botón (mouse down)
                toggleButton.addEventListener('mousedown', function() {
                    passwordInput.setAttribute('type', 'text');
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                });
                
                // Evento cuando se suelta el botón (mouse up)
                toggleButton.addEventListener('mouseup', function() {
                    passwordInput.setAttribute('type', 'password');
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                });
                
                // Evento cuando el mouse sale del botón
                toggleButton.addEventListener('mouseleave', function() {
                    passwordInput.setAttribute('type', 'password');
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                });
                
                // Para dispositivos táctiles
                toggleButton.addEventListener('touchstart', function(e) {
                    e.preventDefault();
                    passwordInput.setAttribute('type', 'text');
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                });
                
                toggleButton.addEventListener('touchend', function(e) {
                    e.preventDefault();
                    passwordInput.setAttribute('type', 'password');
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                });
            }
        });

        // Manejar la selección de imagen
        function handleImageSelection(input) {
            const file = input.files[0];
            const imageInfo = document.getElementById('imageInfo');
            const selectedImageName = document.getElementById('selectedImageName');
            const preview = document.getElementById('imagePreview');
            
            if (file) {
                // Mostrar información de la imagen seleccionada
                selectedImageName.textContent = `Imagen seleccionada: ${file.name}`;
                
                // Mostrar vista previa
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
                
                // Mostrar la sección de información
                imageInfo.style.display = 'block';
            } else {
                imageInfo.style.display = 'none';
            }
        }

        // Cancelar la selección de imagen
        function cancelImageSelection() {
            document.getElementById('imagen').value = '';
            document.getElementById('imageInfo').style.display = 'none';
        }

        // También permitir arrastrar y soltar imágenes
        document.addEventListener('DOMContentLoaded', function() {
            const profileContainer = document.querySelector('.profile-img-container');
            const fileInput = document.getElementById('imagen');

            // Prevenir el comportamiento por defecto para drag and drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                profileContainer.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Efectos visuales al arrastrar
            ['dragenter', 'dragover'].forEach(eventName => {
                profileContainer.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                profileContainer.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                profileContainer.style.transform = 'scale(1.1)';
                profileContainer.style.borderColor = '#667eea';
            }

            function unhighlight() {
                profileContainer.style.transform = 'scale(1)';
                profileContainer.style.borderColor = '#fff';
            }

            // Manejar la imagen soltada
            profileContainer.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length > 0) {
                    fileInput.files = files;
                    handleImageSelection(fileInput);
                }
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\sueñito\Dream\resources\views/ventana perfil/index.blade.php ENDPATH**/ ?>