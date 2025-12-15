<html>
    <head>
    </head>
    <body>
        <h1>Definicion  </h1>
<?php
$num1=1;
$num2=2;
$decimal=2.1;
/* Aqui pongo lso numero*/
echo "Numero 1 = " . $num1 ;
echo "<br> Numero 2 = " .$num2 ;
echo "<br>Decimal = " . $decimal;

echo "<h1>Operacion con enteros </h1>";
/*Aqui los sumo*/
$suma = $num1 + $num2;
echo "<br> Suma de numero 1 y 2 = " .$suma;
/*Aqui los resta*/
$resta = $num1 - $num2;
echo "<br> resta de numero 1 y 2 = " .$resta;
/*Aqui los división */
$dividir = $num2 / $num1;
echo "<br> division de numero 1 y 2 = " .$dividir;
/*Aqui los multiplicación*/
$multiplicacion = $num1 * $num2;
echo "<br> multipliucacion  de numero 1 y 2 = " .$multiplicacion;
/*Aqui los potencia */
$potencia = $num1 ** $num2;
echo "<br> potencia de numero 1 y 2 = " .$potencia;
/*Aqui los módulo */
$modulo = $num1 ** $num2;
echo "<br> modulo de numero 1 y 2 = " .$modulo;



echo "<br> <h1> Parte decimal </h1>";
/*Decimal*/
/*Aqui los sumo*/
$suma2 = $num1 + $decimal;
echo "<br> Suma de numero 1 y decimal = " .$suma2;
/*Aqui los resta*/
$resta2 = $num1 - $decimal;
echo "<br> resta de numero 1 y decimal= " .$resta2;
/*Aqui los división */
$dividir2 = $decimal / $num1;
echo "<br> division de numero 1 y decimal = " .$dividir2;
/*Aqui los multiplicación*/
$multiplicacion2 = $num1 * $decimal;
echo "<br> multipliucacion  de numero 1 y decimal = " .$multiplicacion2;
/*Aqui los potencia */
$potencia2 = $num1 ** $decimal;
echo "<br> potencia de numero 1 y decimal = " .$potencia2;
/*Aqui los módulo */
$modulo2 = $num1 ** $decimal;
echo "<br> modulo de numero 1 y decimal = " .$modulo2;
?>
    </body>
</html>
