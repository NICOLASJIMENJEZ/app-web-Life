<?php
// modulos/contacto.php

// Verificar si se puede incluir la conexión
if (file_exists("../modelo/conexion.php")) {
    include("../modelo/conexion.php");
} else {
    die("Error: No se puede incluir el archivo de conexión.");
}

// Verificar conexión
if (!isset($conexion)) {
    die("Error: No se estableció la conexión con la base de datos.");
}

// Captura segura
$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? ''); // Cambié correo por email
$mensaje = trim($_POST['mensaje'] ?? '');

// Validación
if ($nombre && $email && $mensaje) {
    $stmt = $conexion->prepare("INSERT INTO contactos (nombre, email, mensaje) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $nombre, $email, $mensaje);
        if ($stmt->execute()) {
            echo "Mensaje enviado correctamente.";
        } else {
            echo "Error al ejecutar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
} else {
    echo "Todos los campos son obligatorios.";
}

$conexion->close();
?>
