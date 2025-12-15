<?php
include 'conexion.php';

// Leer filtros desde POST
$title = $_POST['title'] ?? '';
$city = $_POST['city'] ?? '';
$country = $_POST['country'] ?? '';

// Consulta base
$query = "SELECT EmployeeID, FirstName, Title, City, Country, PostalCode
          FROM Employee";

$condiciones = [];

// Condiciones insensibles a mayúsculas/minúsculas
if (!empty($title)) {
    $condiciones[] = "LOWER(Title) LIKE LOWER('%" . $conexion->real_escape_string($title) . "%')";
}
if (!empty($city)) {
    $condiciones[] = "LOWER(City) LIKE LOWER('%" . $conexion->real_escape_string($city) . "%')";
}
if (!empty($country)) {
    $condiciones[] = "LOWER(Country) LIKE LOWER('%" . $conexion->real_escape_string($country) . "%')";
}

// Agregar WHERE si hay condiciones
if (count($condiciones) > 0) {
    $query .= " WHERE " . implode(" AND ", $condiciones);
}

$result = $conexion->query($query);

// Generar tabla HTML
echo "<table>";
echo "<tr><th>ID</th><th>First Name</th><th>Title</th><th>City</th><th>Country</th><th>Postal Code</th></tr>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['EmployeeID']}</td>
                <td>{$row['FirstName']}</td>
                <td>{$row['Title']}</td>
                <td>{$row['City']}</td>
                <td>{$row['Country']}</td>
                <td>{$row['PostalCode']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No se encontraron resultados</td></tr>";
}

$conexion->close();
?>
