<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar y Listar Insumos</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            margin: 40px; 
            background-color: #f4f4f9;
            color: #333;
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
            font-weight: normal;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        form {
            width: 80%;
            margin: 20px auto;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        input[type="text"], input[type="number"] {
            width: calc(50% - 12px);
            padding: 10px;
            margin: 8px 0;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a.button {
            text-align: center;
            line-height: 20px; /* Ajusta la línea para centrar verticalmente el texto */
            font-weight: bold; /* Texto en negrita para mayor énfasis */
            background-color: #4CAF50; /* Un color verde para diferenciar del botón de enviar */
        }
        
    </style>
</head>
<body>
    <h1>Agregar Insumo</h1>
    <form method="POST">
        <input type="number" name="ID_Insumo" placeholder="ID Insumo" required>
        <input type="text" name="Descripcion" placeholder="Descripción" required>
        <input type="text" name="Tipo" placeholder="Tipo" required>
        <input type="number" name="Costo" placeholder="Costo" step="0.01" required>
        <input type="number" name="Cantidad" placeholder="Cantidad" required>
        <input type="submit" name="submit" value="Agregar Insumo">
        <a href="../Vista/AdministracionAdmin.php" class="button">Regresar a la Página Principal</a>
    </form>

    <h2>Listado de Insumos</h2>
    <table>
        <thead>
            <tr>
                <th>ID_Insumo</th>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Costo</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $url = "https://jairodanielmt-anhelados.hf.space/insumos/";

            // Manejar el POST
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                $data = [
                    'ID_Insumo'   => $_POST['ID_Insumo'],
                    'Descripcion' => $_POST['Descripcion'],
                    'Tipo'        => $_POST['Tipo'],
                    'Costo'       => $_POST['Costo'],
                    'Cantidad'    => $_POST['Cantidad']
                ];

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json'
                ]);

                $response = curl_exec($ch);
                if ($response === false) {
                    $error = curl_error($ch);
                    echo "<p>Error en la solicitud: $error</p>";
                } else {
                    $result = json_decode($response, true);
                    if (isset($result['success']) && $result['success']) {
                        echo "<p>Insumo agregado correctamente.</p>";
                    } 
                }
                curl_close($ch);
            }

            // Obtener y mostrar los insumos
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            
            $response = curl_exec($ch);
            curl_close($ch);
            $insumos = json_decode($response, true);

            if (!empty($insumos)) {
                foreach ($insumos as $insumo) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($insumo['ID_Insumo']) . "</td>";
                    echo "<td>" . htmlspecialchars($insumo['Descripcion']) . "</td>";
                    echo "<td>" . htmlspecialchars($insumo['Tipo']) . "</td>";
                    echo "<td>" . htmlspecialchars($insumo['Costo']) . "</td>";
                    echo "<td>" . htmlspecialchars($insumo['Cantidad']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron datos.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
