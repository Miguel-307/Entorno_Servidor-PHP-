<?php

setcookie("cookie1", "valor1");
setcookie("cookie2", "valor2");
setcookie("cookie3", "valor3");

echo "<h2>Cookies creadas:</h2>";
echo "Cookie 1: " . $_COOKIE["cookie1"] . "<br>";
echo "Cookie 2: " . $_COOKIE["cookie2"] . "<br>";
echo "Cookie 3: " . $_COOKIE["cookie3"] . "<br>";
?>
