<?php
require_once "conexion.php";
require_once "funciones.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$productos = obtener_productos($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Productos - Northwind</title>
<style>
body {font-family:Arial;background:#f4f4f4;}
header {background:#333;color:#fff;padding:10px;text-align:right;}
header span {float:left;font-weight:bold;}
table {width:95%;margin:20px auto;border-collapse:collapse;background:white;}
th,td {border:1px solid #ccc;padding:8px;text-align:left;}
th {background:#007bff;color:white;}
a {color:#007bff;text-decoration:none;}
button {background:#007bff;color:white;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;}
button:hover {background:#0056b3;}
</style>
</head>
<body>
<header>
    <span>👤 Usuario: <?= $_SESSION['usuario'] ?></span>
    <a href="logout.php" style="color:white;">Cerrar sesión</a>
</header>
<h2 style="text-align:center;">Gestión de Productos (Northwind)</h2>
<div style="text-align:center;"><a href="insertar.php"><button>➕ Nuevo producto</button></a></div>
<table>
<tr>
    <th>ID</th><th>Producto</th><th>Categoría</th><th>Proveedor</th><th>Cantidad</th><th>Precio</th><th>Acciones</th>
</tr>
<?php foreach ($productos as $p): ?>
<tr>
    <td><?= $p['productId'] ?></td>
    <td><?= htmlspecialchars($p['productName']) ?></td>
    <td><?= htmlspecialchars($p['categoryName']) ?></td>
    <td><?= htmlspecialchars($p['companyName']) ?></td>
    <td><?= htmlspecialchars($p['quantityPerUnit']) ?></td>
    <td><?= number_format($p['unitPrice'], 2) ?></td>
    <td>
        <a href="modificar.php?id=<?= $p['productId'] ?>">✏️ Editar</a> |
        <a href="borrar.php?id=<?= $p['productId'] ?>" onclick="return confirm('¿Eliminar este producto?')">🗑️ Borrar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
