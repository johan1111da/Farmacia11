<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insumos y Profesores</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-custom {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 5px; /* 5px rounded corners */
        }
        
        .card-custom:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5 text-center">Seleccione una opción</h2>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Botón para Insumos de Helados -->
                                <a href="../Vista/heladosVista.php" class="btn btn-primary btn-block">Insumos Helados</a>
                            </div>
                            <div class="col-md-6">
                                <!-- Botón para Profesores -->
                                <a href="../Vista/profesoresVista.php" class="btn btn-secondary btn-block">Becas</a>
                            </div>
                            <div class="col-md-6">
                                <!-- Botón para Profesores -->
                                <a href="../Vista/laboratoriovista.php" class="btn btn-secondary btn-block">Laboratorios</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Incluir Bootstrap JS y jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
