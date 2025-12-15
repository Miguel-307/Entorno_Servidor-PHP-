<?php
require_once "conexion.php";
require_once "funciones.php";

if (!isset($_COOKIE['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_COOKIE['usuario'];


$id = $_GET['id'] ?? null;
if (!$id) die("ID inválido");

$producto = obtener_producto_por_id($conexion, $id);
$proveedores = obtener_proveedores($conexion);
$categorias = obtener_categorias($conexion);

if ($_POST) {
    $_POST['productId'] = $id;
    modificar_producto($conexion, $_POST);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Modificar Producto</title></head>
<body>
<h2>Editar producto #<?= $id ?></h2>
<form method="post">
    <label>Nombre:</label><input type="text" name="productName" value="<?= $producto['productName'] ?>"><br>
    <label>Proveedor:</label>
    <select name="supplierId">
        <?php foreach($proveedores as $s): ?>
            <option value="<?= $s['supplierId'] ?>" <?= ($s['supplierId']==$producto['supplierId'])?'selected':'' ?>>
                <?= $s['companyName'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <label>Categoría:</label>
    <select name="categoryId">
        <?php foreach($categorias as $c): ?>
            <option value="<?= $c['categoryId'] ?>" <?= ($c['categoryId']==$producto['categoryId'])?'selected':'' ?>>
                <?= $c['categoryName'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <label>Cantidad:</label><input type="text" name="quantityPerUnit" value="<?= $producto['quantityPerUnit'] ?>"><br>
    <label>Precio:</label><input type="number" step="0.01" name="unitPrice" value="<?= $producto['unitPrice'] ?>"><br><br>
    <input type="submit" value="Guardar cambios">
</form>
<a href="index.php">← Volver</a>
</body>
</html>
