<?php
require_once "conexion.php";
require_once "funciones.php";

$bd=conectar();
if($bd) {
    $shippers = cargar_shippers($bd);
    echo mostrar_tabla($shippers);
} else {
    echo "No hay conexión a la base de datos.";
}