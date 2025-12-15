<?php

function conectar() {
    $cadena_conexion = 'mysql:dbname=Crabadopt;host=localhost';
    $usuario = 'root';
    $clave = 'SQLcontraseña';
    try {
        $bd = new PDO($cadena_conexion, $usuario, $clave);        
    } catch (PDOExeption $e) {
        echo 'Error con la base de datos: '.$e->getMessage();
    }
    return $bd;
}