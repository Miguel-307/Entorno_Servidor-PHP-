<?php
include 'conexion.php'; // Incluye el archivo que establece la conexión a la base de datos

// Lee los filtros recibidos por POST; si no existen, usa cadena vacía
$title = $_POST['title'] ?? '';   // Filtro por título del empleado
$city = $_POST['city'] ?? '';     // Filtro por ciudad del empleado
$country = $_POST['country'] ?? '';// Filtro por país del empleado

// Consulta base; WHERE 1=1 facilita ir agregando condiciones con AND
$query = "SELECT EmployeeID, FirstName, Title, City, Country, PostalCode
          FROM employee
          WHERE 1=1";

// Agrega condición por Título si se ha introducido algo; se escapa para evitar inyección SQL
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

$result = $conexion->query($query); // Ejecuta la consulta y obtiene el conjunto de resultados

// Construye la tabla HTML de salida (cabecera)
echo "<table>";
echo "<tr><th>ID</th><th>First Name</th><th>Title</th><th>City</th><th>Country</th><th>Postal Code</th></tr>";

// Si hay resultados, recórrelos y dibuja una fila por cada registro
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { // Obtiene cada fila como array asociativo
        echo "<tr>
                <td>{$row['EmployeeID']}</td>  <!-- Identificador del empleado -->
                <td>{$row['FirstName']}</td>   <!-- Nombre del empleado -->
                <td>{$row['Title']}</td>       <!-- Cargo/Título -->
                <td>{$row['City']}</td>        <!-- Ciudad -->
                <td>{$row['Country']}</td>     <!-- País -->
                <td>{$row['PostalCode']}</td>  <!-- Código postal -->
              </tr>";
    }
} else {
    // Si no hay resultados, muestra una fila con mensaje informativo
    echo "<tr><td colspan='6'>No se encontraron resultados</td></tr>";
}

echo "</table>"; // Cierra la tabla HTML

$conexion->close(); // Cierra la conexión a la base de datos
?>
