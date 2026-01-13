<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea 7.1 - Consumo API</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .producto { background: white; padding: 15px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ddd; width:auto ; }
        h1 { color: #333; }
        strong { color: #d9534f; }
    </style>
</head>
<body>

    <?php
    $termino_busqueda = "lentejas"; 
    ?>

    <h1>Buscador de Productos (Open Food Facts)</h1>
    
    <h3>Resultados para: <?php echo ucfirst($termino_busqueda); ?></h3>

    <?php
    // 1. Definimos la URL del servicio (API)

    $url = "https://es.openfoodfacts.org/cgi/search.pl?search_terms=" . urlencode($termino_busqueda) . "&search_simple=1&action=process&json=1";

    // 2. Realizamos la conexión y obtenemos los datos
    $json_data = file_get_contents($url);

    // 3. Verificamos si hemos recibido datos
    if ($json_data !== false) {
        
        // 4. Decodificamos el JSON

        $datos = json_decode($json_data);

        // Comprobamos si hay productos

        if (!empty($datos->products)) {
            
            $max_productos = 3;
            
            for ($i = 0; $i < $max_productos; $i++) {
                // Verificamos que exista el producto antes de intentar leerlo

                if (isset($datos->products[$i])) {
                    $producto = $datos->products[$i];

                    $nombre = isset($producto->product_name) ? $producto->product_name : "Nombre desconocido";
                    $marca = isset($producto->brands) ? $producto->brands : "Marca desconocida";
                    $imagen = isset($producto->image_small_url) ? $producto->image_small_url : "";

                    // 5. Mostramos la información

                    echo "<div class='producto'>";
                    echo "<h2>" . ($i + 1) . ". " . $nombre . "</h2>";
                    echo "<p><strong>Marca:</strong> " . $marca . "</p>";
                    
                    if($imagen != "") {
                        echo "<img src='$imagen' alt='$nombre'>";
                    }
                    echo "</div>";
                }
            }

        } else {
            echo "<p>No se encontraron productos para: <strong>$termino_busqueda</strong>.</p>";
        }

    } else {
        echo "<p>Error: No se pudo conectar con el servicio web.</p>";
    }
    ?>

</body>
</html>