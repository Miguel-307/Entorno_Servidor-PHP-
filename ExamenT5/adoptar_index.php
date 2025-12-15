<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Adoptantes</title>
</head>
<body>

<h1>CRUD Adoptantes</h1>

<a href="insertar.php">Nuevo adoptante</a><br><br>

<?php
require_once "conexion.php";
$bd = conectar();

$res = $bd->query("SELECT * FROM adoptantes");

if ($res->rowCount() > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr>
            <th>ID</th>
            <th>NIF</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Fecha Alta</th>
            <th>Fecha Baja</th>
            <th>Acciones</th>
          </tr>";

    foreach ($res as $fila) {
        echo "<tr>
                <td>{$fila['id']}</td>
                <td>{$fila['nif']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['apellidos']}</td>
                <td>{$fila['alta']}</td>
                <td>".($fila['baja'] ?? '')."</td>
                <td>
                    <a href='modificar.php?id={$fila['id']}'>Modificar</a> |
                    <a href='borrar.php?id={$fila['id']}'>Borrar</a>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No hay adoptantes registrados.";
}
?>

<br>
<a href="index.php">Volver al inicio</a>

</body>
</html>
