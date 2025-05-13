<?php
// Habilitar los errores para la depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de la base de datos
$host = 'localhost'; // Dirección del servidor de la base de datos
$db = 'Life_Gym'; // Nombre de la base de datos
$user = 'root'; // Usuario de la base de datos
$pass = '903135Nicolas'; // Contraseña del usuario

// Intentar crear la conexión
$conexion = new mysqli($host, $user, $pass, $db);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die('Error en la conexión a la base de datos: ' . $conexion->connect_error);
}

// Variable para manejar los mensajes de error
$error_message = "";

// Comprobamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Consulta para verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $conexion->error);
    }

    // Vincular el parámetro de tipo string (s)
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el correo existe
    if ($result->num_rows > 0) {
        // Obtener los datos del usuario
        $usuario = $result->fetch_assoc();

        // Verificar si la contraseña es correcta
        if (password_verify($password, $usuario['password'])) {
            // Si la contraseña es correcta, iniciar sesión
            session_start(); // Iniciar una sesión
            $_SESSION['usuario_id'] = $usuario['id']; // Guardar el ID del usuario en la sesión
            $_SESSION['usuario_email'] = $usuario['email']; // Guardar el correo en la sesión

            // Redirigir al index.html
            header("Location: index.html"); // Ajusta la ruta según tu estructura de archivos

            exit(); // Asegúrate de que no se ejecute más código
        } else {
            // Si la contraseña no es correcta
            $error_message = "❌ Contraseña incorrecta para el correo: " . htmlspecialchars($email);
        }
    } else {
        // Si el correo no está registrado
        $error_message = "❌ El correo no está registrado: " . htmlspecialchars($email);
    }

    // Cerrar la conexión y la sentencia
    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Life Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
    body {
        background-color: #000;
        font-family: 'Roboto', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    .login-container {
        max-width: 600px; /* Aumenté el ancho */
        width: 100%;
        padding: 50px; /* Más relleno */
        background-color: #1c1c1c;
        border-radius: 12px; /* Bordes más redondeados */
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.7); /* Sombra más intensa */
    }

    .login-header {
        font-size: 40px; /* Fuente más grande */
        font-weight: bold;
        margin-bottom: 40px; /* Espacio más grande */
        color: white;
        text-align: center;
    }

    .btn-login {
        background-color: #13da1a;
        color: white;
        border: none;
        padding: 18px 40px; /* Botón más grande */
        font-size: 1.5em; /* Texto más grande */
        width: 100%;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-login:hover {
        background-color: #10c618;
    }

    .footer-link {
        text-align: center;
        color: white;
        margin-top: 30px; /* Espacio superior más grande */
        font-size: 1.2em; /* Fuente más grande */
    }

    .footer-link a {
        color: #17dd1e;
        text-decoration: none;
    }

    .footer-link a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: #ff4d4d;
        text-align: center;
        margin-bottom: 20px; /* Más espacio para el mensaje de error */
        font-weight: 600; /* Negrita */
    }

    /* Cambiar el color de las etiquetas de 'Correo electrónico' y 'Contraseña' a blanco */
    .form-label {
        color: white;
        font-weight: 600;
    }

    /* Responsive: Hacer más pequeño y accesible en dispositivos móviles */
    @media (max-width: 576px) {
        .login-container {
            padding: 25px;
            max-width: 90%;
        }

        .login-header {
            font-size: 30px;
        }

        .btn-login {
            font-size: 1.3em;
            padding: 16px 35px;
        }

        .footer-link {
            font-size: 1em;
        }
    }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-header">Iniciar Sesión</div>

        <!-- Mostrar mensaje de error si existe -->
        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <div class="footer-link">
            <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
