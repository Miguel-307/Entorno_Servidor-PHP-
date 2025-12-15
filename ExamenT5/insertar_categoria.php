<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Categoría</title>
</head>
<body>
<h1>➕ Insertar Categoría</h1>

<form method="POST" action="">
    <label>Nombre de la categoría:</label><br>
    <input type="text" name="nombre" required><br><br>
    <input type="submit" value="Guardar">
</form>

<?php
require_once "conexion.php";
require_once "funciones.php";

$bd = conectar();

if ($bd && isset($_POST["nombre"])) {
    $nombre = trim($_POST["nombre"]);
    if (insertarCategoria($bd, $nombre)) {
        echo "<p style='color:green;'>✅ Categoría insertada correctamente.</p>";
    } else {
        echo "<p style='color:red;'>❌ Error al insertar la categoría.</p>";
    }
}
?>

<br>
<a href="index.php">⬅️ Volver al inicio</a>
</body>
</html>
