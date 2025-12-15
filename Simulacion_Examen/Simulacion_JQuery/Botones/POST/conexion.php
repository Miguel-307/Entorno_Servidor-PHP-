<?php
// Define el nombre o IP del servidor de la base de datos (en XAMPP normalmente es "localhost")
$host = "localhost"; // Host del servidor de base de datos (normalmente localhost en XAMPP)

// Define el usuario con el que se accederá a MySQL (por defecto en XAMPP es "root")
$user = "root"; // Usuario de MySQL por defecto en XAMPP

// Define la contraseña del usuario de MySQL (por defecto está vacía en XAMPP)
$password = "SQLcontraseña"; // Contraseña del usuario (vacía por defecto en XAMPP)

// Define el nombre de la base de datos a la que se conectará el script
$database = "northwind"; // Nombre de la base de datos a la que conectarse

// Crea una nueva conexión usando la extensión MySQLi con los parámetros definidos
$conexion = new mysqli($host, $user, $password, $database); // Crea una nueva conexión MySQLi

// Verifica si ocurrió un error durante la conexión (por ejemplo, credenciales incorrectas o base de datos inaccesible)
if ($conexion->connect_error) { // Verifica si ocurrió algún error al conectar
    // Si hay error, detiene la ejecución del script y muestra el mensaje de error correspondiente
    die("Error de conexión: " . $conexion->connect_error); // Detiene la ejecución y muestra el error
}

// Si la ejecución llega aquí, la conexión se ha establecido correctamente y la variable $conexion queda disponible
?>
