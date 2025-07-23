<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de Usuarios</title>
</head>
<body>
    <h2>Lista de usuarios</h2>

    <?php
    // Arreglos con los datos
    $nombre = array("Pablo Manrique", "Nancy Peña", "Carlos Ruiz"); //variables de los datos de la lista
    $direccion = array("Calle 12-12", "Calle 11-13", "Av 7 #34-45");
    $telefono = array("314789654", "321456987", "3109876543");
    $color = array("Verde", "Rojo", "Azul");
    $significado = array("Esperanza", "Pasión", "Tranquilidad");

 for ($i = 0; $i < count($nombre); $i++) {
        echo "<p>";
        echo "<strong>Nombre:</strong> " . $nombre[$i]  ;   //contine sintaxis php y html para mostrar el contenido en el servidor
        echo "<strong>Dirección:</strong> " . $direccion[$i]. "<br>" ;
        echo "<strong>Teléfono:</strong> " . $telefono[$i] . "<br>" ;
        echo "<strong>Color favorito:</strong> " . $color[$i] . "<br>" ;
        echo "<strong>Significado del color:</strong> " . $significado[$i];
        echo "</p><hr>";
    }

   ?>


</body>
</html>
