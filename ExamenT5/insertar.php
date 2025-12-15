<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Adoptante</title>
</head>
<body>

<h1>Nuevo Adoptante</h1>

<?php
require_once "conexion.php";
$bd = conectar();

if (isset($_POST["insertar"])) {
    $nif = trim($_POST["nif"]);
    $nombre = trim($_POST["nombre"]);
    $apellidos = trim($_POST["apellidos"]);
    $alta = $_POST["alta"];
    $baja = !empty($_POST["baja"]) ? $_POST["baja"] : null;

    // 1️ Verificar si el NIF ya existe
    $check = $bd->prepare("SELECT COUNT(*) FROM adoptantes WHERE nif = :nif");
    $check->execute([":nif" => $nif]);
    $existe = $check->fetchColumn();

    if ($existe > 0) {
        echo " El NIF <strong>$nif</strong> ya existe en la base de datos. No se puede duplicar.<br><br>";
    } else {
        // 2️ Insertar nuevo adoptante
        $sql = "INSERT INTO adoptantes (nif, nombre, apellidos, alta, baja)
                VALUES (:nif, :nombre, :apellidos, :alta, :baja)";
        $stmt = $bd->prepare($sql);
        $stmt->execute([
            ":nif" => $nif,
            ":nombre" => $nombre,
            ":apellidos" => $apellidos,
            ":alta" => $alta,
            ":baja" => $baja
        ]);
        echo " Nuevo adoptante añadido correctamente.<br><br>";
    }
}
?>

<form method="POST">
    NIF: <input type="text" name="nif" required><br>
    Nombre: <input type="text" name="nombre" required><br>
    Apellidos: <input type="text" name="apellidos" required><br>
    Fecha de alta: <input type="date" name="alta" required><br>
    Fecha de baja: <input type="date" name="baja"><br>
    <input type="submit" name="insertar" value="Guardar">
</form>

<br>
<a href="adoptar_index.php">Volver al listado</a>

</body>
</html>
