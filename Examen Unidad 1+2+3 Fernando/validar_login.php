<?php
// Inicia la sesión para poder guardar datos de usuario si el login es correcto
session_start();

// Incluye la conexión a la base de datos
include "conexion.php";

// Recoge los valores enviados por POST desde el formulario de login
$numeroUsuario = $_POST['numeroUsuario'];
$clave = $_POST['clave'];
// Consulta para comprobar las credenciales.
$sql = "SELECT * FROM employees WHERE employeeNumber='$numeroUsuario' AND pass='$clave'";
$result = mysqli_query($conexion, $sql);
$nombreUsuario = mysqli_query($conexion, "SELECT firstName FROM employees WHERE employeeNumber='$numeroUsuario'");
$jobTitleUsuario = mysqli_query($conexion, "SELECT jobTitle FROM employees WHERE employeeNumber='$numeroUsuario'");
$reportsToUsuario = mysqli_query($conexion, "SELECT reportsTo FROM employees WHERE employeeNumber='$numeroUsuario'");
$accesso = 'denegado';

// Si hay exactamente una fila, las credenciales son correctas
if (mysqli_num_rows($result) == 1) {
    if ((mysqli_fetch_assoc($jobTitleUsuario)['jobTitle'] == "President") or (mysqli_fetch_assoc($reportsToUsuario)['reportsTo'] == "1002")) {
        // Guardamos el nombre de usuario en la sesión y redirigimos al índice
        $_SESSION['numeroUsuario'] = $numeroUsuario;
        $_SESSION['nombreUsuario'] = mysqli_fetch_assoc($nombreUsuario)['firstName'];
        $_SESSION['jobTitleUsuario'] = mysqli_fetch_assoc($jobTitleUsuario)['jobTitle'];
        $_SESSION['reportsToUsuario'] = mysqli_fetch_assoc($reportsToUsuario)['reportsTo'];
        $_SESSION['accesso'] = 'permitido';
        header("Location: index.php");
    }
    else {
        // Guardamos el nombre de usuario en la sesión y redirigimos al índice
        $_SESSION['numeroUsuario'] = $numeroUsuario;
        $_SESSION['nombreUsuario'] = mysqli_fetch_assoc($nombreUsuario)['firstName'];
        $_SESSION['jobTitleUsuario'] = mysqli_fetch_assoc($jobTitleUsuario)['jobTitle'];
        $_SESSION['reportsToUsuario'] = mysqli_fetch_assoc($reportsToUsuario)['reportsTo'];
        $_SESSION['accesso'] = 'denegado';
        header("Location: index.php");
    }
} else {
    // Si no coincide, redirigimos al login con un parámetro indicando error
    header("Location: login.php?error=1");
}
?>
