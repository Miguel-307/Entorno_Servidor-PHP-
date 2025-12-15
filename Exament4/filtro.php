<?php
include 'conexion.php';

// Obtener filtros
$customerName = isset($_GET['customerName']) ? trim($_GET['customerName']) : '';
$city = isset($_GET['city']) ? trim($_GET['city']) : '';
$country = isset($_GET['country']) ? trim($_GET['country']) : '';
$creditLimit = isset($_GET['creditLimit']) ? trim($_GET['creditLimit']) : '';

// Consulta base
$query = "SELECT * FROM customers";
$condiciones = [];
$params = [];

// Condiciones
if (!empty($customerName)) {
    $condiciones[] = "LOWER(customerName) LIKE ?";
    $params[] = "%" . strtolower($customerName) . "%";
}

if (!empty($city)) {
    $condiciones[] = "LOWER(city) LIKE ?";
    $params[] = "%" . strtolower($city) . "%";
}

if (!empty($country)) {
    $condiciones[] = "LOWER(country) LIKE ?";
    $params[] = "%" . strtolower($country) . "%";
}

// creditLimit menor o igual
if (!empty($creditLimit) && is_numeric($creditLimit)) {
    $condiciones[] = "creditLimit <= ?";
    $params[] = $creditLimit;
}

// Añadir condiciones al query
if (count($condiciones) > 0) {
    $query .= " WHERE " . implode(" AND ", $condiciones);
}

$stmt = $conexion->prepare($query);

// Vincular parámetros
if (count($params) > 0) {
    $types = '';
    foreach ($params as $p) {
        $types .= is_numeric($p) ? 'd' : 's';
    }
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Mostrar resultados
echo "<table>";
echo "<tr>
        <th>customerNumber</th>
        <th>customerName</th>
        <th>contactLastName</th>
        <th>contactFirstName</th>
        <th>phone</th>
        <th>addressLine1</th>
        <th>addressLine2</th>
        <th>city</th>
        <th>state</th>
        <th>postalCode</th>
        <th>country</th>
        <th>salesRepEmployeeNumber</th>
        <th>creditLimit</th>
    </tr>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['customerNumber']}</td>
                <td>{$row['customerName']}</td>
                <td>{$row['contactLastName']}</td>
                <td>{$row['contactFirstName']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['addressLine1']}</td>
                <td>{$row['addressLine2']}</td>
                <td>{$row['city']}</td>
                <td>{$row['state']}</td>
                <td>{$row['postalCode']}</td>
                <td>{$row['country']}</td>
                <td>{$row['salesRepEmployeeNumber']}</td>
                <td>{$row['creditLimit']}</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='13' style='text-align:center;color:red;'>No se encontraron resultados</td></tr>";
}

echo "</table>";

$stmt->close();
$conexion->close();
?>
