<?php
function conectar() {
    if (!isset($_POST['conectar'])) {
        echo '
        <form method="post" action="">
            <label>Servidor:</label>
            <input type="text" name="servidor" value="localhost" required><br>

            <label>Base de datos:</label>
            <input type="text" name="bd" value="northwind" required><br>

            <label>Usuario:</label>
            <input type="text" name="usuario" value="root" required><br>

            <label>Contraseña:</label>
            <input type="password" name="clave"><br><br>

            <button type="submit" name="conectar">Conectar</button>
        </form>';
        return null;
    } else {
        $servidor = $_POST['servidor'];
        $bd = $_POST['bd'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        try {
            $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $usuario, $clave);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p style='color: #00ff88;'>✅ Conexión exitosa con la base de datos '$bd'.</p>";
            echo "<form method='post'><button name='volver'>🔙 Volver al formulario</button></form>";
            return $conexion;
        } catch (PDOException $e) {
            echo "<p style='color:red;'>❌ Error: ".$e->getMessage()."</p>";
            echo "<form method='post'><button name='volver'>🔙 Volver al formulario</button></form>";
            return null;
        }
    }
}
?>
