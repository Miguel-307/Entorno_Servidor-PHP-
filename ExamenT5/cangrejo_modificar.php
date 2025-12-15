<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Cangrejo</title>
</head>
<body>

<h1>Modificar Cangrejo</h1>

<?php
require_once "conexion.php";
$bd = conectar();

if (isset($_POST["guardar"])) {
    $sql = "UPDATE cangrejos
            SET nombre = :nombre, categoria = :categoria,
                fechaRecogida = :fechaRecogida, fechaAdopcion = :fechaAdopcion,
                idAcogedor = :idAcogedor
            WHERE id = :id";
    $stmt = $bd->prepare($sql);
    $stmt->execute([
        ":nombre" => $_POST["nombre"],
        ":categoria" => $_POST["categoria"],
        ":fechaRecogida" => $_POST["fechaRecogida"],
        ":fechaAdopcion" => $_POST["fechaAdopcion"],
        ":idAcogedor" => $_POST["idAcogedor"],
        ":id" => $_POST["id"]
    ]);
    echo "Cangrejo modificado correctamente.<br><br>";
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $bd->prepare("SELECT * FROM cangrejos WHERE id = :id");
    $stmt->execute([":id" => $id]);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fila) {
        $categorias = $bd->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
        $adoptantes = $bd->query("SELECT * FROM adoptantes")->fetchAll(PDO::FETCH_ASSOC);

        echo "<form method='POST'>
                <input type='hidden' name='id' value='{$fila['id']}'>
                Nombre: <input type='text' name='nombre' value='{$fila['nombre']}' required><br>
                Categoría:
                <select name='categoria'>";
                foreach ($categorias as $cat) {
                    $sel = ($cat['id'] == $fila['categoria']) ? "selected" : "";
                    echo "<option value='{$cat['id']}' $sel>{$cat['nombre']}</option>";
                }
        echo "</select><br>
                Fecha de recogida: <input type='date' name='fechaRecogida' value='{$fila['fechaRecogida']}' required><br>
                Fecha de adopción: <input type='date' name='fechaAdopcion' value='{$fila['fechaAdopcion']}' required><br>
                Adoptante:
                <select name='idAcogedor'>";
                foreach ($adoptantes as $ad) {
                    $sel = ($ad['id'] == $fila['idAcogedor']) ? "selected" : "";
                    echo "<option value='{$ad['id']}' $sel>{$ad['nif']} - {$ad['nombre']}</option>";
                }
        echo "</select><br>
                <input type='submit' name='guardar' value='Guardar cambios'>
              </form>";
    } else {
        echo "No se ha encontrado ningún cangrejo con ese ID.";
    }
} else {
    echo "No se ha especificado ningún ID.";
}
?>

<br>
<a href="cangrejo_index.php">Volver al listado</a>

</body>
</html>
