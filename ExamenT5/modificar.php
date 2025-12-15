<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Adoptante</title>
</head>
<body>

<h1>Modificar Adoptante</h1>

<?php
require_once "conexion.php";
$bd = conectar();

// --- GUARDAR CAMBIOS ---
if (isset($_POST["guardar"])) {
    $id = $_POST["id"];
    $nif = trim($_POST["nif"]);
    $nombre = trim($_POST["nombre"]);
    $apellidos = trim($_POST["apellidos"]);
    $alta = $_POST["alta"];
    $baja = !empty($_POST["baja"]) ? $_POST["baja"] : null;

    $check = $bd->prepare("SELECT COUNT(*) FROM adoptantes WHERE nif = :nif AND id != :id");
    $check->execute([":nif" => $nif, ":id" => $id]);
    $existe = $check->fetchColumn();

    if ($existe > 0) {
        echo "❌ El NIF <strong>$nif</strong> ya está registrado en otro adoptante. No se puede duplicar.<br><br>";
    } else {

        $sql = "UPDATE adoptantes
                SET nif = :nif, nombre = :nombre, apellidos = :apellidos, alta = :alta, baja = :baja
                WHERE id = :id";
        $stmt = $bd->prepare($sql);
        $stmt->execute([
            ":nif" => $nif,
            ":nombre" => $nombre,
            ":apellidos" => $apellidos,
            ":alta" => $alta,
            ":baja" => $baja,
            ":id" => $id
        ]);
        echo " Adoptante modificado correctamente.<br><br>";
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $bd->prepare("SELECT * FROM adoptantes WHERE id = :id");
    $stmt->execute([":id" => $id]);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fila) {
        echo "<form method='POST'>
                <input type='hidden' name='id' value='{$fila['id']}'>
                NIF: <input type='text' name='nif' value='{$fila['nif']}' required><br>
                Nombre: <input type='text' name='nombre' value='{$fila['nombre']}' required><br>
                Apellidos: <input type='text' name='apellidos' value='{$fila['apellidos']}' required><br>
                Alta: <input type='date' name='alta' value='{$fila['alta']}' required><br>
                Baja: <input type='date' name='baja' value='{$fila['baja']}'><br>
                <input type='submit' name='guardar' value='Guardar cambios'>
              </form>";
    } else {
        echo "No se ha encontrado ningún adoptante con ese ID.";
    }
} else {
    echo "No se ha especificado ningún ID.";
}
?>

<br>
<a href="adoptar_index.php">Volver al listado</a>

</body>
</html>
