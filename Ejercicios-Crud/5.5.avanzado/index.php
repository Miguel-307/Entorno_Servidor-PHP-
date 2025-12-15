<?php
require_once "conexion.php";
require_once "funciones.php";
$customers = obtener_customers($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Clientes - Classic Models</title>
<style>
body {font-family: Arial; background:#f5f5f5;}
table {width: 95%; margin:20px auto; border-collapse: collapse; background:white;}
th, td {border:1px solid #ccc; padding:8px; text-align:left;}
th {background:#333; color:white;}
a {text-decoration:none; color:#0066cc;}
button {background:#0066cc; color:white; border:none; padding:5px 10px; cursor:pointer; border-radius:4px;}
button:hover {background:#004999;}
.container {text-align:center; margin:20px;}
</style>
</head>
<body>
<div class="container">
    <h1>Gestión de Clientes (Classic Models)</h1>
    <a href="insertar.php"><button>➕ Añadir nuevo cliente</button></a>
</div>
<table>
<tr>
    <th>ID</th><th>Nombre</th><th>Contacto</th><th>Teléfono</th><th>Ciudad</th><th>País</th><th>Empleado</th><th>Crédito</th><th>Acciones</th>
</tr>
<?php foreach ($customers as $c): ?>
<tr>
    <td><?= $c['customerNumber'] ?></td>
    <td><?= htmlspecialchars($c['customerName']) ?></td>
    <td><?= htmlspecialchars($c['contactFirstName'].' '.$c['contactLastName']) ?></td>
    <td><?= htmlspecialchars($c['phone']) ?></td>
    <td><?= htmlspecialchars($c['city']) ?></td>
    <td><?= htmlspecialchars($c['country']) ?></td>
    <td><?= htmlspecialchars($c['lastName'] ?? 'N/A') ?></td>
    <td><?= number_format($c['creditLimit'], 2) ?></td>
    <td>
        <a href="modificar.php?id=<?= $c['customerNumber'] ?>">✏️ Editar</a> |
        <a href="borrar.php?id=<?= $c['customerNumber'] ?>" onclick="return confirm('¿Eliminar este cliente?')">🗑️ Borrar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
