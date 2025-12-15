<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar Categoría</title>
</head>
<body>

<h1>Borrar Categoría</h1>

<form method="POST" action="">
    <label for="id">Introduce el ID de la categoría que quieres borrar:</label><br>
    <input type="number" id="id" name="id" required><br><br>
    <input type="submit" value="Borrar categoría">
</form>

<hr>

<?php
require_once "conexion.php";
$bd = conectar();

if ($bd && isset($_POST["id"])) {
    $id = $_POST["id"];

    try {

        $stmtCat = $bd->prepare("SELECT * FROM categorias WHERE id = :id");
        $stmtCat->execute([":id" => $id]);
        $categoria = $stmtCat->fetch(PDO::FETCH_ASSOC);

        if (!$categoria) {
            echo "No existe ninguna categoría con ese ID.<br><br>";
        } else {
            $sqlCheck = "SELECT COUNT(*) FROM cangrejos WHERE categoria = :id";
            $stmtCheck = $bd->prepare($sqlCheck);
            $stmtCheck->execute([":id" => $id]);
            $numCangrejos = $stmtCheck->fetchColumn();

            if ($numCangrejos > 0) {
                echo "❌ No se puede borrar la categoría <strong>{$categoria['nombre']}</strong> 
                      porque tiene $numCangrejos cangrejo(s) asociados.<br><br>";
            } else {
                $sqlDel = "DELETE FROM categorias WHERE id = :id";
                $stmtDel = $bd->prepare($sqlDel);
                $stmtDel->execute([":id" => $id]);
                echo "Categoría <strong>{$categoria['nombre']}</strong> borrada correctamente.<br><br>";
            }
        }

        echo "<a href='index.php'>Volver al listado</a>";
    } catch (PDOException $e) {
        echo "Error al borrar: " . $e->getMessage();
    }
}
?>

</body>
</html>
