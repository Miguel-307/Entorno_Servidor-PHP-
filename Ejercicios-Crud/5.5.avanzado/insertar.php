<?php
require_once "conexion.php";
require_once "funciones.php";

if ($_POST) {
    insertar_customer($conexion, $_POST);
    header("Location: index.php");
    exit;
}
$empleados = obtener_empleados($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Insertar Cliente</title>
<style>body{font-family:Arial;margin:20px;}</style>
</head>
<body>
<h2>Insertar nuevo cliente</h2>
<form method="post">
    <label>Nombre:</label><input type="text" name="customerName" required><br>
    <label>Apellido contacto:</label><input type="text" name="contactLastName" required><br>
    <label>Nombre contacto:</label><input type="text" name="contactFirstName" required><br>
    <label>Teléfono:</label><input type="text" name="phone" required><br>
    <label>Dirección:</label><input type="text" name="addressLine1" required><br>
    <label>Ciudad:</label><input type="text" name="city" required><br>
    <label>País:</label><input type="text" name="country" required><br>
    <label>Empleado (Sales Rep):</label>
    <select name="salesRepEmployeeNumber">
        <option value="">-- Sin asignar --</option>
        <?php foreach ($empleados as $e): ?>
            <option value="<?= $e['employeeNumber'] ?>"><?= $e['lastName'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <label>Límite de crédito:</label><input type="number" name="creditLimit" step="0.01"><br><br>
    <input type="submit" value="Guardar">
</form>
<a href="index.php">← Volver</a>
</body>
</html>
