<?php
$url_servicio = "http://localhost/apartado3_servicio.php"; 

$datos_viaje = [
    "distancia" => 500,  
    "consumo" => 6.5,    
    "precio" => 1.60     
];

$ch = curl_init($url_servicio);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_POST, true);           
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos_viaje)); 
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($datos_viaje))
]);


$respuesta = curl_exec($ch);


if (curl_errno($ch)) {
    echo 'Error en cURL: ' . curl_error($ch);
} else {

    $datos_respuesta = json_decode($respuesta, true);
    
    echo "--- RESPUESTA DEL SERVIDOR ---\n";
    echo "Coste del viaje: " . $datos_respuesta['coste_total'] . "\n";
    echo "Litros consumidos: " . $datos_respuesta['litros_totales'] . "\n";
    echo "Método detectado por el servidor: " . $datos_respuesta['metodo_usado'] . "\n";
}


curl_close($ch);
?>