<?php
// Incluir la conexión a la base de datos
include '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta

// Verificar si la conexión está establecida correctamente
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $identificacion = $_POST['identificacion'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar contraseña
    $rol_id = $_POST['rol_id']; // El rol elegido por el usuario

    // Validar que el rol esté seleccionado
    if (empty($rol_id)) {
        echo "❌ Debes seleccionar un rol.";
        exit();
    }

    // Crear la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido, telefono, fechaNacimiento, identificacion, email, password, rol_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta usando la variable de conexión correcta ($conexion)
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros de la consulta con las variables del formulario
        $stmt->bind_param("sssssssi", $nombre, $apellido, $telefono, $fechaNacimiento, $identificacion, $email, $password, $rol_id);

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            // Si el registro es exitoso, redirigir al login
            header("Location: login.php"); // Asegúrate de que la ruta sea correcta
            exit(); // Asegurarse de que no se ejecute más código
        } else {
            echo "❌ Error al registrar: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "❌ Error al preparar la consulta: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Life Gym</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #000;
            color: #fff;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        .btn-submit {
            background-color: #17dd1e;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1.2em;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #12cf1c;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            background-color: #2c2f3d;
            border: 1px solid #444;
            color: #fff;
        }
        .form-control:focus {
            background-color: #1a1e28;
            border-color: #17dd1e;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center my-4">Registro en Life Gym</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha de nacimiento:</label>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="identificacion" class="form-label">Identificación N°:</label>
                <input type="number" id="identificacion" name="identificacion" class="form-control" placeholder="Ej: 1234567890" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="rol_id" class="form-label">Rol</label>
                <select class="form-control" id="rol_id" name="rol_id" required>
                    <option value="">Seleccione un rol</option>
                    <option value="1">Usuario</option>
                    <option value="2">Instructor</option>
                    <option value="3">Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">Registrarse</button>
        </form>
        <div class="mt-3 text-center">
            <a href="login.php" class="text-white">¿Ya tienes cuenta? Inicia sesión aquí</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
