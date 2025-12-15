
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Línea Aleatoria</title>
</head>
<body>
<?php
/*Creo una variable aleatoria*/
$longitud = rand(100, 1000);
/**Aqui hago que php añada en html un br con la variable aleatoria de antes , la cal cambia los estilos de este */
echo "<hr style='height: 5px;
width: {$longitud}px; 
background-color: black;
border: none;'>"; 
?>
</body>
</html>
