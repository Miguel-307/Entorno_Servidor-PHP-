<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Cangrejos</title>
</head>
<body>

<h1>CRUD Cangrejos</h1>
<a href="cangrejo_insertar.php">Nuevo Cangrejo</a><br><br>

<?php
require_once "conexion.php";
$bd = conectar();

$sql = "SELECT 
            c.id,
            c.nombre,
            c.fechaRecogida,
            c.fechaAdopcion,
            cat.nombre AS categoria,
            CONCAT(a.nif, ' - ', a.nombre) AS adoptante
        FROM cangrejos c
        LEFT JOIN categorias cat ON c.categoria = cat.id
        LEFT JOIN adoptantes a ON c.idAcogedor = a.id";

$res = $bd->query($sql);

if ($res->rowCount() > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Fecha Recogida</th>
            <th>Fecha Adopción</th>
            <th>Adoptante (NIF - Nombre)</th>
            <th>Modificar</th>
            <th>Borrar</th>
          </tr>";

    foreach ($res as $fila) {
        echo "<tr>
                <td>{$fila['id']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['categoria']}</td>
                <td>{$fila['fechaRecogida']}</td>
                <td>{$fila['fechaAdopcion']}</td>
                <td>{$fila['adoptante']}</td>
                <td><a href='cangrejo_modificar.php?id={$fila['id']}'>Modificar</a></td>
                <td><a href='cangrejo_borrar.php?id={$fila['id']}'>Borrar</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay cangrejos registrados.";
}
?>

<br>
<a href="index.php">Volver al inicio</a>

</body>
</html>
