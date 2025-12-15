<html>
<body>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "northwind";


$mysqli = new mysqli($servername, $username, $password, $database);


if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}


$query = "
SELECT p.productId, p.productName, c.categoryName, s.companyName AS supplier, 
       p.quantityPerUnit, p.unitPrice, p.unitsInStock
FROM product p
LEFT JOIN category c ON p.categoryId = c.categoryId
LEFT JOIN supplier s ON p.supplierId = s.supplierId
ORDER BY p.productId
";

echo "<h2>Listado de productos (MySQLi)</h2>";

echo '<table border="1" cellspacing="2" cellpadding="4">
        <tr>
          <th>ID</th>
          <th>Nombre del producto</th>
          <th>Categoría</th>
          <th>Proveedor</th>
          <th>Cantidad por unidad</th>
          <th>Precio unitario</th>
          <th>Unidades en stock</th>
        </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['productId']}</td>
                <td>{$row['productName']}</td>
                <td>{$row['categoryName']}</td>
                <td>{$row['supplier']}</td>
                <td>{$row['quantityPerUnit']}</td>
                <td>{$row['unitPrice']}</td>
                <td>{$row['unitsInStock']}</td>
              </tr>";
    }
    $result->free();
} else {
    echo "Error en la consulta: " . $mysqli->error;
}

$mysqli->close();
?>
</body>
</html>
