<?php
function obtener_customers($conexion) {
    $sql = "SELECT c.*, e.lastName 
            FROM customers c 
            LEFT JOIN employees e ON c.salesRepEmployeeNumber = e.employeeNumber
            ORDER BY c.customerNumber";
    return $conexion->query($sql);
}

function obtener_empleados($conexion) {
    $sql = "SELECT employeeNumber, lastName FROM employees ORDER BY lastName";
    return $conexion->query($sql);
}

function insertar_customer($conexion, $data) {
    $sql = "INSERT INTO customers 
        (customerName, contactLastName, contactFirstName, phone, addressLine1, city, country, salesRepEmployeeNumber, creditLimit)
        VALUES (:customerName, :contactLastName, :contactFirstName, :phone, :addressLine1, :city, :country, :salesRepEmployeeNumber, :creditLimit)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute($data);
}

function obtener_customer_por_id($conexion, $id) {
    $sql = "SELECT * FROM customers WHERE customerNumber = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function modificar_customer($conexion, $data) {
    $sql = "UPDATE customers SET 
        customerName=:customerName, contactLastName=:contactLastName, contactFirstName=:contactFirstName, 
        phone=:phone, addressLine1=:addressLine1, city=:city, country=:country, 
        salesRepEmployeeNumber=:salesRepEmployeeNumber, creditLimit=:creditLimit
        WHERE customerNumber=:customerNumber";
    $stmt = $conexion->prepare($sql);
    $stmt->execute($data);
}

function borrar_customer($conexion, $id) {
    $sql = "DELETE FROM customers WHERE customerNumber = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['id' => $id]);
}
?>
