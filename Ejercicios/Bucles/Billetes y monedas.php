<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Matriz en tabla</title>
</head>
<body>
    <?php
$num=rand(1000,2000);
$billetes=array(500,200,100,50,20,10,5);
$monedas=array(2,1);
$tabla=array($billetes,$monedas);
echo "<h1>Desglose de $num euros</h1>";
    echo"<h2>Billetes y monedas</h2>";
for($i=0;$i<count($tabla);$i++){

    echo "<table border='1'>";
    
    for($j=0;$j<count($tabla[$i]);$j++){
        $cantidad=intval($num/$tabla[$i][$j]);
        $num-=$cantidad*$tabla[$i][$j];
        echo "<tr><td>".$tabla[$i][$j]." euros</td><td>$cantidad</td></tr>";
    }
    echo "</table><br>";
}

    ?>
</body>
</html>
