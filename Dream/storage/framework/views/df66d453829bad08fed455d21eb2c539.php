<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Sonido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-custom {
            background-color: #667eea;
            color: white;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-custom:hover {
            background-color: #5a67d8;
            transform: translateY(-2px);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
        }

        .text-gradient {
            background: linear-gradient(45deg, #6b73ff, #000dff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .back-link {
            color: #fff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-light p-4">
                    <h2 class="text-center mb-4 text-gradient">
                        <i class="fas fa-plus-circle"></i> Agregar Nuevo Sonido
                    </h2>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('sonidos.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">
                                <i class="fas fa-music me-1"></i> Nombre del sonido
                            </label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ejemplo: Lluvia suave" required>
                        </div>

                        <div class="mb-3">
                            <label for="categoria" class="form-label">
                                <i class="fas fa-layer-group me-1"></i> Categoría
                            </label>
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option value="">-- Selecciona una categoría --</option>
                                <option value="naturaleza">🌿 Naturaleza</option>
                                <option value="meditacion">🧘‍♀️ Meditación</option>
                                <option value="urbano">🏙️ Urbano</option>
                                <option value="blanco">⚪ Ruido Blanco</option>
                                <option value="instrumental">🎻 Instrumental</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="archivo_audio" class="form-label">
                                <i class="fas fa-file-audio me-1"></i> Archivo de audio (mp3, wav, ogg)
                            </label>
                            <input type="file" name="archivo_audio" id="archivo_audio" class="form-control" accept=".mp3,.wav,.ogg" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('sonidos.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-custom">
                                <i class="fas fa-save"></i> Guardar Sonido
                            </button>
                        </div>
                    </form>
                </div>

                <div class="text-center mt-4">
                    <a href="<?php echo e(route('usuario_con_cuenta.index')); ?>" class="back-link">
                        <i class="fas fa-home"></i> Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\Dream\resources\views/ventana sonido/create.blade.php ENDPATH**/ ?>