<?php

// 1. Configuración de la Respuesta
// Establecer la cabecera para indicar que la respuesta será JSON.
header('Content-Type: application/json');
// Permitir peticiones desde cualquier origen (CORS) - Útil para desarrollo.
// ¡Considerar restringir esto en producción!
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

// Inicializar el array de respuesta
$respuesta = [
    'estado' => 'error',
    'resultado' => null,
    'mensaje' => ''
];

// 2. Obtener Parámetros de la Petición
// Usaremos el método GET para obtener los parámetros: ?operacion=suma&num1=10&num2=5
$operacion = $_GET['operacion'] ?? null;
$num1 = filter_var($_GET['num1'] ?? null, FILTER_VALIDATE_FLOAT);
$num2 = filter_var($_GET['num2'] ?? null, FILTER_VALIDATE_FLOAT);

// 3. Validación Inicial de Parámetros
if ($operacion === null || $num1 === false || $num2 === false) {
    $respuesta['mensaje'] = 'Parámetros inválidos. Asegúrese de enviar operacion, num1 y num2 como números.';
    http_response_code(400); // Bad Request
    echo json_encode($respuesta);
    exit;
}

// 4. Lógica de las Operaciones
$calculo_exitoso = true;
$resultado_calculo = 0;

switch ($operacion) {
    case 'suma':
        $resultado_calculo = $num1 + $num2;
        break;
    case 'resta':
        $resultado_calculo = $num1 - $num2;
        break;
    case 'multiplicacion':
        $resultado_calculo = $num1 * $num2;
        break;
    case 'division':
        if ($num2 == 0) {
            $respuesta['mensaje'] = 'Error: División por cero no permitida.';
            $calculo_exitoso = false;
            http_response_code(400); // Bad Request
        } else {
            $resultado_calculo = $num1 / $num2;
        }
        break;
    default:
        $respuesta['mensaje'] = "Operación '$operacion' no reconocida. Use: suma, resta, multiplicacion o division.";
        $calculo_exitoso = false;
        http_response_code(400); // Bad Request
        break;
}

// 5. Preparación y Envío de la Respuesta Final
if ($calculo_exitoso) {
    $respuesta['estado'] = 'ok';
    $respuesta['resultado'] = $resultado_calculo;
    $respuesta['mensaje'] = 'Cálculo realizado exitosamente.';
    http_response_code(200); // OK
}

// Imprimir la respuesta como JSON
echo json_encode($respuesta);
?>