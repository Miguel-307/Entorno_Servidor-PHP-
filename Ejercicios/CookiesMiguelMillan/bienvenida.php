<?php
session_start();

if (isset($_SESSION["usuario"])) {
    echo "Bienvenido, " . $_SESSION["usuario"];
} else {
    echo "No has iniciado sesión. <a href='login.php'>Ir al login</a>";
}
?>
