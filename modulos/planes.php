<?php
// Incluir el archivo de conexión
include('../modelo/conexion.php');

// Verificar que la conexión se ha establecido
if (!$conexion) {
    die("Conexión no establecida.");
} else {
    echo "Conexión exitosa.";
}

// Consultar información del plan
$sql = "SELECT * FROM planes WHERE id = 1"; // Verifica que haya un plan con id = 1
$result = $conexion->query($sql);

// Verifica si se encontraron resultados
if ($result) {
    if ($result->num_rows > 0) {
        $plan = $result->fetch_assoc(); // Obtiene el primer resultado
    } else {
        $plan = null; // Si no hay resultados, asigna null a $plan
    }
} else {
    die("Error en la consulta: " . $conexion->error);
}

$conexion->close(); // Asegúrate de usar la misma variable
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plan Único - Life Gym</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
    body {
        background-color: #000000;
        font-family: 'Arial', sans-serif;
        color: #ffffff;
    }

    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #222222;
    }

    .card-title {
        color: #39FF14;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .card-text {
        font-size: 1rem;
        color: #A9A9A9;
        margin-bottom: 20px;
    }

    .image-container img {
        border-radius: 12px;
        max-width: 100%;
        height: auto;
    }

    .list-group-item {
        font-size: 1rem;
        color: #ffffff;
        background-color: #333333;
        border: 1px solid #444444;
    }

    .btn-primary {
        background-color: #39FF14;
        border-color: #39FF14;
        font-size: 1.1rem;
        padding: 10px 20px;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: rgb(34, 5, 199);
        border-color: rgb(5, 13, 134);
    }

    .form-label {
        font-weight: bold;
        color: #39FF14;
    }

    input[type="text"], select {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid rgb(196, 196, 196);
        font-size: 1rem;
        background-color: #222222;
        color: #fff;
    }

    .mb-3 {
        margin-bottom: 1.5rem;
    }

    .container {
        max-width: 1200px;
        padding: 20px;
    }

    @media (max-width: 768px) {
        .card {
            padding: 15px;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .list-group-item {
            font-size: 0.9rem;
        }
    }
    </style>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg rounded">
                    <div class="card-body">
                        <?php if ($plan): ?>
                            <h2 class="card-title text-center mb-4"><?= $plan['nombre'] ?></h2>
                            <p class="card-text text-center"><?= $plan['descripcion'] ?></p>

                            <div class="image-container text-center my-3">
                                <img src="888.png" alt="Imagen de Membresía" class="img-fluid rounded">
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Horario:</strong> Lunes a viernes de 5:00 AM a 10:00 PM</li>
                                <li class="list-group-item"><strong>Sábados:</strong> 7:00 AM a 5:00 PM</li>
                                <li class="list-group-item"><strong>Acceso:</strong> A todos los servicios y áreas del gimnasio</li>
                                <li class="list-group-item"><strong>Asesoramiento:</strong> Con instructores profesionales</li>
                                <li class="list-group-item"><strong>Duración:</strong> <?= $plan['duracion'] ?> días</li>
                                <li class="list-group-item"><strong>Precio:</strong> $<?= number_format($plan['precio'], 2, ',', '.') ?> COP</li>
                            </ul>

                            <form action="procesar_pago.php" method="post" class="mt-4">
                                <input type="hidden" name="plan_id" value="<?= $plan['id'] ?>">

                                <div class="mb-3">
                                    <label for="metodo" class="form-label">Método de pago</label>
                                    <select name="metodo" id="metodo" class="form-select" required aria-label="Método de pago">
                                        <option value="">Selecciona uno</option>
                                        <option value="nequi">Nequi</option>
                                        <option value="bancolombia">Bancolombia</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="numero" class="form-label">Número de contacto</label>
                                    <input type="text" name="numero" id="numero" class="form-control" placeholder="Ej: 3001234567" required aria-label="Número de contacto">
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Simular Pago</button>
                            </form>
                        <?php else: ?>
                            <p class="alert alert-danger text-center">No se encontró el plan solicitado.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
