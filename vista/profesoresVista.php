<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Becas</title>
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
    <h1>Agregar Nueva Beca</h1>
    <form action="" method="POST">
        <input type="text" name="Nombre_Beca" placeholder="Nombre de la Beca" required>
        <input type="text" name="Descripcion" placeholder="Descripción" required>
        <input type="number" name="Monto" placeholder="Monto" required>
        <button type="submit" name="submit">Agregar Beca</button>
    </form>

    <?php
    $url = "https://innovpythia-acadsh-api.hf.space/api/becas/";
    $postData = [];  // Initialize postData to avoid undefined variable warnings

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $postData = [
            'Nombre_Beca' => $_POST['Nombre_Beca'],
            'Descripcion' => $_POST['Descripcion'],
            'Monto' => $_POST['Monto']
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpcode == 201) {
            echo "<div style='color: green;'>Beca agregada correctamente.</div>";
        } else {
            echo "<div style='color: red;'>Error al agregar beca. Código de estado HTTP: $httpcode</div>";
        }
        curl_close($ch);
    }

    // Fetch and display existing becas
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if ($response) {
        $becas = json_decode($response, true);
        echo "<h2>Listado de Becas</h2>";
        echo "<table><thead><tr><th>Nombre Beca</th><th>Descripción</th><th>Monto</th></tr></thead><tbody>";
        foreach ($becas as $beca) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($beca['Nombre_Beca']) . "</td>";
            echo "<td>" . htmlspecialchars($beca['Descripcion']) . "</td>";
            echo "<td>" . htmlspecialchars($beca['Monto']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<div>Error al cargar las becas: " . curl_error($ch) . "</div>";
    }
    curl_close($ch);
    ?>
</body>
</html>
