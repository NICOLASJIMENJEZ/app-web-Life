<?php
function inicializarTeatro($filas, $columnas) {
    $teatro = [];
    for ($i = 0; $i < $filas; $i++) {
        for ($j = 0; $j < $columnas; $j++) {
            $teatro[$i][$j] = "-"; // Libre
        }
    }
    return $teatro;
}

function procesarAccion(&$teatro, $fila, $puesto, $accion) {
    if (!isset($teatro[$fila][$puesto])) {
        return "Posición inválida.";
    }

    switch ($accion) {
        case "comprar":
            if ($teatro[$fila][$puesto] == "-") {
                $teatro[$fila][$puesto] = "X";
                return "Puesto comprado exitosamente.";
            } else {
                return "El puesto ya está ocupado o reservado.";
            }
        case "reservar":
            if ($teatro[$fila][$puesto] == "-") {
                $teatro[$fila][$puesto] = "R";
                return "Puesto reservado exitosamente.";
            } else {
                return "El puesto ya está ocupado o reservado.";
            }
        case "liberar":
            if ($teatro[$fila][$puesto] != "-") {
                $teatro[$fila][$puesto] = "-";
                return "Puesto liberado exitosamente.";
            } else {
                return "El puesto ya está libre.";
            }
        default:
            return "Acción no válida.";
    }
}

function convertirMatrizACadena($matriz) {
    return serialize($matriz);
}

function convertirCadenaAMatriz($cadena) {
    return unserialize($cadena);
}

?>
