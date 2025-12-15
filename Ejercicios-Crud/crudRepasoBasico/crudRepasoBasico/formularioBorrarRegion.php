<?php

    require_once "conexion.php";
    require_once "funciones.php";
    $bd = conectar();
    if($bd){
        // Aseguramos que el ID se recibe y es un número entero
        $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
        
        if($id !== false){
            echo "Borrando registro Región con ID: $id <br>";
            if(borrarRegion($bd, $id)){
                echo "Borrado correctamente. <br>";
            }else{
                echo "No se ha podido borrar el registro de la Región con ID: $id. (Verifique si hay Territorios asociados a esta región, lo que causaría un error de clave foránea).";
            }
        } else {
             echo "ID de Región incorrecto.<br>";
        }
        echo "<a href = 'index.php'> Volver al listado </a>";
    }

?>