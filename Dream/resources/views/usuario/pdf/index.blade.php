<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios - Dream App</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 40px;
            color: #222;
        }

        h1 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }

        .subtitle {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-bottom: 30px;
        }

        .meta {
            font-size: 14px;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        th {
            background-color: #f1f1f1;
            font-weight: bold;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .avatar {
            font-weight: bold;
            background: #ddd;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 8px;
        }

        .user-cell {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>

    <h1>Reporte de Usuarios de la Aplicación Dream</h1>
    <p class="subtitle">Listado general de usuarios registrados en el sistema</p>

    <!-- Datos del reporte -->
    <div class="meta">
        <b>Generado el:</b> {{ date('d/m/Y H:i') }} <br>
        <b>ID de Reporte:</b> USR-{{ date('Ymd-His') }}
    </div>

    <!-- Tabla de usuarios -->
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 25%;">Usuario</th>
                <th style="width: 25%;">Email</th>
                <th style="width: 20%;">Fecha de Registro</th>
                <th style="width: 15%;">Estado</th>
                <th style="width: 10%;">ID</th>
            </tr>
        </thead>

        <tbody>
            @foreach($usuarios as $index => $usuario)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td>
                    <div class="user-cell">
                        <div class="avatar">
                            {{ strtoupper(substr($usuario->name, 0, 1)) }}
                        </div>
                        {{ $usuario->name }}
                    </div>
                </td>

                <td>{{ $usuario->email }}</td>

                <td>
                    {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'N/A' }}
                </td>

                <td>Activo</td>

                <td>#{{ $usuario->id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pie de página -->
    <div class="footer">
        Reporte generado automáticamente por DreamApp — Sistema Administrativo<br>
        Página 1 de 1
    </div>

</body>
</html>
