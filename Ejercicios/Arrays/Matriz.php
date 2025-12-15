<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Matriz en tabla</title>
</head>
<body>
    <?php
    $matriz = [
        [1, 14, 8, 3],
        [6, 19, 7, 2],
        [3, 13, 4, 1]
    ];

    echo "<table>";
    foreach ($matriz as $fila) {
        echo "<tr>";
        foreach ($fila as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>
</html>
