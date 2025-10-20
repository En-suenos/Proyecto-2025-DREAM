<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación PlayList con múltiples vistas y autenticación.">
    <title>Aplicación PlayList</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #f8f9fa;
            cursor: pointer;
        }
        .table-container {
            overflow-x: auto;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

    <main class="container main-content">
       
        <div id="misDatos">
            <h2>Ingrese sus datos</h2>

            
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('usuario.store')); ?>" method="POST" id="formDatos">
                <?php echo csrf_field(); ?>
                <!--Para registro de datos de usuario-->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                           value="<?php echo e(old('nombre')); ?>" placeholder="Nombre" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" 
                           value="<?php echo e(old('correo')); ?>" placeholder="Correo" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" name="contraseña" 
                           placeholder="Contraseña" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_registro" class="form-label">Fecha registro</label>
                    <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" 
                           value="<?php echo e(old('fecha_registro')); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('inicio_sesion.index')); ?>" class="btn btn-secondary">Regresa al perfil</a>
            </form>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Asegurar que el formulario se muestre
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('misDatos').style.display = 'block';
        });

        function validarLogin() {
            const correo = document.getElementById('correoLogin').value;
            const contrasena = document.getElementById('contrasenaLogin').value;
            const mensaje = document.getElementById('mensajeLogin');
            
            if (correo && contrasena) {
                localStorage.setItem('usuario', correo);
                mensaje.className = 'alert alert-success alert-custom';
                mensaje.innerHTML = '¡Inicio de sesión exitoso! Redirigiendo...';
                mensaje.style.display = 'block';
                setTimeout(() => {
                    window.location.href = '<?php echo e(route("ventana principal.index")); ?>';
                }, 2000);
            } else {
                mensaje.className = 'alert alert-danger alert-custom';
                mensaje.innerHTML = 'Por favor, completa todos los campos.';
                mensaje.style.display = 'block';
            }
        }

        function volverApp() {
            window.location.href = "<?php echo e(route('ventana principal.index')); ?>";
        }
    </script>

</body>
</html><?php /**PATH C:\laragon\www\sueñito\Dream\resources\views/ventana de datos/index.blade.php ENDPATH**/ ?>