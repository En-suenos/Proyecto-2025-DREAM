<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Usuarios</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo Usuario</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($usuario->id_usuario); ?></td>
                    <td><?php echo e($usuario->nombre); ?></td>
                    <td><?php echo e($usuario->correo); ?></td>
                    <td><?php echo e($usuario->tipo_usuario); ?></td>
                    <td><?php echo e($usuario->fecha_registro); ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <a href="<?php echo e(route('usuario.create')); ?>" class="btn btn-primary">Crear Nuevo Usuario</a>
        <a href="<?php echo e(route('ventana.principal.index')); ?>" class="btn btn-secondary">Volver al Inicio</a>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\sueñito\Dream\resources\views/usuario/index.blade.php ENDPATH**/ ?>