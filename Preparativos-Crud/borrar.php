<?php
require_once "conexion.php";
require_once "funciones.php";

$conexion = conectar();

if ($conexion) {
    $id = $_GET['id'];
    if (borrar($conexion, $id)) {
        echo "🗑️ Registro eliminado correctamente.<br>";
    } else {
        echo "❌ Error al eliminar.<br>";
    }
    echo "<a href='index.php'>Volver al listado</a>";
}
?>
