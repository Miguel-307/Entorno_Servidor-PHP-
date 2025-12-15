<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Conexión y lectura con PDO</title>
</head>
<body>
  <h1>Conexión y lectura con PDO</h1>
  
  <form method="post">
    <label>Servidor:</label>
    <input type="text" name="servidor" required placeholder="Ej: localhost">

    <label>Base de datos:</label>
    <input type="text" name="basedatos" required placeholder="Ej: test">

    <label>Usuario:</label>
    <input type="text" name="usuario" required placeholder="Ej: root">

    <label>Contraseña:</label>
    <input type="password" name="clave" placeholder="(vacío si no hay)">

    <label>Tabla a mostrar:</label>
    <input type="text" name="tabla" required placeholder="Ej: clientes">

    <button type="submit" name="conectar">Conectar y mostrar datos</button>
  </form>

  <?php
  if (isset($_POST['conectar'])) {
      $servidor = $_POST['servidor'];
      $basedatos = $_POST['basedatos'];
      $usuario = $_POST['usuario'];
      $clave = $_POST['clave'];
      $tabla = $_POST['tabla'];

      echo "<div class='resultado'>";
      try {
         
          $dsn = "mysql:host=$servidor;dbname=$basedatos;charset=utf8";
          $conexion = new PDO($dsn, $usuario, $clave);
          $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          echo "Conexión correcta.<br><br>";
          echo "<b>Datos de la tabla '$tabla':</b><br><br>";

        
          $sql = "SELECT * FROM $tabla";
          $stmt = $conexion->query($sql);

      
          while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
              print_r($fila);
              echo "<br><br>";
          }
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
      echo "</div>";
  }
  ?>
</body>
</html>
