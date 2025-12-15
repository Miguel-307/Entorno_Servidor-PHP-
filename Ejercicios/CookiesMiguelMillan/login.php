<?php
session_start();

$usuario_valido = "admin";
$clave_valida = "1234";

if ($_POST) {
    if ($_POST["usuario"] == $usuario_valido && $_POST["clave"] == $clave_valida) {
        $_SESSION["usuario"] = $_POST["usuario"];
        header("Location: bienvenida.php");
        exit();
    } else {
        echo "❌ Usuario o clave incorrectos";
    }
}
?>

<form method="post">
    Usuario: <input type="text" name="usuario"><br>
    Clave: <input type="password" name="clave"><br>
    <input type="submit" value="Entrar">
</form>
