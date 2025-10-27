<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de Inicio de Sesión para la Aplicación Reproductor de Música.">
    <title>Inicio de Sesión</title>

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

        .login-container {
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

        .login-container h2 {
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
            margin-bottom: 15px;
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
            padding: 15px;
            font-weight: 600;
            color: #ffffff;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(79, 195, 247, 0.3);
            font-size: 1.2rem;
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(79, 195, 247, 0.4);
        }

        .alert-custom {
            margin-top: 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 15px;
        }

        .text-center a {
            color: #4fc3f7;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .main-content {
                max-width: 100%;
                padding: 0 20px;
            }
            
            .login-container {
                padding: 30px;
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
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <form action="<?php echo e(route('inicio_sesion.login')); ?>" method="POST" id="formLogin">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="correoLogin" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correoLogin" name="correoLogin" placeholder="Correo" required>
                </div>
                <div class="mb-3">
                    <label for="contrasenaLogin" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasenaLogin" name="contrasenaLogin" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
            
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-custom">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-custom">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <p class="text-center mt-3">
                ¿No tienes cuenta? <a href="<?php echo e(route('ventana datos.index')); ?>">Regístrate aquí</a>
            </p>
            <p class="text-center">
                <a href="<?php echo e(route('ventana-principal.index')); ?>">Volver a la aplicación</a>
            </p>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\Dream\resources\views/inicio sesion/index.blade.php ENDPATH**/ ?>