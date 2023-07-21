<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Reporte de Sensores - Synho SAC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 16px;
            margin-bottom: 0;
        }

        .table-container {
            margin-top: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .table-container th {
            background-color: #f2f2f2;
        }

        .table-container tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Reporte de Tanque de Agua</h1>
            <p>Reporte de la fecha: <strong>{{ $data['begin'] }} hasta {{ $data['finish'] }}</strong></p>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>FECHA</th>
                        <th>SENSOR 1</th>
                        <th>SENSOR 2</th>
                        <th>SENSOR 3</th>
                        <th>SENSOR 4</th>
                        <th>SENSOR 5</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($data['data'] as $item)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->sensory1 }}</td>
                            <td>{{ $item->sensory2 }}</td>
                            <td>{{ $item->sensory3 }}</td>
                            <td>{{ $item->sensory4 }}</td>
                            <td>{{ $item->sensory5 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
