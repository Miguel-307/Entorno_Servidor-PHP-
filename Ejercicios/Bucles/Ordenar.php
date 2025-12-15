<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Variables de ejemplo
$a = 45;
$b = 13;
$c = 99;

// Guardamos los valores en un array
$valores = [$a, $b, $c];

// Ordenamos el array de menor a mayor
sort($valores);

// Mostramos el resultado
echo "Las variables con valor $a, $b y $c ordenadas son: ";
echo implode(" ", $valores);
?>

</body>
</html>