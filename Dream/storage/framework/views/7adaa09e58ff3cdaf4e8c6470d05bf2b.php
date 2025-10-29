<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Playlists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a2a6c, #2c3e50);
            min-height: 100vh;
            color: white;
            padding-top: 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            height: 100%;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        .create-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .create-card:hover {
            background: rgba(255, 255, 255, 0.15);
        }
        .playlist-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .btn-outline-light:hover {
            background-color: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center"><i class="fas fa-music me-2"></i>Mis Playlists</h1>
                <p class="text-center text-muted">Gestiona tus listas de reproducción</p>
            </div>
        </div>
        
        <!-- Mensajes de éxito/error -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Modal para crear nueva playlist -->
        <div class="modal fade" id="createPlaylistModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Crear Nueva Playlist</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?php echo e(route('playlists.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre de la playlist</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required 
                                       placeholder="Ej: Relajación nocturna">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción (opcional)</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" 
                                          placeholder="Describe tu playlist..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Crear Playlist
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Tarjeta para crear nueva playlist -->
            <div class="col-md-4 mb-4">
                <div class="card create-card text-white" data-bs-toggle="modal" data-bs-target="#createPlaylistModal">
                    <div class="card-body text-center d-flex flex-column justify-content-center py-5">
                        <i class="fas fa-plus fa-3x mb-3 text-primary"></i>
                        <h5>Crear Nueva Playlist</h5>
                        <p class="text-muted mb-0">Haz clic para crear una nueva playlist</p>
                    </div>
                </div>
            </div>
            
            <!-- Playlists existentes -->
            <?php $__empty_1 = true; $__currentLoopData = $playlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4 mb-4">
                    <div class="card playlist-card text-white" onclick="window.location.href='<?php echo e(route('playlists.reproducir', $playlist)); ?>'">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title"><?php echo e($playlist->nombre); ?></h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" 
                                            data-bs-toggle="dropdown" onclick="event.stopPropagation()">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li>
                                            <a class="dropdown-item" href="<?php echo e(route('playlists.show', $playlist)); ?>">
                                                <i class="fas fa-eye me-2"></i>Gestionar
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo e(route('playlists.reproducir', $playlist)); ?>">
                                                <i class="fas fa-play me-2"></i>Reproducir
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo e(route('playlists.edit', $playlist)); ?>">
                                                <i class="fas fa-edit me-2"></i>Editar
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="<?php echo e(route('playlists.destroy', $playlist)); ?>" 
                                                  method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="event.stopPropagation(); return confirm('¿Estás seguro de eliminar esta playlist?')">
                                                    <i class="fas fa-trash me-2"></i>Eliminar
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <?php if($playlist->descripcion): ?>
                                <p class="card-text"><?php echo e(Str::limit($playlist->descripcion, 100)); ?></p>
                            <?php endif; ?>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-music me-1"></i>
                                    <?php echo e($playlist->cantidad_sonidos); ?> sonidos
                                </span>
                                <small class="text-light">
                                    <i class="fas fa-clock me-1"></i>
                                    <?php echo e($playlist->updated_at->diffForHumans()); ?>

                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        No tienes playlists creadas. ¡Crea tu primera playlist!
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Botón volver -->
        <div class="text-center mt-4">
            <a href="<?php echo e(route('usuario_con_cuenta.index')); ?>" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i>Volver al inicio
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Dream\Dream\resources\views/ventana playlista/index.blade.php ENDPATH**/ ?>