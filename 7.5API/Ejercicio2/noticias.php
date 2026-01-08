<?php
$apiKey = '1bed68c18bb84beeaf70e6d8cc927e69'; 
$baseUrl = 'https://newsapi.org/v2';

// Función para llamar a la API
function obtenerDatos($url) {
    $opciones = [
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: MiScriptPHP/1.0\r\n"
        ]
    ];
    $contexto = stream_context_create($opciones);
    $response = file_get_contents($url, false, $contexto);
    return json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 7.5.2 NewsAPI</title>
</head>
<body>
    <h1>Consultar NewsAPI</h1>
    
    <form method="GET">
        <label>Selecciona qué quieres ver:</label>
        <select name="endpoint">
            <option value="everything">Todo (Everything - Tecnología)</option>
            <option value="top-headlines">Cabeceras (Top Headlines - US)</option>
            <option value="sources">Orígenes (Sources)</option>
        </select>
        <button type="submit">Consultar</button>
    </form>
    
    <hr>

    <?php
    if (isset($_GET['endpoint'])) {
        $endpoint = $_GET['endpoint'];
        $url = "";
        
        switch ($endpoint) {
            case 'everything':
                $url = "$baseUrl/everything?q=tecnologia&apiKey=$apiKey";
                break;
            case 'top-headlines':
                $url = "$baseUrl/top-headlines?country=us&apiKey=$apiKey";
                break;
            case 'sources':
                $url = "$baseUrl/top-headlines/sources?apiKey=$apiKey";
                break;
        }

        $data = obtenerDatos($url);

        // Procesar y mostrar la información
        if ($data && $data['status'] == 'ok') {
            

            if (isset($data['articles'])) {
                echo "<h2>Noticias Encontradas: " . count($data['articles']) . "</h2>";
                foreach ($data['articles'] as $noticia) {
                    echo "<div>";
                    echo "<h3>" . $noticia['title'] . "</h3>";
                    echo "<p><strong>Fuente:</strong> " . $noticia['source']['name'] . "</p>";
                    echo "<p>" . $noticia['description'] . "</p>";
                    echo "<a href='" . $noticia['url'] . "' target='_blank'>Leer más</a>";
                    echo "</div><hr>";
                }
            } 
            // Caso para Fuentes (Sources tiene estructura diferente)
            elseif (isset($data['sources'])) {
                echo "<h2>Fuentes Encontradas</h2>";
                foreach ($data['sources'] as $fuente) {
                    echo "<div>";
                    echo "<h3>" . $fuente['name'] . "</h3>";
                    echo "<p>" . $fuente['description'] . "</p>";
                    echo "<a href='" . $fuente['url'] . "' target='_blank'>Ir a la web</a>";
                    echo "</div><hr>";
                }
            }

        } else {
            echo "<p>Error al obtener datos o API Key inválida.</p>";
        }
    }
    ?>
</body>
</html>