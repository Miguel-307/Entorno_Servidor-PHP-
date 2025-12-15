<?php
// Crea la conexión a la base de datos MySQL usando mysqli
$conexion = mysqli_connect("localhost", "root", "", "classicmodels");

// Si la conexión falla, muestra un mensaje y detiene la ejecución
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
