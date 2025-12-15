<?php
// Incluye la barra (valida sesión) y la conexión a la base de datos
include "barra.php";
include "conexion.php";

// Consulta todos los empleados junto con el nombre del departamento y la ciudad
$sql = "SELECT p.productCode AS CodProducto, p.productName AS NombreProducto, p.productLine AS LineaProducto, (SELECT l.textDescription FROM productlines l WHERE l.productLine = p.productLine) AS DescripcionLinea, p.productScale AS EscalaProducto, p.productVendor AS ProveedorProducto, p.productDescription AS Descripcion, p.quantityInStock AS Stock, p.buyPrice AS PrecioCompra, p.MSRP AS PrecioVenta
        FROM products p";
$resultado = mysqli_query($conexion, $sql);
?>

<h2>Listado de productos</h2>
<a href="producto_form.php">Nuevo producto</a>
<br><br>

<!-- Tabla que muestra los productos devueltos por la consulta -->
<table border="1" cellpadding="5">
<tr>
    <th>Código Producto</th>
    <th>Nombre Producto</th>
    <th>Linea Producto</th>
    <th>Descripción Linea</th>
    <th>Escala Producto</th>
    <th>Proveedor Producto</th>
    <th>Descripción</th>
    <th>Stock</th>
    <th>Precio Compra</th>
    <th>Precio Venta</th>
    <th>Acciones</th>
</tr>

<?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
<tr>
    <!-- Se muestran los datos de cada producto -->
    <td><?php echo $fila['CodProducto']; ?></td>
    <td><?php echo $fila['NombreProducto']; ?></td>
    <td><?php echo $fila['LineaProducto']; ?></td>
    <td><?php echo $fila['DescripcionLinea']; ?></td>
    <td><?php echo $fila['EscalaProducto']; ?></td>
    <td><?php echo $fila['ProveedorProducto']; ?></td>
    <td><?php echo $fila['Descripcion']; ?></td>
    <td><?php echo $fila['Stock']; ?></td>
    <td><?php echo $fila['PrecioCompra']; ?></td>
    <td><?php echo $fila['PrecioVenta']; ?></td>
    <td>
        <!-- Enlaces para editar o borrar el producto (pasan el id por GET) -->
        <a href="producto_editar.php?id=<?php echo $fila['CodProducto']; ?>">Editar</a> |
        <a href="producto_borrar.php?id=<?php echo $fila['CodProducto']; ?>">Borrar</a>
    </td>
</tr>
<?php } ?>
</table>
