<?php


include_once("procesamiento.php");
include_once("presentacion.php");

if (!isset($_POST['matriz_teatro'])) {
    $teatro = inicializarTeatro(5, 5); // 5 filas, 5 columnas
} else {
    $teatro = convertirCadenaAMatriz($_POST['matriz_teatro']);
    $fila = intval($_POST['fila']) - 1;
    $puesto = intval($_POST['puesto']) - 1;
    $accion = $_POST['accion'];

    $mensaje = procesarAccion($teatro, $fila, $puesto, $accion);
}

$matrizSerializada = convertirMatrizACadena($teatro);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Teatro</title>
</head>
<body>
    <h2>Reserva de puestos en el teatro</h2>
    <?php if (isset($mensaje)) echo "<p style='color:red;'>$mensaje</p>"; ?>

    <?php mostrarTeatro($teatro); ?>

    <form method="post">
        <label>Fila: <input type="number" name="fila" required min="1" max="5"></label><br>
        <label>Puesto: <input type="number" name="puesto" required min="1" max="5"></label><br>
        <label>Acción:
            <select name="accion">
                <option value="comprar">Comprar</option>
                <option value="reservar">Reservar</option>
                <option value="liberar">Liberar</option>
            </select>
        </label><br><br>

        <textarea name="matriz_teatro" style="display:none;"><?php echo htmlspecialchars($matrizSerializada); ?></textarea>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
