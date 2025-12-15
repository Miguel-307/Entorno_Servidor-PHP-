<?php
// Incluye la barra (valida sesión) y la conexión a la BD
include "barra.php";
include "conexion.php";

// Obtiene el id del empleado a editar desde la query string
$id = $_GET['id'];

// Recupera los datos actuales del producto
$res = mysqli_query($conexion, "SELECT * FROM products WHERE productCode=$id");
$producto = mysqli_fetch_assoc($res);

// Si se ha enviado el formulario, procesa la actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valores enviados por POST
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $linea = $_POST['linea'];
    $escala = $_POST['escala'];
    $proveedor = $_POST['proveedor'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];


    $sql = "UPDATE employees SET
            productCode='$codigo',
            productName='$nombre',
            productLine='$linea',
            productScale='$escala',
            productVendor='$proveedor',
            productDescription='$descripcion',
            quantityInStock='$stock',
            buyPrice='$precio_compra',
            MSRP='$precio_venta'

            WHERE productCode=$id";
    mysqli_query($conexion, $sql);

    header("Location: productos.php");
}
?>

<h2>Editar producto</h2>
<form method="post">
    <!-- Campos precargados con los valores actuales del producto -->
    Código producto: <input type="text" name="codigo" value="<?php echo $producto['productCode']; ?>" readonly><br><br>
    Nombre: <input type="text" name="nombre" value="<?php echo $producto['productName']; ?>"><br><br>
    Línea: <input type="text" name="linea" value="<?php echo $producto['productLine']; ?>"><br><br>
    Escala: <input type="text" name="escala" value="<?php echo $producto['productScale']; ?>"><br><br>
    Proveedor: <input type="text" name="proveedor" value="<?php echo $producto['productVendor']; ?>"><br><br>
    Descripción: <input type="text" name="descripcion" value="<?php echo $producto['productDescription']; ?>"><br><br>
    Stock: <input type="number" name="stock" value="<?php echo $producto['quantityInStock']; ?>"><br><br>
    Precio compra: <input type="text" name="precio_compra" value="<?php echo $producto['buyPrice']; ?>"><br><br>
    Precio venta: <input type="text" name="precio_venta" value="<?php echo $producto['MSRP']; ?>"><br><br>
    <input type="submit" value="Guardar cambios">
</form>

