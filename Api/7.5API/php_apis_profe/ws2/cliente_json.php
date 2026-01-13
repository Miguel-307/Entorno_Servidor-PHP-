<?php

// URL del servicio REST de calculadora (Servidor: calculadora_rest_post.php)
$url_servicio = 'http://localhost/Entorno_servidor/7.5API/php_apis_profe/ws2/calculadora_rest_json.php'; // ¡Verifica esta URL!

$datos_a_enviar = [
    'op' => 'resta',
    'a'      => 45,
    'b'      => 12
];

// Convertir los datos a formato JSON
$json_payload = json_encode($datos_a_enviar);

// Aquí es donde definimos el método, las cabeceras y el contenido (body).
$opciones = [
    'http' => [
        'method'        => 'POST',
        // Cabeceras necesarias para un cuerpo JSON
        'header'        => 'Content-Type: application/json' . "\r\n" .
                           'Content-Length: ' . strlen($json_payload) . "\r\n",
        // El cuerpo de la petición
        'content'       => $json_payload,
        // Ignorar errores HTTP para obtener el cuerpo de la respuesta incluso si el código es 4xx o 5xx
        'ignore_errors' => true 
    ]
];

// Crear el contexto
$contexto = stream_context_create($opciones);


// La función realiza la petición POST y obtiene la respuesta del cuerpo
$response = @file_get_contents($url_servicio, false, $contexto);

if ($response === false) {
    echo "<p>Error al acceder al servicio. Verifique la URL y el servidor.</p>";
    exit;
}

// Obtener las cabeceras de la respuesta para el código HTTP
$cabeceras = $http_response_header;
$http_code = 0;

// Buscar el código HTTP en la primera cabecera (ej: HTTP/1.1 200 OK)
if (is_array($cabeceras) && !empty($cabeceras)) {
    preg_match('{HTTP\/\S+\s(\d{3})}', $cabeceras[0], $match);
    $http_code = $match[1] ?? 0;
}

echo "Código HTTP de respuesta: $http_code\n";
echo "Cuerpo de la respuesta JSON:\n";
echo "<pre>" . htmlentities($response) . "</pre>";

// Decodificar la respuesta JSON
$datos_respuesta = json_decode($response, true);

if ($datos_respuesta && $datos_respuesta['estado'] === true) {
    echo "<p>Resultado de la operación '{$datos_a_enviar['op']}': {$datos_respuesta['resultado']}</p>"; // Debería ser 32.5
} else if ($datos_respuesta) {
    echo "<p>El servicio reportó un error ({$datos_respuesta['estado']}): {$datos_respuesta['mensaje']}</p>";
} else {
    echo "<p>Respuesta JSON inválida.</p>";
}

?>