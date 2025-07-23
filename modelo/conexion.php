<?php
$url = getenv("MYSQL_URL");
$dbparts = parse_url($url);

$host = $dbparts["host"];
$user = $dbparts["user"];
$pass = $dbparts["pass"];
$port = $dbparts["port"];
$db   = ltrim($dbparts["path"], '/');

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// echo "Conectado a Railway con éxito";
?>
