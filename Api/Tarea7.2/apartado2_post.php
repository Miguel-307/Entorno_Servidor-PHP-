<?php
header('Content-Type: application/json');

// 1. LEER EL JSON ENTRANTE (Esta es la clave del ejercicio)
// php://input lee el cuerpo crudo de la petición
$jsonRecibido = file_get_contents('php://input');

// 2. Convertir JSON a Array de PHP
$data = json_decode($jsonRecibido, true);

// Verificamos que llegaron los datos
if (!isset($data['n1']) || !isset($data['n2'])) {
    echo json_encode(["error" => "Faltan datos"]);
    exit;
}

$n1 = $data['n1'];
$n2 = $data['n2'];
$op = $data['op'] ?? 'suma';
$resultado = 0;

// 3. Lógica (igual que antes)
if ($op == 'suma') $resultado = $n1 + $n2;
elseif ($op == 'resta') $resultado = $n1 - $n2;
// ... puedes añadir más

echo json_encode(["resultado" => $resultado]);
?>