<?php
require_once "conexion.php";
require_once "funciones.php";

$bd = conectar();
if($bd) {
    $id=$_GET["id"];
    echo "Borrando id: $id<br>";
    if(borrar($bd, $id)) {
        echo "Borrado correctamente.<br>";
    } else {
        echo "No se ha podido borrar el registro.<br>";
    }
    echo "<a href='index.php'>Volver al listado</a>";
}