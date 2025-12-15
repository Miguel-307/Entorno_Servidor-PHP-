<?php
require_once "conexion.php";
require_once "funciones.php";
if (!isset($_COOKIE['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_COOKIE['usuario'];


if ($_POST) {
    insertar_producto($conexion, $_POST);
    header("Location: index.php");
    exit;
}

$proveedores = obtener_proveedores($conexion);
$categorias = obtener_categorias($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Insertar Producto</title></head>
<body>
<h2>Insertar nuevo producto</h2>
<form method="post">
    <label>Nombre:</label><input type="text" name="productName" required><br>
    <label>Proveedor:</label>
    <select name="supplierId">
        <option value="">--Seleccione--</option>
        <?php foreach($proveedores as $s): ?>
            <option value="<?= $s['supplierId'] ?>"><?= $s['companyName'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <label>Categoría:</label>
    <select name="categoryId">
        <option value="">--Seleccione--</option>
        <?php foreach($categorias as $c): ?>
            <option value="<?= $c['categoryId'] ?>"><?= $c['categoryName'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <label>Cantidad:</label><input type="text" name="quantityPerUnit"><br>
    <label>Precio:</label><input type="number" name="unitPrice" step="0.01"><br><br>
    <input type="submit" value="Guardar">
</form>
<a href="index.php">← Volver</a>
</body>
</html>
