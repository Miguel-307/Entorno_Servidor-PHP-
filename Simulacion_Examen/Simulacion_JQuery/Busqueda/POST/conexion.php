<?php
$host = "localhost"; // Host del servidor de base de datos (normalmente localhost en XAMPP)
$user = "root"; // Usuario de MySQL por defecto en XAMPP
$password = "SQLcontraseña"; // Contraseña del usuario (vacía por defecto en XAMPP)
$database = "northwind"; // Nombre de la base de datos a la que conectarse

$conexion = new mysqli($host, $user, $password, $database); // Crea una nueva conexión MySQLi

if ($conexion->connect_error) { // Verifica si ocurrió algún error al conectar
    die("Error de conexión: " . $conexion->connect_error); // Detiene la ejecución y muestra el error
}
?>
