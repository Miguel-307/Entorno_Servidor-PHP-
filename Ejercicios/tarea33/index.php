<?php

// Variables
$hostDB = '127.0.0.1';
$nombreDB = 'empresa';
$usuarioDB = 'root';
$contrasenyaDB = '';
// Conecta con base de datos
$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
// Prepara SELECT
$miConsulta = $miPDO->prepare('SELECT * FROM empleados;');
// Ejecuta consulta
$miConsulta->execute();
// Imprimo
$resultados = $miConsulta->fetchAll();
foreach ($resultados as $posicion => $columna) {
    echo $columna['Nombre'];
}