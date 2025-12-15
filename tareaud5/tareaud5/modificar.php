<?php
require_once "conexion.php";
require_once "funciones.php";

$id=$_POST["id"];
$nombre= $_POST["nombre"];
$telef= $_POST["telef"];

$bd = conectar();
if($bd) {
    echo "Modificando registro: ".$id."<br>";
    if(modificar($bd,$id,$nombre,$telef)) {
        echo "Modificado correctamente.<br>";
    } else {
        echo "Problemas modificando el registro.<br>";
    }
    echo "<a href='index.php'>Volver al listado</a>";
}