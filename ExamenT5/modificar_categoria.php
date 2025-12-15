<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Categoría</title>
</head>
<body>
<h1>✏️ Modificar Categoría</h1>

<form method="POST" action="">
    <label for="id">Introduce el ID de la categoría que quieres modificar:</label><br>
    <input type="number" name="id" id="id" required><br><br>
    <input type="submit" name="buscar" value="Cargar datos">
</form>

<?php
require_once "conexion.php";
require_once "funciones.php";
$bd = conectar();

if ($bd && isset($_POST["buscar"])) {
    $id = intval($_POST["id"]);
    $res = cargarCategoria($bd, $id);

    if ($res->rowCount() > 0) {
        $row = $res->fetch(PDO::FETCH_ASSOC);
        echo "<hr>";
        echo "<form method='POST' action=''>
                <input type='hidden' name='id' value='{$row['id']}'>
                <label>Nuevo nombre:</label><br>
                <input type='text' name='nombre' value='{$row['nombre']}' required><br><br>
                <input type='submit' name='guardar' value='Guardar cambios'>
            </form>";
    } else {
        echo "<p style='color:red;'> No existe ninguna categoría con ese ID.</p>";
    }
}

if ($bd && isset($_POST["guardar"])) {
    if (modificarCategoria($bd, $_POST["id"], $_POST["nombre"])) {
        echo "<p style='color:green;'> Categoría modificada correctamente.</p>";
    } else {
        echo "<p style='color:red;'> Error al modificar la categoría.</p>";
    }
}
?>

<br>
<a href="index.php">⬅️ Volver al inicio</a>
</body>
</html>
