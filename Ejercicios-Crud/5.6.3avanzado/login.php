<?php
require_once "conexion.php";
require_once "funciones.php";

if (!isset($_COOKIE['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_COOKIE['usuario'];


    $empleado = verificar_login($conexion, $user, $pass);
    if ($empleado) {
        // Guardar cookie con el nombre de usuario por 1 hora
        setcookie("usuario", $empleado['lastName'], time() + 3600, "/");
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login Northwind</title>
<style>
body {font-family:Arial; background:#f2f2f2;}
form {background:white; width:300px; margin:100px auto; padding:20px; border-radius:10px; text-align:center;}
input {margin:5px 0; padding:8px; width:90%;}
input[type=submit]{background:#007bff;color:white;border:none;cursor:pointer;border-radius:4px;}
input[type=submit]:hover{background:#0056b3;}
.error{color:red;}
</style>
</head>
<body>
<form method="post">
    <h2>Iniciar sesión</h2>
    <input type="text" name="usuario" placeholder="Apellido (lastName)" required>
    <input type="password" name="clave" placeholder="ID de empleado" required>
    <input type="submit" value="Entrar">
    <?php if (!empty($error)): ?><p class="error"><?= $error ?></p><?php endif; ?>
</form>
</body>
</html>
