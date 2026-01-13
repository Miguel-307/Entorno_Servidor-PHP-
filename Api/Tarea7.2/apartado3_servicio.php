<?php
header('Content-Type: application/json');

$precio = 0;
$descuento = 0;
$producto = "Producto desconocido";

// DETECTAR EL MÉTODO
$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo == 'GET') {
    // Si es GET, leemos de la URL
    $precio = $_GET['precio'] ?? 0;
    $descuento = $_GET['dto'] ?? 0;
    $producto = $_GET['prod'] ?? 'Bocadillo genérico';

} elseif ($metodo == 'POST') {
    // Si es POST, leemos el JSON del cuerpo
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    $precio = $data['precio'] ?? 0;
    $descuento = $data['dto'] ?? 0;
    $producto = $data['prod'] ?? 'Bocadillo genérico';
}

// CÁLCULO
$precioFinal = $precio - ($precio * ($descuento / 100));

// RESPUESTA
echo json_encode([
    "mensaje" => "Cálculo realizado con éxito",
    "ticket" => [
        "producto" => $producto,
        "precio_original" => $precio,
        "descuento_aplicado" => $descuento . "%",
        "precio_final" => $precioFinal
    ],
    "metodo_usado" => $metodo // Para que veas por dónde entró
]);
?>