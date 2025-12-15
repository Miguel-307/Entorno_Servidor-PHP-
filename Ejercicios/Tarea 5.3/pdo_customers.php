<html>
<body>
<?php
$opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];

try {
    $db = new PDO('mysql:host=localhost;dbname=northwind', 'root', '', $opciones);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Falló la conexión: " . $e->getMessage());
}

echo "<h2>Listado de clientes (PDO)</h2>";

$query = "
SELECT custId, companyName, contactName, contactTitle, address, city, country, phone
FROM customer
ORDER BY custId
";

echo '<table border="1" cellspacing="2" cellpadding="4">
        <tr>
          <th>ID</th>
          <th>Nombre de la compañía</th>
          <th>Contacto</th>
          <th>Título</th>
          <th>Dirección</th>
          <th>Ciudad</th>
          <th>País</th>
          <th>Teléfono</th>
        </tr>';

foreach ($db->query($query, PDO::FETCH_ASSOC) as $row) {
    echo "<tr>
            <td>{$row['custId']}</td>
            <td>{$row['companyName']}</td>
            <td>{$row['contactName']}</td>
            <td>{$row['contactTitle']}</td>
            <td>{$row['address']}</td>
            <td>{$row['city']}</td>
            <td>{$row['country']}</td>
            <td>{$row['phone']}</td>
          </tr>";
}

$db = null;
?>
</body>
</html>
