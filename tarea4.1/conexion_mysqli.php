<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Conexión con MySQLi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0e0e10;
            color: #f5f6fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        form {
            background: #1e1e22;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #00a8ff;
            width: 300px;
        }
        h2 {
            color: #00a8ff;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: none;
        }
        button {
            background: #00a8ff;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 15px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }
        .mensaje {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Conexión con MySQLi</h2>

<form method="post">
    <label>Servidor:</label>
    <input type="text" name="servidor" required>

    <label>Base de datos:</label>
    <input type="text" name="bd" required>

    <label>Usuario:</label>
    <input type="text" name="usuario" required>

    <label>Contraseña:</label>
    <input type="password" name="clave" required>

    <button type="submit" name="conectar">Conectar</button>
</form>

<div class="mensaje">
<?php
if (isset($_POST['conectar'])) {
    // Recogemos los datos del formulario
    $servidor = $_POST['servidor'];
    $bd = $_POST['bd'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Intentamos realizar la conexión con MySQLi
    $conexion = @new mysqli($servidor, $usuario, $clave, $bd);

    // Verificamos si hay error
    if ($conexion->connect_errno) {
        echo "<p style='color:red;'>❌ Error de conexión: " . $conexion->connect_error . "</p>";
    } else {
        echo "<p style='color:lightgreen;'>✅ Conexión establecida correctamente a la base de datos <strong>$bd</strong></p>";
        $conexion->close();
    }
}
?>
</div>

</body>
</html>
