<?php
include 'conexion.php';

$productName = isset($_POST['productName']) ? trim($_POST['productName']) : '';
$productLine = isset($_POST['productLine']) ? trim($_POST['productLine']) : '';

$query = "SELECT * FROM products";
$condiciones = [];
$params = [];

if (!empty($productName)) {
    $condiciones[] = "LOWER(productName) LIKE ?";
    $params[] = "%" . strtolower($productName) . "%";
}

if (!empty($productLine)) {
    $condiciones[] = "LOWER(productLine) LIKE ?";
    $params[] = "%" . strtolower($productLine) . "%";
}

if (count($condiciones) > 0) {
    $query .= " WHERE " . implode(" AND ", $condiciones);
}

$stmt = $conexion->prepare($query);

if (count($params) > 0) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

echo "<table border='1' cellspacing='0' cellpadding='5'>";
echo "<tr>
        <th>productCode</th>
        <th>productName</th>
        <th>productLine</th>
        <th>productScale</th>
        <th>productVendor</th>
        <th>productDescription</th>
        <th>quantityInStock</th>
        <th>buyPrice</th>
        <th>MSRP</th>
    </tr>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['productCode']}</td>
                <td>{$row['productName']}</td>
                <td>{$row['productLine']}</td>
                <td>{$row['productScale']}</td>
                <td>{$row['productVendor']}</td>
                <td>{$row['productDescription']}</td>
                <td>{$row['quantityInStock']}</td>
                <td>{$row['buyPrice']}</td>
                <td>{$row['MSRP']}</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='9' style='text-align:center;color:red;font-weight:bold;'>No se encontraron resultados</td></tr>";
}

echo "</table>";

$stmt->close();
$conexion->close();
?>
