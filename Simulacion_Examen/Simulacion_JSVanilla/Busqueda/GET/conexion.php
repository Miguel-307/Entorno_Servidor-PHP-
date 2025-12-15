<?php
// Define el nombre del host donde corre MySQL (normalmente localhost en XAMPP)
$host = "localhost";
// Define el usuario de la base de datos
$user = "root";
// Define la contraseña del usuario de la base de datos
$password = "SQLcontraseña";
// Define el nombre de la base de datos a la que se va a conectar
$database = "northwind";

// Crea una nueva instancia de mysqli para establecer la conexión a MySQL
$conexion = new mysqli($host, $user, $password, $database);

// Verifica si ocurrió un error al conectar
if ($conexion->connect_error) {
    // Detiene la ejecución y muestra el mensaje de error si la conexión falló
    die("Error de conexión: " . $conexion->connect_error);
}
?>
