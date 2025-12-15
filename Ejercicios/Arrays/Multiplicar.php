
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de Multiplicar</title>
</head>
<body>

    <h1 style="text-align:center;">Tablas de Multiplicar del 0 al 10</h1>

    <?php
$tablas = [];
for ($i = 0; $i <= 10; $i++) {
    $tabla = [];
    for ($j = 0; $j <= 10; $j++) {
        $tabla[$j] = $i * $j;
    }
    $tablas[$i] = $tabla;
}
    for ($i = 0; $i <= 10; $i++) {
        echo "<table>";
        echo "<caption>Tabla del $i</caption>";
        echo "<tr><th>Multiplicando</th><th>Resultado</th></tr>";
        for ($j = 0; $j <= 10; $j++) {
            echo "<tr><td>$i x $j</td><td>" . $tablas[$i][$j] . "</td></tr>";
        }
        echo "</table>";
    }
    ?>

</body>
</html>
