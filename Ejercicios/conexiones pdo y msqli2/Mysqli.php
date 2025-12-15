<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Conexión y lectura con MySQLi</title>
 
</head>
<body>
  <h1>Conexión y lectura con MySQLi</h1>
  
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


      $conexion = @new mysqli($servidor, $usuario, $clave, $basedatos);

      echo "<div class='resultado'>";
      if ($conexion->connect_error) {
          echo "Error de conexión: " . $conexion->connect_error;
      } else {
          echo "Conexión establecida correctamente.<br><br>";
          echo "<b>Datos de la tabla '$tabla':</b><br><br>";


          $sql = "SELECT * FROM $tabla";
          $resultado = $conexion->query($sql);

          if ($resultado && $resultado->num_rows > 0) {

              while ($fila = $resultado->fetch_assoc()) {
                  print_r($fila);
                  echo "<br><br>";
              }
          } else {
              echo "No se encontraron datos o la tabla no existe.";
          }

          $conexion->close();
      }
      echo "</div>";
  }
  ?>
</body>
</html>
