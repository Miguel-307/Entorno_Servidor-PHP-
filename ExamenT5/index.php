<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Cangrejo</title>
</head>
<body>

<h1>Nuevo Cangrejo</h1>

<?php
require_once "conexion.php";
$bd = conectar();

if (isset($_POST["insertar"])) {
    // Si no hay fecha de adopción, se guarda como NULL
    $fechaAdopcion = !empty($_POST["fechaAdopcion"]) ? $_POST["fechaAdopcion"] : null;

    $sql = "INSERT INTO cangrejos (nombre, categoria, fechaRecogida, fechaAdopcion, idAcogedor)
            VALUES (:nombre, :categoria, :fechaRecogida, :fechaAdopcion, :idAcogedor)";
    $stmt = $bd->prepare($sql);
    $stmt->execute([
        ":nombre" => $_POST["nombre"],
        ":categoria" => $_POST["categoria"],
        ":fechaRecogida" => $_POST["fechaRecogida"],
        ":fechaAdopcion" => $fechaAdopcion,
        ":idAcogedor" => $_POST["idAcogedor"]
    ]);

    echo "Cangrejo insertado correctamente.<br><br>";
}

$categorias = $bd->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
$adoptantes = $bd->query("SELECT * FROM adoptantes")->fetchAll(PDO::FETCH_ASSOC);
?>

<form method="POST">
    Nombre: <input type="text" name="nombre" required><br>
    Categoría:
    <select name="categoria" required>
        <?php foreach ($categorias as $cat) echo "<option value='{$cat['id']}'>{$cat['nombre']}</option>"; ?>
    </select><br>
    Fecha de recogida: <input type="date" name="fechaRecogida" required><br>
    Fecha de adopción: <input type="date" name="fechaAdopcion"><br>
    Adoptante:
    <select name="idAcogedor" required>
        <?php foreach ($adoptantes as $ad) echo "<option value='{$ad['id']}'>{$ad['nif']} - {$ad['nombre']}</option>"; ?>
    </select><br>
    <input type="submit" name="insertar" value="Guardar">
</form>

<br>
<a href="cangrejo_index.php">Volver al listado</a>

</body>
</html>
