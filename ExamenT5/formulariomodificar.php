<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Modificar Categoría</title></head>
<body>
<h1>Modificar Categoría</h1>

<form method="POST" action="">
  <label for="id">Introduce el ID de la categoría:</label><br>
  <input type="number" name="id" required>
  <input type="submit" value="Cargar datos">
</form>

<?php
require_once "conexion.php";
require_once "funciones.php";

$bd = conectar();

if ($bd && isset($_POST["id"]) && !isset($_POST["modificar"])) {
    $id = (int)$_POST["id"];
    $res = cargarId($bd, $id);
    if ($res && $res->rowCount() > 0) {
        $row = $res->fetch(PDO::FETCH_ASSOC);
        echo "<hr>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='id' value='".$row["id"]."'>";
        echo "<label>Nombre:</label><br>";
        echo "<input type='text' name='nombre' value='".$row["nombre"]."' required><br><br>";
        echo "<input type='hidden' name='modificar' value='1'>";
        echo "<input type='submit' value='Guardar cambios'>";
        echo "</form>";
    } else {
        echo "<p style='color:red;'>No existe esa categoría.</p>";
    }
}

if ($bd && isset($_POST["modificar"])) {
    $id = (int)$_POST["id"];
    $nombre = $_POST["nombre"];
    if (modificar($bd, $id, $nombre)) echo "<p style='color:green;'>Categoría modificada correctamente.</p>";
    else echo "<p style='color:red;'>Error al modificar.</p>";
}
?>
<a href="index.php">Volver</a>
</body>
</html>
