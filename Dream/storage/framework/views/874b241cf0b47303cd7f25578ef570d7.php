<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplicación PlayList con múltiples vistas y autenticación.">
    <title>Aplicación PlayList</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a2a6c, #2c3e50);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
            padding-top: 90px; /* Ajuste para navbar */
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(26, 42, 108, 0.9);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #4fc3f7;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .navbar-nav {
            display: flex;
            gap: 20px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #4fc3f7;
        }

        .main-content {
            max-width: 600px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #misDatos {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            animation: gentleFloat 8s ease-in-out infinite;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        h2 {
            color: #4fc3f7;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 2.5rem;
            text-shadow: 0 0 20px rgba(79, 195, 247, 0.7);
        }

        .form-label {
            color: #fff;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            color: #fff;
            padding: 15px;
            transition: all 0.4s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: #4fc3f7;
            box-shadow: 0 0 0 0.3rem rgba(79, 195, 247, 0.25), inset 0 2px 4px rgba(0, 0, 0, 0.05);
            transform: scale(1.02);
        }

        .form-control::placeholder {
            color: #ccc;
            font-style: italic;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            border: none;
            border-radius: 25px;
            padding: 15px 50px;
            font-weight: 600;
            color: #ffffff;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(79, 195, 247, 0.3);
            font-size: 1.2rem;
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(79, 195, 247, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 15px 50px;
            font-weight: 600;
            color: #fff;
            transition: all 0.4s ease;
            font-size: 1.2rem;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px) scale(1.05);
            border-color: #4fc3f7;
        }

        .d-flex {
            justify-content: space-around;
            margin-top: 20px;
        }

        .mb-3 {
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            color: #2c3e50;
        }

        .table-container {
            overflow-x: auto;
        }

        .hidden {
            display: block !important;
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
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s ease;
            z-index: 10;
            padding: 5px;
        }

        .toggle-password:hover {
            color: #4fc3f7;
        }

        .form-control.password-input {
            padding-right: 50px;
        }

        @media (max-width: 768px) {
            .main-content {
                max-width: 100%;
                padding: 0 20px;
            }
            
            .btn {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a class="navbar-brand" href="#">SleepWell</a>
        <div class="navbar-nav">
            <a class="nav-link" href="#"><i class="fas fa-globe me-1"></i>Idioma</a>
            <a class="nav-link" href="#"><i class="fas fa-cog me-1"></i>Configuración</a>
        </div>
    </nav>

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
                    <div class="password-container">
                        <input type="password" class="form-control password-input" id="contrasena" name="contraseña" placeholder="Contraseña" required>
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="fecha_registro" class="form-label">Fecha registro</label>
                    <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" placeholder="fecha_registro" required>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                    <a href="<?php echo e(route('inicio_sesion.index')); ?>" class="btn btn-secondary">Regresa</a>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para el ojito de mostrar/ocultar contraseña
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('contrasena');
            const eyeIcon = togglePassword.querySelector('i');
            
            // Evento cuando se presiona el botón (mouse down)
            togglePassword.addEventListener('mousedown', function() {
                passwordInput.setAttribute('type', 'text');
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            });
            
            // Evento cuando se suelta el botón (mouse up)
            togglePassword.addEventListener('mouseup', function() {
                passwordInput.setAttribute('type', 'password');
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            });
            
            // Evento cuando el mouse sale del botón (para casos donde se suelta fuera)
            togglePassword.addEventListener('mouseleave', function() {
                passwordInput.setAttribute('type', 'password');
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            });
            
            // Para dispositivos táctiles
            togglePassword.addEventListener('touchstart', function(e) {
                e.preventDefault(); // Prevenir comportamiento por defecto
                passwordInput.setAttribute('type', 'text');
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            });
            
            togglePassword.addEventListener('touchend', function(e) {
                e.preventDefault(); // Prevenir comportamiento por defecto
                passwordInput.setAttribute('type', 'password');
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            });

            // Establecer fecha actual por defecto
            const fechaInput = document.getElementById('fecha_registro');
            const today = new Date().toISOString().split('T')[0];
            fechaInput.value = today;
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
                    window.location.href = '<?php echo e(route('ventana-principal.index')); ?>'; // Redirigir a la app principal 
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
            window.location.href ="<?php echo e(route('ventana-principal.index')); ?>"; // Redirigir a la app principal (ajusta la ruta)
        }

        document.getElementById('formLogin').addEventListener('submit', function(e) {
            e.preventDefault();
            validarLogin();
        });
    </script>

</body>
</html><?php /**PATH C:\laragon\www\sueñito\Dream\resources\views/ventana de datos/index.blade.php ENDPATH**/ ?>