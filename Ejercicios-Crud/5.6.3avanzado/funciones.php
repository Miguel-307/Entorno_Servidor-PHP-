<?php
function verificar_login($conexion, $usuario, $clave) {
    $sql = "SELECT * FROM employee WHERE lastName = :usuario AND employeeId = :clave";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['usuario' => $usuario, 'clave' => $clave]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtener_productos($conexion) {
    $sql = "SELECT p.*, s.companyName, c.categoryName
            FROM product p
            LEFT JOIN supplier s ON p.supplierId = s.supplierId
            LEFT JOIN category c ON p.categoryId = c.categoryId
            ORDER BY p.productId";
    return $conexion->query($sql);
}

function obtener_proveedores($conexion) {
    return $conexion->query("SELECT supplierId, companyName FROM supplier ORDER BY companyName");
}

function obtener_categorias($conexion) {
    return $conexion->query("SELECT categoryId, categoryName FROM category ORDER BY categoryName");
}

function obtener_producto_por_id($conexion, $id) {
    $stmt = $conexion->prepare("SELECT * FROM product WHERE productId = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertar_producto($conexion, $data) {
    // Asegurar valor por defecto si no se envía desde el formulario
    if (!isset($data['discontinued'])) {
        $data['discontinued'] = 0; // 0 = activo, 1 = descatalogado
    }

    $sql = "INSERT INTO product 
            (productName, supplierId, categoryId, quantityPerUnit, unitPrice, discontinued)
            VALUES (:productName, :supplierId, :categoryId, :quantityPerUnit, :unitPrice, :discontinued)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute($data);
}


function modificar_producto($conexion, $data) {
    $sql = "UPDATE product SET 
            productName=:productName, supplierId=:supplierId, categoryId=:categoryId,
            quantityPerUnit=:quantityPerUnit, unitPrice=:unitPrice
            WHERE productId=:productId";
    $stmt = $conexion->prepare($sql);
    $stmt->execute($data);
}

function borrar_producto($conexion, $id) {
    // Eliminar los registros relacionados en orderdetail primero
    $deleteDetail = $conexion->prepare("DELETE FROM orderdetail WHERE productId = :id");
    $deleteDetail->execute(['id' => $id]);

    // Luego eliminar el producto
    $stmt = $conexion->prepare("DELETE FROM product WHERE productId = :id");
    $stmt->execute(['id' => $id]);
}

?>
