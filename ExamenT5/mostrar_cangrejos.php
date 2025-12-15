<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Cangrejos</title>
    
</head>
<body>

<h1>Listado de Cangrejos</h1>

<?php
require_once "conexion.php";
$bd = conectar();

if ($bd) {

    $sql = "SELECT 
                c.id,
                c.nombre,
                cat.nombre AS categoria,
                c.fechaRecogida,
                c.fechaAdopcion,
                CONCAT(a.nif, ' - ', a.nombre) AS adoptante
            FROM cangrejos c
            LEFT JOIN categorias cat ON c.categoria = cat.id
            LEFT JOIN adoptantes a ON c.idAcogedor = a.id";

    $res = $bd->query($sql);

    if ($res->rowCount() > 0) {
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Fecha de Recogida</th>
                <th>Fecha de Adopción</th>
                <th>Adoptante (NIF - Nombre)</th>
              </tr>";
        foreach ($res as $fila) {
            echo "<tr>
                    <td>{$fila['id']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['categoria']}</td>
                    <td>{$fila['fechaRecogida']}</td>
                    <td>{$fila['fechaAdopcion']}</td>
                    <td>{$fila['adoptante']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay cangrejos registrados.</p>";
    }
} else {
    echo "<p style='color:red;'>❌ No se pudo conectar a la base de datos.</p>";
}
?>

<br>
<a href="index.php">⬅️ Volver al inicio</a>

</body>
</html>
