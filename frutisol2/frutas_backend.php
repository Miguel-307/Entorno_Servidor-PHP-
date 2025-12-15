<?php
include 'conexion.php';

$nombre = $_POST['nombre'] ?? '';
$temporada = $_POST['temporada'] ?? '';
$precio_min = $_POST['precio_min'] ?? '';
$precio_max = $_POST['precio_max'] ?? '';

$where = [];
$params = [];

if ($nombre !== '') {
    $where[] = "nombre_fruta LIKE :nombre";
    $params[':nombre'] = $nombre . "%";
}

if ($temporada !== '') {
    $input = strtolower(trim($temporada));
    $meses = [
        'enero'=>'Invierno','febrero'=>'Invierno','marzo'=>'Primavera','abril'=>'Primavera','mayo'=>'Primavera',
        'junio'=>'Verano','julio'=>'Verano','agosto'=>'Verano','septiembre'=>'Otoño','octubre'=>'Otoño','noviembre'=>'Otoño','diciembre'=>'Invierno'
    ];
    $temporadaSQL = $meses[$input] ?? ucfirst($input);
    $where[] = "temporada LIKE :temporada";
    $params[':temporada'] = $temporadaSQL . "%";
}

if ($precio_min !== '') {
    $where[] = "precio >= :precio_min";
    $params[':precio_min'] = $precio_min;
}

if ($precio_max !== '') {
    $where[] = "precio <= :precio_max";
    $params[':precio_max'] = $precio_max;
}

$sql = "SELECT * FROM fruta";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY id_fruta ASC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $frutas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$frutas) {
        echo "<p class='error'>❌ No se encontraron frutas.</p>";
        exit;
    }

    echo "<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Temporada</th>
        <th>Precio (€)</th>
        <th>Stock</th>
        <th>Origen</th>
        <th>Proveedor</th>
    </tr>
    </thead><tbody>";

    foreach ($frutas as $f) {
        echo "<tr>
            <td>{$f['id_fruta']}</td>
            <td>" . htmlspecialchars($f['nombre_fruta']) . "</td>
            <td>{$f['temporada']}</td>
            <td>{$f['precio']}</td>
            <td>{$f['stock']}</td>
            <td>" . htmlspecialchars($f['origen']) . "</td>
            <td>" . htmlspecialchars($f['proveedor']) . "</td>
        </tr>";
    }

    echo "</tbody></table>";

} catch (PDOException $e) {
    echo "<p class='error'>❌ Error en la base de datos: " . htmlspecialchars($e->getMessage()) . "</p>";
}
