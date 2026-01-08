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
        $resultado = "";
        
        // URL base de servidor local
        $baseUrl = "http://localhost/Entorno_Servidor-PHP-/7.5API/Ejercicio1/"; 

        if ($tipo == 'CalculoC-F') {
            $resultado = file_get_contents("$baseUrl/CalculoC-F.php?valor=$numero") . " ºF";
        } else {

            $resultado = file_get_contents("$baseUrl/CalculoF-C.php?valor=$numero") . " ºC";
        }

        echo "<h3>Resultado: $resultado</h3>";
    }
    ?>
</body>
</html>