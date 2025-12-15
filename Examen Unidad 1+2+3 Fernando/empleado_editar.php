<?php
// Incluye la barra (valida sesión) y la conexión a la BD
include "barra.php";
include "conexion.php";

// Obtiene el id del empleado a editar desde la query string
$id = $_GET['id'];

// Recupera los datos actuales del empleado
$res = mysqli_query($conexion, "SELECT * FROM employees WHERE employeeNumber=$id");
$empleado = mysqli_fetch_assoc($res);

// Si se ha enviado el formulario, procesa la actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valores enviados por POST
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $extension = $_POST['extension'];
    $email = $_POST['email'];
    $codOficina = $_POST['ciudad'];
    $reportsTo = $_POST['reportsTo'];
    $jobTitle = $_POST['jobTitle'];
    $pass = $_POST['pass'];

    // Actualiza la fila correspondiente en la tabla empleados
    // NOTA: Vulnerable a inyección SQL; en producción usar prepared statements.
    $sql = "UPDATE employees SET
            lastName='$apellido',
            firstName='$nombre',
            extension='$extension',
            email='$email',
            officeCode='$codOficina',
            reportsTo='$reportsTo',
            jobTitle='$jobTitle',
            pass='$pass'

            WHERE employeeNumber=$id";
    mysqli_query($conexion, $sql);

    // Redirige a la lista de empleados una vez guardado
    header("Location: empleados.php");
}
?>

<h2>Editar empleado</h2>
<form method="post">
    <!-- Campos precargados con los valores actuales del empleado -->
    Apellido: <input type="text" name="apellido" value="<?php echo $empleado['lastName']; ?>"><br><br>
    Nombre: <input type="text" name="nombre" value="<?php echo $empleado['firstName']; ?>"><br><br>
    Extensión: <input type="text" name="extension" value="<?php echo $empleado['extension']; ?>"><br><br>
    Email: <input type="email" name="email" value="<?php echo $empleado['email']; ?>"><br><br>
    <!--Oficina: <input type="text" name="codOficina" value="<?php echo $empleado['officeCode']; ?>"><br><br> -->
    Oficina:
    <select name="ciudad">
        <?php
        $oficinas = mysqli_query($conexion, "SELECT officeCode, city FROM offices");
        while ($o = mysqli_fetch_assoc($oficinas)) {
            $selected = ($o['officeCode'] == $empleado['officeCode']) ? "selected" : "";
            echo "<option value='{$o['officeCode']}' $selected>{$o['city']}</option>";
        }
        ?>
    </select><br><br>
    Jefe:
    <SELECT name="reportsTo">
        <?php
        $jefes = mysqli_query($conexion, "SELECT employeeNumber, firstName, lastName FROM employees");
        while ($j = mysqli_fetch_assoc($jefes)) {
            $selected = ($j['employeeNumber'] == $empleado['reportsTo']) ? "selected" : "";
            echo "<option value='{$j['employeeNumber']}' $selected>{$j['firstName']} {$j['lastName']}</option>";
        }
        ?>
    </SELECT><br><br>
    Puesto: <input type="text" name="jobTitle" value="<?php echo $empleado['jobTitle']; ?>"><br><br>
    Contraseña: <input type="password" name="pass" value="<?php echo $empleado['pass']; ?>"><br><br>
    <input type="submit" value="Guardar cambios">
</form>
