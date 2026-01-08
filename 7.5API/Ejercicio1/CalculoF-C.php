<?php
// Recibe grados Fahrenheit y devuelve Celsius
if (isset($_GET['valor'])) {
    $f = floatval($_GET['valor']);
    $c = ($f - 32) * 5/9;
    echo $c;
}
?>