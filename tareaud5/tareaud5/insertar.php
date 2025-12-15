<?php
require_once "conexion.php";
require_once "funciones.php";

$nombre= $_POST["nombre"];
$telef= $_POST["telef"];

$bd = conectar();
if($bd) {
    if(insertar($bd,$nombre,$telef)) {
        echo "Insertado correctamente.";
    } else {
        echo "Problemas insertando el registro.";
    }
    echo "<a href='index.php'>Volver al listado</a>";
}