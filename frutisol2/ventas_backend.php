<?php
include 'conexion.php';

$where = [];
$params = [];

// Filtros "empieza por" (LIKE 'valor%')
if (!empty($_GET['factura'])) {
    $where[] = "v.id_factura LIKE :factura";
    $params[':factura'] = $_GET['factura'] . "%";
}
if (!empty($_GET['empleado'])) {
    $where[] = "e.nombre LIKE :empleado";
    $params[':empleado'] = $_GET['empleado'] . "%";
}
if (!empty($_GET['cliente'])) {
    $where[] = "c.nombre LIKE :cliente";
    $params[':cliente'] = $_GET['cliente'] . "%";
}
if (!empty($_GET['fruta'])) {
    $where[] = "f.nombre_fruta LIKE :fruta";
    $params[':fruta'] = $_GET['fruta'] . "%";
}

$sql = "
SELECT 
    v.id_factura,
    e.nombre AS empleado,
    c.nombre AS cliente,
    f.nombre_fruta AS fruta,
    v.cantidad,
    v.fecha_venta
FROM venta v
LEFT JOIN empleado e ON v.id_empleado = e.id_empleado
LEFT JOIN cliente c ON v.id_cliente = c.id_cliente
LEFT JOIN fruta f ON v.id_fruta = f.id_fruta
";

if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY v.fecha_venta DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$ventas) {
    echo "<tr><td colspan='6'>❌ No se encontraron ventas.</td></tr>";
    exit;
}

foreach ($ventas as $v) {
    echo "<tr>
            <td>{$v['id_factura']}</td>
            <td>".htmlspecialchars($v['empleado'])."</td>
            <td>".htmlspecialchars($v['cliente'])."</td>
            <td>".htmlspecialchars($v['fruta'])."</td>
            <td>{$v['cantidad']}</td>
            <td>{$v['fecha_venta']}</td>
          </tr>";
}
?>
