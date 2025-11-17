<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios - Dream App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            background-color: #ffffff;
            color: #1a1a1a;
            padding: 40px 20px;
        }
        
        .report-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
        }
        
        /* Encabezado */
        .report-header {
            text-align: center;
            border-bottom: 3px solid #1a1a1a;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-name {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .report-title {
            font-size: 26px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        
        .report-date {
            font-size: 12px;
            color: #666;
            margin-top: 10px;
        }
        
        /* Tabla */
        .table-container {
            margin: 30px 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        thead {
            background-color: #1a1a1a;
            color: white;
        }
        
        th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        tbody tr {
            border-bottom: 1px solid #e0e0e0;
        }
        
        td {
            padding: 12px 10px;
            color: #333;
        }
        
        tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        /* Pie de página */
        .report-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #1a1a1a;
            font-size: 11px;
            color: #666;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer-left {
            text-align: left;
        }
        
        .footer-right {
            text-align: right;
        }
        
        .footer-company {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        @media print {
            body {
                padding: 0;
            }
            
            .report-container {
                max-width: 100%;
            }
            
            thead {
                background-color: #1a1a1a !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <!-- Encabezado -->
        <div class="report-header">
            <div class="company-name">Dream App</div>
            <h1 class="report-title">Informe de Usuarios Registrados</h1>
            <div class="report-date">
                Fecha de Generación: {{ date('d/m/Y') }} | Hora: {{ date('H:i') }}
            </div>
        </div>
        
        <!-- Tabla de usuarios -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 8%;">N°</th>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 30%;">Nombre</th>
                        <th style="width: 35%;">Correo Electrónico</th>
                        <th style="width: 17%;">Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $index => $usuario)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pie de página -->
        <div class="report-footer">
            <div class="footer-content">
                <div class="footer-left">
                    <div class="footer-company">Dream App - Sistema de Gestión</div>
                    <div>Total de usuarios: {{ count($usuarios) }}</div>
                </div>
                <div class="footer-right">
                    <div>Documento generado automáticamente</div>
                    <div>Página 1 de 1</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>