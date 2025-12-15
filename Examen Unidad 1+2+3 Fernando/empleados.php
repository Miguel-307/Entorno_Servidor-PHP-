<?php
// Incluye la barra (valida sesión) y la conexión a la base de datos
include "barra.php";
include "conexion.php";

// Consulta todos los empleados junto con el nombre del departamento y la ciudad
$sql = "SELECT e.employeeNumber, e.firstName AS Nombre, e.lastName AS Apellido, e.extension AS Extension, e.email AS Email, (SELECT city FROM offices f WHERE f.officeCode = e.officeCode) AS Oficina, (SELECT firstName FROM employees WHERE employeeNumber = e.reportsTo) AS Jefe, e.jobTitle AS Puesto, e.pass AS Contraseña
        FROM employees e";
$resultado = mysqli_query($conexion, $sql);
?>

<h2>Listado de empleados</h2>
<a href="empleado_form.php">Nuevo empleado</a>
<br><br>

<!-- Tabla que muestra los empleados devueltos por la consulta -->
<table border="1" cellpadding="5">
<tr>
    <th>Apellido</th>
    <th>Nombre</th>
    <th>Extension</th>
    <th>Email</th>
    <th>Oficina</th>
    <th>Jefe</th>
    <th>Puesto</th>
    <th>Contraseña</th>
</tr>

<?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
<tr>
    <!-- Se muestran los datos de cada empleado -->
    <td><?php echo $fila['Apellido']; ?></td>
    <td><?php echo $fila['Nombre']; ?></td>
    <td><?php echo $fila['Extension']; ?></td>
    <td><?php echo $fila['Email']; ?></td>
    <td><?php echo $fila['Oficina']; ?></td>
    <td><?php echo $fila['Jefe']; ?></td>
    <td><?php echo $fila['Puesto']; ?></td>
    <td><?php echo $fila['Contraseña']; ?></td>
    <td>
        <!-- Enlaces para editar o borrar el empleado (pasan el id por GET) -->
        <a href="empleado_editar.php?id=<?php echo $fila['employeeNumber']; ?>">Editar</a> |
        <a href="empleado_borrar.php?id=<?php echo $fila['employeeNumber']; ?>">Borrar</a>
    </td>
</tr>
<?php } ?>
</table>
