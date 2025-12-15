<?php

include 'cab.php';
include 'bd.php';

$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
// Obtiene codigo del libro a borrar
$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
// Prepara DELETE
$miConsulta = $miPDO->prepare("DELETE FROM empleados WHERE codemple = $codigo");
// Ejecuta la sentencia SQL
$miConsulta->execute();
// Redireccionamos al PHP con todos los datos
header('Location: lista.php');