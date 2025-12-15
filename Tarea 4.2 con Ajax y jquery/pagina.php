<?php

if (!isset($_POST['numero'])) {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'Falta el parámetro numero'
    ]);
    exit;
}


$numero = $_POST['numero'];

if ($numero === '' || !is_numeric($numero)) {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'El parámetro numero no es válido'
    ]);
    exit;
}


$valor = floatval($numero);
$cuadrado = $valor * $valor;

//Respuesta JSON
echo json_encode([
    'ok' => true,
    'resultado' => $cuadrado
]);
