<table>
    <thead>
        <tr>
            <th>Nombre</th>
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
