<?php
require_once "conexion.php";
require_once "funciones.php";

$conexion = conectar();

if ($conexion) {
    $nombre = $_POST['nombre'];
    $telef = $_POST['telef'];
    if (insertar($conexion, $nombre, $telef)) {
        echo "✅ Registro insertado correctamente.<br>";
    } else {
        echo "❌ Error al insertar.<br>";
    }
    echo "<a href='index.php'>Volver al listado</a>";
}
?>
