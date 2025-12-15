<?php
// Incluye la barra (valida sesión) y la conexión
include "barra.php";
include "conexion.php";

// Si el formulario se ha enviado, insertamos el nuevo empleado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $extension = $_POST['extension'];
    $email = $_POST['email'];
    $codOficina = $_POST['codOficina'];
    $reportsTo = $_POST['reportsTo'];
    $jobTitle = $_POST['jobTitle'];
    $pass = $_POST['pass'];
    // Inserta el nuevo registro en la tabla employees
    // NOTA: Vulnerable a inyección SQL; en producción usar prepared statements.
    $sql = "INSERT INTO employees (lastName, firstName, extension, email, officeCode, reportsTo, jobTitle, pass)
            VALUES ('$apellido', '$nombre', '$extension', '$email', '$codOficina', '$reportsTo', '$jobTitle', '$pass')";
    mysqli_query($conexion, $sql);

    // Redirige a la lista de empleados
    header("Location: empleados.php");
}
?>

<h2>Nuevo empleado</h2>
<form method="post">
    Apellido: <input type="text" name="apellido" required><br><br>
    Nombre: <input type="text" name="nombre" required><br><br>
    Extensión: <input type="text" name="extension" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Oficina:
    <SELECT name="codOficina">
        <?php
        $oficinas = mysqli_query($conexion, "SELECT officeCode, city FROM offices");
        while ($o = mysqli_fetch_assoc($oficinas)) {
            echo "<option value='{$o['officeCode']}'>{$o['city']}</option>";
        }
    ?>
    </SELECT> <br><br>
    Jefe:
    <SELECT name="reportsTo">
        <option value="">-- Ninguno --</option>
        <?php
        $jefes = mysqli_query($conexion, "SELECT employeeNumber, firstName, lastName FROM employees");
        while ($j = mysqli_fetch_assoc($jefes)) {
            echo "<option value='{$j['employeeNumber']}'>{$j['firstName']} {$j['lastName']}</option>";
        }
        ?>
    </SELECT> <br><br>
    Puesto: <input type="text" name="jobTitle" required><br><br>
    Contraseña: <input type="password" name="pass" required><br><br>


    <input type="submit" value="Guardar">
</form>
