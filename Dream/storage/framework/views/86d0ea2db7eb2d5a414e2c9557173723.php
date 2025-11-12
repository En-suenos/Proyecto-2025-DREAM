<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
            padding: 20px;
        }
        
        .report-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }
        
        .report-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .report-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .report-subtitle {
            font-size: 16px;
            font-weight: 400;
            opacity: 0.9;
        }
        
        .report-meta {
            display: flex;
            justify-content: space-between;
            background-color: #f1f5f9;
            padding: 15px 30px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }
        
        .report-date {
            font-weight: 500;
        }
        
        .report-summary {
            display: flex;
            justify-content: space-between;
            padding: 20px 30px;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .summary-item {
            text-align: center;
            flex: 1;
        }
        
        .summary-value {
            font-size: 24px;
            font-weight: 700;
            color: #4f46e5;
        }
        
        .summary-label {
            font-size: 14px;
            color: #64748b;
            margin-top: 5px;
        }
        
        .table-container {
            padding: 30px;
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        thead {
            background-color: #4f46e5;
            color: white;
        }
        
        th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }
        
        tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: background-color 0.2s;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        tbody tr:hover {
            background-color: #f1f5f9;
        }
        
        td {
            padding: 14px 16px;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #4f46e5;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-name {
            font-weight: 500;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .report-footer {
            padding: 20px 30px;
            background-color: #f1f5f9;
            text-align: center;
            font-size: 14px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            
            .report-container {
                box-shadow: none;
                border-radius: 0;
            }
            
            .report-header {
                background: #4f46e5 !important;
                -webkit-print-color-adjust: exact;
            }
            
            thead {
                background: #4f46e5 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <!-- Encabezado del reporte -->
        <div class="report-header">
            <h1 class="report-title">Reporte de Usuarios</h1>
            <p class="report-subtitle">Lista completa de usuarios registrados en el sistema</p>
        </div>
        
        <!-- Metadatos del reporte -->
        <div class="report-meta">
            <div class="report-date">Generado el: <?php echo e(date('d/m/Y H:i')); ?></div>
            <div class="report-id">ID Reporte: USR-<?php echo e(date('Ymd-His')); ?></div>
        </div>
        
        <!-- Resumen del reporte -->
        <!-- <div class="report-summary">
            <div class="summary-item">
                <div class="summary-value"><?php echo e(count($usuarios)); ?></div>
                <div class="summary-label">Total de Usuarios</div>
            </div>
            <div class="summary-item">
                <div class="summary-value"><?php echo e($usuariosActivos ?? count($usuarios)); ?></div>
                <div class="summary-label">Usuarios Activos</div>
            </div>
            <div class="summary-item">
                <div class="summary-value"><?php echo e($usuariosRecientes ?? 0); ?></div>
                <div class="summary-label">Nuevos (últimos 30 días)</div>
            </div>
        </div> -->
        
        <!-- Tabla de usuarios -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 25%;">Usuario</th>
                        <th style="width: 25%;">Email</th>
                        <th style="width: 20%;">Fecha Registro</th>
                        <th style="width: 15%;">Estado</th>
                        <th style="width: 10%;">ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <?php echo e(strtoupper(substr($usuario->name, 0, 1))); ?>

                                </div>
                                <div class="user-name"><?php echo e($usuario->name); ?></div>
                            </div>
                        </td>
                        <td><?php echo e($usuario->email); ?></td>
                        <td><?php echo e($usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'N/A'); ?></td>
                        <td>
                            <span class="status-badge status-active">Activo</span>
                        </td>
                        <td>#<?php echo e($usuario->id); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pie de página del reporte -->
        <div class="report-footer">
            <p>Reporte generado automáticamente por el Sistema de Gestión de Usuarios</p>
            <p>Página 1 de 1</p>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\Proyecto-carpeta_principal\Proyecto-2025-DREAM\Dream\resources\views/usuario/pdf/index.blade.php ENDPATH**/ ?>