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
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px 0 0 10px;
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
                            <div class="profile-img rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="font-size: 3rem;">
                                <i class="fas fa-user"></i>
                            </div>
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
                        
                        <form action="<?php echo e(route('perfil.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            
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
                                <input type="password" class="form-control" name="contrasena_actual">
                                <small class="text-muted">Dejar en blanco si no deseas cambiar la contraseña</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" name="contrasena_nueva" minlength="6">
                                <small class="text-muted">Mínimo 6 caracteres</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control" name="contrasena_nueva_confirmation" minlength="6">
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\Dream\resources\views/ventana perfil/index.blade.php ENDPATH**/ ?>