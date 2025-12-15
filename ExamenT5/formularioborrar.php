<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Borrar registro</title>
</head>
<body>
<h1>Borrar registro</h1>

<form method="POST" action="">
    <label for="id">Introduce el ID del registro que quieres borrar:</label><br>
    <input id="id" name="id" type="number" required><br><br>
    <input type="submit" value="Cargar datos">
</form>

<?php
require_once "conexion.php";
require_once "funciones.php";

$bd = conectar();

if ($bd && isset($_POST["id"]) && !isset($_POST["confirmar"])) {
    $id = (int)$_POST["id"];
    if ($id > 0) {
        $res = cargarId($bd, $id);
        if ($res && $res->rowCount() > 0) {
            $row = $res->fetch(PDO::FETCH_ASSOC);
            echo "<hr>";
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='id' value='" . (int)$row["id"] . "'>";
            echo "<p><strong>¿Seguro que quieres borrar esta categoría?</strong></p>";
            echo "<p>ID: " . (int)$row["id"] . "</p>";
            echo "<p>Nombre: " . htmlspecialchars($row["nombre"] ?? "", ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<input type='hidden' name='confirmar' value='1'>";
            echo "<input type='submit' value='Sí, borrar'> ";
            echo "<a href='index.php'>Cancelar</a>";
            echo "</form>";
        } else {
            echo "<p style='color:red;'>No existe ningún registro con ese ID.</p>";
        }
    } else {
        echo "<p style='color:red;'>El ID debe ser un número mayor que 0.</p>";
    }
}

if ($bd && isset($_POST["confirmar"])) {
    $id = (int)($_POST["id"] ?? 0);
    if ($id > 0 && borrar($bd, $id)) {
        echo "<p style='color:green;'>Registro borrado correctamente.</p>";
        echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 800);</script>";
    } else {
        echo "<p style='color:red;'>No se ha podido borrar el registro.</p>";
    }
}
?>
</body>
</html>
