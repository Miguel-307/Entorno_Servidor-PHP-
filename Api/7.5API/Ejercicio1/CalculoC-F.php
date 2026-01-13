<?php
// Recibe grados Celsius y devuelve Fahrenheit
if (isset($_GET['valor'])) {
    $c = floatval($_GET['valor']);
    $f = ($c * 9/5) + 32;
    echo $f;
}
?>