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
    // Si el campo de fecha adopción está vacío, guardamos NULL
    $fechaAdopcion = !empty($_POST["fechaAdopcion"]) ? $_POST["fechaAdopcion"] : null;

    $sql = "INSERT INTO cangrejos (nombre, categoria, fechaRecogida, fechaAdopcion, idAcogedor)
            VALUES (:nombre, :categoria, :fechaRecogida, :fechaAdopcion, :idAcogedor)";
    $stmt = $bd->prepare($sql);

    // Asociamos los valores de forma segura
    $stmt->bindValue(":nombre", $_POST["nombre"]);
    $stmt->bindValue(":categoria", $_POST["categoria"], PDO::PARAM_INT);
    $stmt->bindValue(":fechaRecogida", $_POST["fechaRecogida"]);

    // Si no hay fecha adopción, enviamos NULL real
    if ($fechaAdopcion === null) {
        $stmt->bindValue(":fechaAdopcion", null, PDO::PARAM_NULL);
    } else {
        $stmt->bindValue(":fechaAdopcion", $fechaAdopcion);
    }

    $stmt->bindValue(":idAcogedor", $_POST["idAcogedor"], PDO::PARAM_INT);

    // Ejecutar y confirmar inserción
    try {
        $stmt->execute();
        echo "✅ Cangrejo insertado correctamente.<br><br>";
    } catch (PDOException $e) {
        echo "❌ Error al insertar: " . $e->getMessage();
    }
}

// Cargar relaciones para el formulario
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
