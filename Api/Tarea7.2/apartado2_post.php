<?php
header('Content-Type: application/json');
$jsonRecibido = file_get_contents('php://input');
$datos = json_decode($jsonRecibido, true);


$num1 = $datos['num1'] ?? null;
$num2 = $datos['num2'] ?? null;
$operacion = $datos['operacion'] ?? null;


if ($num1 === null || $num2 === null || $operacion === null) {
    echo json_encode(["status" => "error", "mensaje" => "Faltan parámetros JSON"]);
    exit;
}
$resultado = 0;
switch ($operacion) {
    case 'suma': $resultado = $num1 + $num2; break;
    case 'resta': $resultado = $num1 - $num2; break;
    case 'multi': $resultado = $num1 * $num2; break;
    case 'div':
    if ($num2 == 0) {
            echo json_encode(["status" => "error", "mensaje" => "División por cero"]);
            exit;
    }
        $resultado = $num1 / $num2;
        break;
    default:
        echo json_encode(["status" => "error", "mensaje" => "Operación desconocida"]);
        exit;
}

echo json_encode([
    "status" => "success",
    "metodo" => "POST (JSON)",
    "resultado" => $resultado
]);
?>