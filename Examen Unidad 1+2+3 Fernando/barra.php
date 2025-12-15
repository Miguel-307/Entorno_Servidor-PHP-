<?php
// Inicio de sesión: asegura que las variables de sesión estén disponibles.
session_start();

// Comprobamos si el usuario está autenticado; si no, redirigimos al login.
if (!isset($_SESSION['nombreUsuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!-- Barra de navegación simple que muestra el usuario activo y enlaces -->
<div style="background-color: grey; padding:10px; margin-bottom:15px;">
    Usuario: <strong><?php echo $_SESSION['nombreUsuario']; // Muestra el nombre de usuario almacenado en la sesión ?></strong> |
    <a href="index.php" style="color: white;">Inicio</a> |
    <!--<a href="empleados.php" style="color: white;">Gestión de empleados</a> | -->
    <a href="logout.php" style="color: white;">Cerrar sesión</a>
</div>
