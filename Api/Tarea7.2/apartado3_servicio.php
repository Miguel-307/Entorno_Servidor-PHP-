<?php
header('Content-Type: application/json');
$distancia = null; 
$consumo = null;   
$precio = null;    


$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'GET') {

    $distancia = $_GET['distancia'] ?? null;
    $consumo = $_GET['consumo'] ?? null;
    $precio = $_GET['precio'] ?? null;

} elseif ($metodo === 'POST') {

    $json = file_get_contents('php://input');
    $datos = json_decode($json, true);
    
    $distancia = $datos['distancia'] ?? null;
    $consumo = $datos['consumo'] ?? null;
    $precio = $datos['precio'] ?? null;
}


if ($distancia && $consumo && $precio) {

    $litrosNecesarios = ($distancia / 100) * $consumo;
    $costeTotal = $litrosNecesarios * $precio;

    echo json_encode([
        "mensaje" => "Cálculo realizado con éxito",
        "metodo_usado" => $metodo,
        "litros_totales" => round($litrosNecesarios, 2) . " L",
        "coste_total" => round($costeTotal, 2) . " €"
    ]);
} else {
    echo json_encode([
        "error" => "Datos incompletos",
        "nota" => "Se requiere: distancia (km), consumo (l/100km) y precio (€/l)"
    ]);
}
?>