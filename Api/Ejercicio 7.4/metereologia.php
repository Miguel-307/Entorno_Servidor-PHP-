<?php

// CONFIGURACIÓN INICIAL


$ciudadBusqueda = "San Pedro Alcantara";

if (isset($_GET['ciudad']) && !empty($_GET['ciudad'])) {
    $ciudadBusqueda = htmlspecialchars($_GET['ciudad']);
}

// FUNCIONES 


function obtenerIcono($codigo) {
    switch ($codigo) {
        case 0: return "☀️"; 
        case 1: case 2: case 3: return "Nuboso⛅"; 
        case 45: case 48: return "Niebla🌫️"; 
        case 51: case 53: case 55: return "Llovizna🌧️"; 
        case 61: case 63: case 65: return "Lluvia ☔";  
        case 71: case 73: case 75: return "Nieve ❄️";  
        case 95: case 96: case 99: return "Tormenta ⛈️";  
        default: return "❓";
    }
}


// OBTENER DATOS (API)


$urlGeo = "https://geocoding-api.open-meteo.com/v1/search?name=" . urlencode($ciudadBusqueda) . "&count=1&language=es&format=json";
$jsonGeo = @file_get_contents($urlGeo); 
$datosGeo = json_decode($jsonGeo, true);

$error = null;
$datosClima = null;

if (isset($datosGeo['results']) && count($datosGeo['results']) > 0) {
    $lat = $datosGeo['results'][0]['latitude'];
    $lon = $datosGeo['results'][0]['longitude'];
    $nombreOficial = $datosGeo['results'][0]['name'];
    $pais = $datosGeo['results'][0]['country'];

    $urlClima = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&daily=weathercode,temperature_2m_max,temperature_2m_min&timezone=auto";
    $jsonClima = @file_get_contents($urlClima);
    $datosClima = json_decode($jsonClima, true);
} else {
    $error = "No hemos encontrado la localidad: $ciudadBusqueda";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>El Tiempo</title>

</head>
<body>

<div >
    
    <div >
        <form method="GET" action="">
            <input type="text" name="ciudad" placeholder="Ej: Madrid, Paris, Londres..." required>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <?php if ($error): ?>
        <p ><?php echo $error; ?></p>
    <?php elseif ($datosClima): ?>
        
        <div>
            <h1>El Tiempo en <?php echo $nombreOficial; ?> <?php echo obtenerIcono($datosClima['daily']['weathercode'][0]); ?></h1>
            <p><strong>Ubicación:</strong> <?php echo $pais; ?></p>
            <p>
                Máx: <strong><?php echo $datosClima['daily']['temperature_2m_max'][0]; ?>°C</strong> 
                Mín: <strong><?php echo $datosClima['daily']['temperature_2m_min'][0]; ?>°C</strong>
            </p>
        </div>

        <hr>

        <h3>Previsión a 7 días</h3>
        <div >
            <?php 
            // Bucle del 1 al 6 (Próximos días)
            for ($i = 1; $i < 7; $i++) { 
                $fechaOriginal = $datosClima['daily']['time'][$i];
                $codigo = $datosClima['daily']['weathercode'][$i];
                $max = $datosClima['daily']['temperature_2m_max'][$i];
                $min = $datosClima['daily']['temperature_2m_min'][$i];
                echo "<br>";
                echo "<hr>";

                // 1. Formateamos la fecha (ej: 18/12)
                $fechaCorta = date("d/m", strtotime($fechaOriginal));

                // 2. Lógica para poner "Mañana"
                if ($i == 1) {
                    // Si es la primera vuelta del bucle, es Mañana
                    $textoCabecera = "Mañana <br> $fechaCorta";
                } else {
                    // Si no, ponemos solo la fecha
                    $textoCabecera = $fechaCorta;
                }
            ?>
                <div class="dia-card">
                    <div style="margin-bottom:5px;"><?php echo $textoCabecera; ?></div>
                    
                    <span class="icono"><?php echo obtenerIcono($codigo); ?></span>
                    <small><?php echo $max; ?>° / <?php echo $min; ?>°</small>
                </div>
            <?php } ?>
        </div>

    <?php endif; ?> </div> </body>
</html>