<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Shippers</title>
</head>
<body style="background-color:#0e0e10; color:white; text-align:center; font-family:Arial;">

<h2>Conexión y Tabla Shipper</h2>

<?php
require_once "conexion.php";
require_once "funciones.php";

if(isset($_POST['volver'])) unset($_POST['conectar']);

$conexion = conectar();

if($conexion) {
    $shippers = cargar_shippers($conexion);
    echo mostrar_tabla($shippers);
}
?>
</body>
</html>
