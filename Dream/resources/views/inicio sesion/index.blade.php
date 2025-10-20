<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de Inicio de Sesión para la Aplicación Reproductor de Música.">
    <title>Inicio de Sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
        }
        .alert-custom {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <!-- MOSTRAR MENSAJES PRIMERO -->
        @if (session('success'))
            <div class="alert alert-success alert-custom">
                {{ session('success') }} <!-- CORREGIDO: session() no sesion() -->
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-custom">
                {{ session('error') }} <!-- CORREGIDO: session() no sesion() -->
            </div>
        @endif

        <form action="{{ route('inicio_sesion.login') }}" method="POST" id="formLogin">
            @csrf
            <div class="mb-3">
                <label for="correoLogin" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correoLogin" name="correo" placeholder="Correo" required> <!-- AGREGADO: name="correo" -->
            </div>
            <div class="mb-3">
                <label for="contrasenaLogin" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasenaLogin" name="contraseña" placeholder="Contraseña" required> <!-- AGREGADO: name="contraseña" -->
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>

        <div id="mensajeLogin" class="alert alert-info alert-custom" style="display: none;"></div>
        
        <p class="text-center mt-3">
            ¿No tienes cuenta? <a href="{{ route('ventana datos.index') }}">Regístrate aquí</a>
        </p>
        <p class="text-center">
            <a href="{{ route('ventana principal.index') }}">Volver a la aplicación</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('formLogin').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const correo = document.getElementById('correoLogin').value;
            const contrasena = document.getElementById('contrasenaLogin').value;
            const mensaje = document.getElementById('mensajeLogin');
            
            if (correo && contrasena) {
                // Enviar el formulario normalmente
                this.submit();
            } else {
                mensaje.className = 'alert alert-danger alert-custom';
                mensaje.innerHTML = 'Por favor, completa todos los campos.';
                mensaje.style.display = 'block';
            }
        });
    </script>
</body>
</html>