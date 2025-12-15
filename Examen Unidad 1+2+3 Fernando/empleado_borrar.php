<?php
// Incluye la barra (valida sesión) y la conexión
include "barra.php";
include "conexion.php";

// Obtiene el id del empleado a borrar desde la query string
$id = $_GET['id'];

$sql = "SELECT COUNT(*) AS total FROM employees WHERE reportsTo=$id";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($result);
$total = $row['total'];

// Si el empleado tiene empleados a su cargo, no se puede borrar
if ($total > 0) {
    echo "No se puede borrar el empleado porque tiene empleados a su cargo.";
} else {
    // Intenta borrar el empleado de la tabla employees
    if (!mysqli_query($conexion, "DELETE FROM employees WHERE employeeNumber=$id")) {
        // En caso de error, muestra el mensaje de error
        echo "Error al borrar: " . mysqli_error($conexion);
    } else {
        // Si se borra correctamente, redirige a la lista de empleados
        header("Location: empleados.php");
    }
}

?>
