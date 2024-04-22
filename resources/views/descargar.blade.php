<!DOCTYPE html>

<html>

<head>
    <title>Lista de Participantes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Participantes Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha de Registro</th>
                <th>firma</th>

            </tr>
        </thead>
        <tbody>
            @foreach($datos as $participante)
                <tr>
                    <td>{{ $participante->id }}</td>
                    <td>{{ $participante->name_and_last_name }}</td> 
                    <td>{{ $participante->email }}</td>
                    <td>{{ $participante->created_at->toDateString() }}</td>
                    <td><img src="{{$participante->signatureBase64}}" alt="Firma" style="height: 100px;"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>