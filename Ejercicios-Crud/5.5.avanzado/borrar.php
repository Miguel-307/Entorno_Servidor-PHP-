<?php
require_once "conexion.php";
require_once "funciones.php";

$id = $_GET['id'] ?? null;
if ($id) {
    try {
        borrar_customer($conexion, $id);
    } catch (PDOException $e) {
        die("No se puede eliminar el cliente (tiene pedidos o pagos asociados).");
    }
}
header("Location: index.php");
exit;
?>
