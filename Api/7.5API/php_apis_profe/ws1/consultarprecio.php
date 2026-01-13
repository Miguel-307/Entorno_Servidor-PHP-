<?php
$apiKey = 'xxx';   // ← pon aquí tu API key
$commodity = 'micro_gold';           // Ejemplo: gold, crude_oil, platinum, etc.

$url = 'https://api.api-ninjas.com/v1/commodityprice?name=' . urlencode($commodity);

// Construimos contexto HTTP con el header X-Api-Key
$context = stream_context_create([
    'http' => [
        'method'  => 'GET',
        'header'  => "X-Api-Key: $apiKey\r\n" .
                     "Accept: application/json\r\n",
        'timeout' => 10
    ]
]);

// Hacemos la llamada
$response = @file_get_contents($url, false, $context);

// Comprobamos errores
if ($response === FALSE) {
    echo "Error al consultar el servicio.\n";
    exit;
}

// Convertimos la respuesta JSON en array
$data = json_decode($response, true);

// Mostramos el resultado
if (isset($data['price'])) {
    echo "Commodity: " . $data['name'] . "\n";
    echo "Exchange: " . $data['exchange'] . "\n";
    echo "Price (USD): " . $data['price'] . "\n";
    echo "Updated: " . date('Y-m-d H:i:s', $data['updated']) . "\n";
} else {
    echo "Respuesta inesperada:\n";
    print_r($data);
}
