<?php

    require_once "conexion.php";
    require_once "funciones.php";

    $id = $_POST["id"];
    $descripcion = $_POST["descripcion"];

    $bd = conectar();
    if($bd){
        // Se asume que el ID es válido, ya que vino del formulario de modificación
        if(modificarRegion($bd, $id, $descripcion)){
            echo "Región modificada correctamente<br>";
        }else{
            echo "Problemas modificando el registro de la Región<br>";
        }
        echo "<a href='index.php'>Menu principal</a>";
    }

?>