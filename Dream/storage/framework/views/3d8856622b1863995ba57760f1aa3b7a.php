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
    </style>
</head>
<body>

    <main class="container main-content">
       
        <div id="misDatos" class="hidden">
            <h2>Ingrese sus datos</h2>
            <form action="<?php echo e(route('usuarios.store')); ?>" method="POST" id="formDatos">
                <?php echo csrf_field(); ?>
                <!--Para registro de datos de usuario-->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" name="contraseña" placeholder="Contraseña" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_registro" class="form-label">Fecha registro</label>
                    <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" placeholder="fecha_registro" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                    
                </button>
                <a href="<?php echo e(route('inicio_sesion.index')); ?>" class="btn btn-primary">Regresa al perfil</a>
            </form>

        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
                    window.location.href = '<?php echo e(route('ventana principal.index')); ?>'; // Redirigir a la app principal 
                }, 2000);
            } else {
                mensaje.className = 'alert alert-danger alert-custom';
                mensaje.innerHTML = 'Por favor, completa todos los campos.';
                mensaje.style.display = 'block';
            }
        }

        function mostrarRegistro() {
            alert('Funcionalidad de registro no implementada aún.'); // Placeholder
        }

        function volverApp() {
            window.location.href ="<?php echo e(route('ventana principal.index')); ?>"; // Redirigir a la app principal (ajusta la ruta)
        }

        document.getElementById('formLogin').addEventListener('submit', function(e) {
            e.preventDefault();
            validarLogin();
        });
    </script>

</body>
</html>
<?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\resources\views/ventana de datos/index.blade.php ENDPATH**/ ?>