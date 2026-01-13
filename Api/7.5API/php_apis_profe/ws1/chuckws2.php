<?php
// URL del servicio web de Chuck Norris
$url = "https://api.chucknorris.io/jokes/random";

// Obtener el contenido desde la URL
// curl_init + curl_exec + curl_close se reemplaza por file_get_contents
$response = @file_get_contents($url);

if ($response === false) {
    echo "Error al consultar el servicio.";
    exit;
}

// Decodificar JSON
$data = json_decode($response, true);

// Mostrar el chiste
if (isset($data['value'])) {
    echo "Chiste de Chuck Norris:<br>";
    echo $data['value'];
} else {
    echo "No se pudo obtener el chiste.";
}
?>