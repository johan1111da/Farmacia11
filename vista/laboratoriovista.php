<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Laboratorios</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            background-color: #f4f4f9;
        }
        h1, h2 {
            color: #333;
            margin: 20px;
        }
        table, form {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        input, button {
            padding: 10px;
            margin: 5px;
            width: 95%;
        }
        button {
            cursor: pointer;
            color: white;
            background-color: #007BFF;
            border: none;
            display: block;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Agregar Nuevo Laboratorio</h1>
    <form action="" method="POST">
        <input type="text" name="laboratorio" placeholder="Nombre del Laboratorio" required>
        <input type="text" name="direccion" placeholder="Dirección del Laboratorio" required>
        <button type="submit" name="submit">Agregar Laboratorio</button>
    </form>

    <?php
    $url = "https://facundo08-api-botica.hf.space/laboratorios/";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $postData = [
            'laboratorio' => $_POST['laboratorio'],
            'direccion' => $_POST['direccion']
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpcode == 201) {
            echo "<div style='color: green;'>Laboratorio agregado correctamente.</div>";
        } else {
            echo "<div style='color: red;'>Error al agregar laboratorio. Código de estado HTTP: $httpcode</div>";
        }
        curl_close($ch);
    }

    // Fetch and display existing laboratories
    $ch = curl_init($url . "?skip=0&limit=100");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if ($response) {
        $laboratorios = json_decode($response, true);
        echo "<h2>Listado de Laboratorios</h2>";
        echo "<table><thead><tr><th>ID</th><th>Laboratorio</th><th>Dirección</th></tr></thead><tbody>";
        foreach ($laboratorios as $lab) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($lab['id']) . "</td>";
            echo "<td>" . htmlspecialchars($lab['laboratorio']) . "</td>";
            echo "<td>" . htmlspecialchars($lab['direccion']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<div>Error al cargar los laboratorios: " . curl_error($ch) . "</div>";
    }
    curl_close($ch);
    ?>
</body>
</html>
