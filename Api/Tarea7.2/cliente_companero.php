<?php
// URL DEL COMPAÑERO (Cambia localhost por la IP de tu compañero si estáis en red)
$url = "http://localhost/Entorno_servidor/Api/Tarea7.2/apartado3_servicio.php";

echo "--- PRUEBA 1: Enviando por POST (JSON) ---\n<br>";

// Datos para pedir tu merienda favorita
$datosPedido = [
    "prod" => "Bocadillo de Salchichón",
    "precio" => 4.50,
    "dto" => 10 // 10% de descuento por cliente VIP
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datosPedido));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$respuesta = curl_exec($ch);
curl_close($ch);

// Mostramos lo que respondió tu servidor
$json = json_decode($respuesta, true);
echo "Producto: " . $json['ticket']['producto'] . "<br>";
echo "Precio Final: " . $json['ticket']['precio_final'] . " €<br>";
echo "Método detectado: " . $json['metodo_usado'] . "<br><br>";


echo "--- PRUEBA 2: Enviando por GET (URL) ---\n<br>";
// Aquí probamos enviando datos simples en la URL
$urlGet = $url . "?prod=Agua&precio=1.00&dto=0";
$respuestaGet = file_get_contents($urlGet);

echo "Respuesta cruda del servidor: " . $respuestaGet;
?>