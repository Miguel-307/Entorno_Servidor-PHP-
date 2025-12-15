<?php

    function conectar(){
        $cadena_conexion = "mysql:dbname=Northwind; host:localhost";
        $usuario = "root";
        $clave = "SQLcontraseña";

        try{
            $bd = new PDO($cadena_conexion, $usuario, $clave);
            return $bd;
        }catch(PDOException $e){
            echo "Error con la base de datos: " . $e->getMessage();
            return null;
        }
    }

?>