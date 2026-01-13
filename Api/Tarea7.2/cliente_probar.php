<?php
$url = "http://localhost/Entorno_servidor/Api/Tarea7.2/apartado2_post.php";

// Los datos que queremos enviar
$datosAEnviar = [
    "n1" => 50,
    "n2" => 25,
    "op" => "suma"
];
// Codificamos a JSON para enviarlo
$data_json = json_encode($datosAEnviar);

// Configuración cURL para POST
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true); // Decimos que es POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json); // Metemos el JSON
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json' // Avisamos que enviamos JSON
]);

$response = curl_exec($ch);
curl_close($ch);

echo "Respuesta del servidor: " . $response;
?>