<?php

    require_once "conexion.php";
    require_once "funciones.php";
    $bd=conectar();
    
    if($bd){

        // Tabla Region (nuevo ejercicio)
        $regions = cargarRegion($bd);
        echo mostrarTablaRegion($regions);

    }else{
        echo "No hay conexion con la base de datos.";
    }

?>