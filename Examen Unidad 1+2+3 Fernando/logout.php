<?php
// Inicia la sesión para poder destruirla
session_start();
// Destruye toda la información de sesión (logout)
session_destroy();
// Redirige al formulario de login
header("Location: login.php");
?>
