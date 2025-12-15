<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar registro</title>
</head>
<body>
    <h1>Modificar registro</h1>

<?php
    require_once "conexion.php";
    require_once "funciones.php";

    $bd=conectar();
    if($bd) {
        $id=$_GET["id"];
        if($id>0) {
            $res=cargarId($bd, $id);
            if($res->rowCount()>0) {
                $row = $res->fetch(PDO::FETCH_ASSOC);
                echo "<form method='POST' action='modificar.php'>";
                echo "<input id='id' name='id' type='hidden' value=".$row['shipperId']."><br>";
                echo "<label for='nombre'>Nombre</label>";
                echo "<input id='nombre' name='nombre' type='text' value=".$row['companyName']."><br>";
                echo "<label for='telef'>Teléfono</label>";
                echo "<input id='telef' name='telef' type='text' value=".$row['phone']."><br>";
                echo "<input type='submit' value='Registrar, enviar y guardar'>";
                echo "</form>";
        
            }
        } else {
            echo "Identificador incorrecto.</br>";
        }
    }

?>

</body>
</html>