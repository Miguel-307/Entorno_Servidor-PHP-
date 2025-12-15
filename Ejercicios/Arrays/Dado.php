<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$dado = rand(1, 6);

$letras = [
    1 => 'Uno',
    2 => 'Dos',
    3 => 'Tres',
    4 => 'Cuatro',
    5 => 'Cinco',
    6 => 'Seis'
];
echo '<p>Has sacado un ' . $letras[$dado] . '.</p>';
echo '<img src="img/dado' . $dado . '.png" alt="Dado ' . $dado . '" style="width:100px;">';




?>

</body>
</html>