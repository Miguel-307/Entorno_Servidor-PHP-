<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

// Función para responder en JSON
function responder($estado, $mensaje, $resultado = null) {
    echo json_encode([
        "estado"   => $estado,
        "mensaje"  => $mensaje,
        "resultado"=> $resultado
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'GET') {
    // Obtener parámetros por GET
    $op = $_GET["op"] ?? null;
    $a  = isset($_GET["a"]) ? floatval($_GET["a"]) : null;
    $b  = isset($_GET["b"]) ? floatval($_GET["b"]) : null;

} elseif ($metodo === 'POST') {
    // Obtener JSON enviado por POST
    $input = json_decode(file_get_contents("php://input"), true);

    if (!$input) {
        responder(false, "Debes enviar JSON válido");
    }

    $op = $input["op"] ?? null;
    $a  = isset($input["a"]) ? floatval($input["a"]) : null;
    $b  = isset($input["b"]) ? floatval($input["b"]) : null;
}

// Validar parámetros
if (!$op || $a === null || $b === null) {
    responder(false, "Faltan parámetros: 'op', 'a' y 'b'");
}

switch ($op) {
    case "suma":
        $resultado = $a + $b;
        break;

    case "resta":
        $resultado = $a - $b;
        break;

    case "multiplicacion":
        $resultado = $a * $b;
        break;

    case "division":
        if ($b == 0) {
            responder(false, "No se puede dividir entre 0");
        }
        $resultado = $a / $b;
        break;

    default:
        responder(false, "Operación no válida. Use: suma, resta, multiplicacion, division");
}

responder(true, "Operación realizada correctamente", $resultado);