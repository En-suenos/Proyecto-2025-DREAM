<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Mi Perfil</h2>
                        
                        <div class="text-center mb-4">
                            <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="Foto de perfil">
                            <h4>Usuario Ejemplo</h4>
                            <p class="text-muted">usuario@ejemplo.com</p>
                        </div>

                        <form>
                            @foreach($usuarios as $usuario)
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" value="{{$usuario->nombre}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{$usuario->correo}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" value="+1234567890">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                            @endforeach
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('usuarios.index') }}" class="text-decoration-none">
                                ← Volver al inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>