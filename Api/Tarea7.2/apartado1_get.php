<?php
// Indicamos que vamos a devolver JSON (como la API de Chuck Norris)
header('Content-Type: application/json');

// 1. Recogemos los datos de la URL (ej: ?n1=10&n2=5&op=suma)
$n1 = $_GET['n1'] ?? 0; // Si no hay dato, usamos 0
$n2 = $_GET['n2'] ?? 0;
$operacion = $_GET['op'] ?? 'suma';
$resultado = 0;

// 2. Hacemos el cálculo
switch($operacion) {
    case 'suma': $resultado = $n1 + $n2; break;
    case 'resta': $resultado = $n1 - $n2; break;
    case 'multi': $resultado = $n1 * $n2; break;
    case 'div': 
        $resultado = ($n2 != 0) ? $n1 / $n2 : 'Error: División por cero'; 
        break;
    default: $resultado = 'Operación no válida'; break;
}

// 3. Devolvemos la respuesta en JSON
echo json_encode([
    "operacion" => $operacion,
    "resultado" => $resultado
]);
?>