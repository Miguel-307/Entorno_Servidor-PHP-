<?php
include 'conexion.php';

// Lee los filtros recibidos por GET; si no existen, usa cadena vacía
$title = $_GET['title'] ?? '';
$city = $_GET['city'] ?? '';
$country = $_GET['country'] ?? '';

// Consulta base; WHERE 1=1 facilita agregar condiciones dinámicamente
$query = "SELECT EmployeeID, FirstName, Title, City, Country, PostalCode
          FROM employee
          WHERE 1=1";

// Agrega condición por Título si se ha introducido algo
if (!empty($title)) {
    $query .= " AND LOWER(Title) LIKE LOWER('%" . $conexion->real_escape_string($title) . "%')";
}

// Agrega condición por Ciudad si procede
if (!empty($city)) {
    $query .= " AND LOWER(City) LIKE LOWER('%" . $conexion->real_escape_string($city) . "%')";
}

// Agrega condición por País si procede
if (!empty($country)) {
    $query .= " AND LOWER(Country) LIKE LOWER('%" . $conexion->real_escape_string($country) . "%')";
}

$result = $conexion->query($query);

// Construye la tabla HTML de salida
echo "<table>";
echo "<tr><th>ID</th><th>First Name</th><th>Title</th><th>City</th><th>Country</th><th>Postal Code</th></tr>";

// Si hay resultados, recórrelos
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

echo "</table>";

$conexion->close();
?>
