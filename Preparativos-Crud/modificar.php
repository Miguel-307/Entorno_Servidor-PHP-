<?php
require_once "conexion.php";
require_once "funciones.php";

$conexion = conectar();

if ($conexion) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $telef = $_POST['telef'];

    if (modificar($conexion, $id, $nombre, $telef)) {
        echo "✅ Registro modificado correctamente.<br>";
    } else {
        echo "❌ Error al modificar.<br>";
    }
    echo "<a href='index.php'>Volver al listado</a>";
}
?>
