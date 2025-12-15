<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Modificar</title></head>
<body style="font-family:Arial;text-align:center;background:#0e0e10;color:white;">

<?php
require_once "conexion.php";
require_once "funciones.php";

$conexion = conectar();
$id = $_GET["id"];
$datos = cargarId($conexion, $id);
$row = $datos->fetch(PDO::FETCH_ASSOC);
?>

<h2>Modificar Shipper</h2>

<form method="post" action="modificar.php">
    <input type="hidden" name="id" value="<?= $row['shipperId'] ?>">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= $row['companyName'] ?>"><br><br>

    <label>Teléfono:</label><br>
    <input type="text" name="telef" value="<?= $row['phone'] ?>"><br><br>

    <input type="submit" value="Guardar cambios">
</form>

<a href="index.php" style="color:#00a8ff;">🔙 Volver</a>

</body>
</html>
