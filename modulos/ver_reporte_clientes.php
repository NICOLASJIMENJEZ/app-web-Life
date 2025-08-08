<?php
// modulos/ver_reporte_clientes.php

include_once(__DIR__ . "modelo/conexion.php");

if (!isset($conexion)) {
    die("❌ Error: No se estableció la conexión con la base de datos.");
}

// Asegura que se haya recibido el nombre por GET
$nombreCliente = $_GET['nombre'] ?? '';
if (empty($nombreCliente)) {
    die("❌ No se proporcionó el nombre del cliente.");
}

// Actualizar reporte
if (isset($_POST['actualizar_id'])) {
    $id = intval($_POST['actualizar_id']);
    $peso = $_POST['peso'];
    $estatura = $_POST['estatura'];
    $edad = $_POST['edad'];
    $pecho = $_POST['carga_pecho'];
    $sentadilla = $_POST['carga_sentadilla'];
    $biceps = $_POST['carga_biceps'];
    $triceps = $_POST['carga_triceps'];
    $hombro = $_POST['carga_hombro'];

    $sql_update = "UPDATE reportes SET
        peso = :peso, estatura = :estatura, edad = :edad,
        carga_pecho = :pecho, carga_sentadilla = :sentadilla,
        carga_biceps = :biceps, carga_triceps = :triceps, carga_hombro = :hombro
        WHERE id = :id";

    $stmt = $conexion->prepare($sql_update);
    $stmt->execute([
        ':peso' => $peso,
        ':estatura' => $estatura,
        ':edad' => $edad,
        ':pecho' => $pecho,
        ':sentadilla' => $sentadilla,
        ':biceps' => $biceps,
        ':triceps' => $triceps,
        ':hombro' => $hombro,
        ':id' => $id
    ]);
}

// Consultar reportes
$sql = "SELECT * FROM reportes WHERE nombre = :nombre ORDER BY fecha_reporte DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute([':nombre' => $nombreCliente]);
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

