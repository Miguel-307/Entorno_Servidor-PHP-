<?php

    require_once "conexion.php";
    require_once "funciones.php";

    $descripcion = $_POST["descripcion"];

    $bd = conectar();
    if($bd){
        if(insertarRegion($bd, $descripcion)){
            echo "Región insertada correctamente<br>";
        }else{
            echo "Problemas insertando el registro de la Región<br>";
        }
        echo "<a href='index.php'>Menu principal</a>";
    }

?>