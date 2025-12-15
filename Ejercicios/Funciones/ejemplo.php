<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicios PHP</title>
</head>
<body>
<h1>Ejercicios en PHP</h1>

<?php

function importeConIVA(float $cantidad, float $iva = 21): float {
    return $cantidad + ($cantidad * $iva / 100);
}

function incremento10(float $importe): float {
    return $importe + ($importe * 0.10);
}


function aplicarDescuento(float $importe): float {
    if ($importe < 100) {
        return $importe; 
    } elseif ($importe < 500) {
        return $importe - ($importe * 0.10); 
    } else {
        return $importe - ($importe * 0.15); 
    }
}

function mostrarFechas(): void {

    echo "<p><strong>Formato 1:</strong> " . date("d/m/y H:i:s") . "</p>";

    echo "<p><strong>Formato 2:</strong> Son las " . date("H:i:s") .
         " y hoy es " . date("d-m-Y") . "</p>";
}


function Truncar(float $numero): int {
    return intval($numero); }
?>


<h2>1. Calcular importe con IVA e incremento</h2>
<form method="post">
    Cantidad (€): <input type="number" name="cantidad" step="0.01" required>
    IVA (%): <input type="number" name="iva" step="0.01" value="21">
    <button type="submit" name="calc_iva">Calcular</button>
</form>

<?php
if (isset($_POST['calc_iva'])) {
    $cantidad = floatval($_POST['cantidad']);
    $iva = $_POST['iva'] === "" ? 21 : floatval($_POST['iva']);

    echo "<p>Importe con IVA ($iva%): <strong>" . importeConIVA($cantidad, $iva) . " €</strong></p>";
    echo "<p>Importe con incremento del 10%: <strong>" . incremento10($cantidad) . " €</strong></p>";
}
?>

<hr>

<h2>2. Descuento según importe de compra</h2>
<form method="post">
    Importe de compra (€): <input type="number" name="importe" step="0.01" required>
    <button type="submit" name="calc_descuento">Aplicar descuento</button>
</form>

<?php
if (isset($_POST['calc_descuento'])) {
    $importe = floatval($_POST['importe']);
    echo "<p>Importe final con descuento: <strong>" . aplicarDescuento($importe) . " €</strong></p>";
}
?>

<hr>

<h2>3. Fecha y hora actuales</h2>
<?php mostrarFechas(); ?>

<hr>

<h2>4. Truncar número decimal</h2>
<form method="post">
    Número decimal: <input type="number" name="decimal" step="0.01" required>
    <button type="submit" name="calc_truncar">Truncar</button>
</form>

<?php
if (isset($_POST['calc_truncar'])) {
    $decimal = floatval($_POST['decimal']);
    echo "<p>Parte entera: <strong>" . Truncar($decimal) . "</strong></p>";
}
?>

</body>
</html>
