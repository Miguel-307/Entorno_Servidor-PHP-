<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar Cangrejo</title>
</head>
<body>

<h1>Borrar Cangrejo</h1>

<?php
require_once "conexion.php";
$bd = conectar();

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Comprobar si existe el cangrejo
    $stmt = $bd->prepare("SELECT * FROM cangrejos WHERE id = :id");
    $stmt->execute([":id" => $id]);
    $cangrejo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cangrejo) {
        // Borrar directamente el cangrejo
        $sql = "DELETE FROM cangrejos WHERE id = :id";
        $stmt = $bd->prepare($sql);
        $stmt->execute([":id" => $id]);
        echo "Cangrejo eliminado correctamente.<br><br>";
    } else {
        echo "❌ No existe ningún cangrejo con ese ID.<br><br>";
    }

    echo "<a href='cangrejo_index.php'>Volver al listado</a>";
} else {
    echo "No se ha especificado ningún ID.";
}
?>

</body>
</html>
