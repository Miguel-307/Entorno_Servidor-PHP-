<?php
require_once "conexion.php";
require_once "funciones.php";

if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit; }

$id = $_GET['id'] ?? null;
if ($id) {
    try {
        borrar_producto($conexion, $id);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
header("Location: index.php");
exit;
?>
