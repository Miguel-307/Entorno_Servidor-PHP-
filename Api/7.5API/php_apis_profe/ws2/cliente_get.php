<?php

// URL base del servicio REST (Asumimos que usaremos la versión GET que creaste anteriormente)
// Si usas el servidor POST/JSON, este cliente no funcionará con él.
$url_base_servicio = 'http://localhost/Entorno_servidor/7.5API/php_apis_profe/ws2/calculadora_rest_get.php'; // URL del servidor REST basado en GET

// 1. Definir los parámetros de la operación (Suma: 35 + 8)
$operacion = 'suma';
$num1 = 35;
$num2 = 8;

// 2. Construir la cadena de consulta (query string)
$parametros = http_build_query([
    'operacion' => $operacion,
    'num1'      => $num1,
    'num2'      => $num2
]);

// 3. Construir la URL completa
$url_completa = $url_base_servicio . '?' . $parametros;

// 4. Realizar la Petición
// file_get_contents() es ideal para peticiones GET sin cuerpo
$response = @file_get_contents($url_completa); 

if ($response === false) {
    // Si file_get_contents() falla (ej. servidor caído, DNS error)
    echo "<p>Error al acceder al servicio. Verifique la URL y el estado del servidor.</p>";
    exit;
}

// 5. Procesar la Respuesta
echo "Cuerpo de la respuesta JSON:<br>";
echo "<pre>" . htmlentities($response) . "</pre>";

// Decodificar la respuesta JSON
$datos_respuesta = json_decode($response, true);

if ($datos_respuesta && $datos_respuesta['estado'] === 'ok') {
    echo "Resultado de la operación '$operacion': {$datos_respuesta['resultado']}"; // Debería ser 43
} else if ($datos_respuesta) {
    echo "El servicio reportó un error ({$datos_respuesta['estado']}): {$datos_respuesta['mensaje']}";
} else {
    echo "Respuesta JSON inválida o vacía.";
}

?>