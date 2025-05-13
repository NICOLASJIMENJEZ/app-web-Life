<?php
// Parámetros de conexión
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Usuario de la base de datos
$password = "903135Nicolas"; // Contraseña del usuario
$dbname = "Life_Gym"; // Nombre de la base de datos

// Crear la conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
