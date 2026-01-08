<?php

header('Content-Type: application/json');


$num1 = $_GET['num1'] ?? null;
$num2 = $_GET['num2'] ?? null;
$operacion = $_GET['operacion'] ?? null; 

if ($num1 === null || $num2 === null || $operacion === null) {
    echo json_encode([
        "status" => "error",
        "mensaje" => "Faltan parámetros. Usa: ?num1=X&num2=Y&operacion=Z"
    ]);
    exit;
}

$resultado = 0;
switch ($operacion) {
    case 'suma':
        $resultado = $num1 + $num2;
        break;
    case 'resta':
        $resultado = $num1 - $num2;
        break;
    case 'multi':
        $resultado = $num1 * $num2;
        break;
    case 'div':
        if ($num2 == 0) {
            echo json_encode(["status" => "error", "mensaje" => "No se puede dividir por cero"]);
            exit;
        }
        $resultado = $num1 / $num2;
        break;
    default:
        echo json_encode(["status" => "error", "mensaje" => "Operación no válida"]);
        exit;
}


echo json_encode([
    "status" => "success",
    "operacion" => $operacion,
    "resultado" => $resultado
]);
?>