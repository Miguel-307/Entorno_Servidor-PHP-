<?php
// Activa las sesiones
session_start();
// Comprueba si existe la sesión 'email', en caso contrario vuelve a la página de login
if (!isset($_SESSION['codigo'])) {
    header('Location: login.php');
} else {
    $codigo = $_SESSION['codigo'];
    $usuario = $_SESSION['usu'];
}

function ponerCabecera($usuario)
{
    echo '<div style="background: lightblue; text-align: right;">';
    echo '<p>Usuario:'.$usuario.'</br>';
    echo '<a href="logout.php">Cerrar sesión</a></p>';
    echo '</div>';
}
