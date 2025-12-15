<?php

function conectar() {
    $cadena_conexion = 'mysql:dbname=Northwind;host=127.0.0.1';
    $usuario = 'root';
    $clave = 'SQLcontraseña';
    try {
        $bd = new PDO($cadena_conexion, $usuario, $clave);        
    } catch (PDOExeption $e) {
        echo 'Error con la base de datos: '.$e->getMessage();
    }
    return $bd;
}