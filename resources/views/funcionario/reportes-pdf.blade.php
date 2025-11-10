<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Accesos</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Reporte de Accesos</h2>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Documento</th>
                <th>Hora Entrada</th>
                <th>Hora Salida</th>
                <th>Registrado por</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accesos as $acceso)
            <tr>
                <td>{{ $acceso->user->name }}</td>
                <td>{{ $acceso->user->documento }}</td>
                <td>{{ $acceso->hora_entrada }}</td>
                <td>{{ $acceso->hora_salida ?? '---' }}</td>
                <td>{{ $acceso->vigilante->name ?? '---' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
