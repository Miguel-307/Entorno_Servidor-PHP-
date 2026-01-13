<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 7.5.1</title>
</head>
<body>
    <h1>Conversor de Temperatura</h1>
    
    <form method="POST" action="">
        <label>Introduce el valor:</label>
        <input type="number" step="any" name="numero" required>
        <br><br>
        
        <label>Tipo de conversión:</label>
        <select name="conversion">
            <option value="CalculoC-F">Celsius a Fahrenheit</option>
            <option value="CalculoF-C">Fahrenheit a Celsius</option>
        </select>
        <br><br>
        
        <button type="submit">Convertir</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numero = $_POST['numero'];
        $tipo = $_POST['conversion'];
        
       
        $protocolo = "http://"; 
        $servidor = $_SERVER['HTTP_HOST'];
        $ruta = dirname($_SERVER['PHP_SELF']);
        
        
        $baseUrl = $protocolo . $servidor . $ruta; 

        // Preparar la llamada
        $archivo = ($tipo == 'CalculoC-F') ? 'CalculoC-F.php' : 'CalculoF-C.php';
        $urlDestino = "$baseUrl/$archivo?valor=" . urlencode($numero);

        // Usar @ para evitar warnings feos y comprobar si funcionó
        $respuesta = @file_get_contents($urlDestino);

        echo "<h3>Resultado: ";
        
        if ($respuesta === FALSE) {
            echo "<p>Error: No se pudo conectar con $urlDestino. <br>Revisa que el archivo exista y que 'allow_url_fopen' esté activo en php.ini.</p>";
        } else {
            // Añadimos la unidad solo si la conversión fue exitosa
            $unidad = ($tipo == 'CalculoC-F') ? "ºF" : "ºC";
            echo $respuesta . " " . $unidad;
        }
        echo "</h3>";
    }
    ?>
</body>
</html>