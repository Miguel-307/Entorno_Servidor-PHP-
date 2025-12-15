<?php
require_once "conexion.php";
require_once "funciones.php";
$id = $_GET['id'] ?? null;
if (!$id) { die("ID inválido"); }

$customer = obtener_customer_por_id($conexion, $id);
$empleados = obtener_empleados($conexion);

if ($_POST) {
    $_POST['customerNumber'] = $id;
    modificar_customer($conexion, $_POST);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Modificar cliente</title></head>
<body>
<h2>Editar cliente #<?= $id ?></h2>
<form method="post">
    <label>Nombre:</label><input type="text" name="customerName" value="<?= $customer['customerName'] ?>"><br>
    <label>Apellido contacto:</label><input type="text" name="contactLastName" value="<?= $customer['contactLastName'] ?>"><br>
    <label>Nombre contacto:</label><input type="text" name="contactFirstName" value="<?= $customer['contactFirstName'] ?>"><br>
    <label>Teléfono:</label><input type="text" name="phone" value="<?= $customer['phone'] ?>"><br>
    <label>Dirección:</label><input type="text" name="addressLine1" value="<?= $customer['addressLine1'] ?>"><br>
    <label>Ciudad:</label><input type="text" name="city" value="<?= $customer['city'] ?>"><br>
    <label>País:</label><input type="text" name="country" value="<?= $customer['country'] ?>"><br>
    <label>Empleado (Sales Rep):</label>
    <select name="salesRepEmployeeNumber">
        <option value="">-- Sin asignar --</option>
        <?php foreach ($empleados as $e): ?>
            <option value="<?= $e['employeeNumber'] ?>" <?= ($e['employeeNumber']==$customer['salesRepEmployeeNumber'])?'selected':'' ?>>
                <?= $e['lastName'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <label>Límite de crédito:</label><input type="number" step="0.01" name="creditLimit" value="<?= $customer['creditLimit'] ?>"><br><br>
    <input type="submit" value="Guardar cambios">
</form>
<a href="index.php">← Volver</a>
</body>
</html>
