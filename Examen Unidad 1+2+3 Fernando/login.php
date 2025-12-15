<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <!-- Formulario que envía usuario y clave a validar_login.php -->
    <form action="validar_login.php" method="post">
        Número Usuario: <input type="text" name="numeroUsuario" required><br><br>
        Clave: <input type="password" name="clave" required><br><br>
        <input type="submit" value="Entrar">
    </form>

    <?php
    // Si se recibe el parámetro error en la URL, mostramos un mensaje
    if (isset($_GET['error'])) {
        echo "<p style='color:red'>Usuario o clave incorrectos</p>";
    }
    ?>
</body>
</html>
