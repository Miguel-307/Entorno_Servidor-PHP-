<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar registro Región</title>
</head>
<body>
    <h1>Modificar registro Región</h1>
    <?php

        require_once "conexion.php";
        require_once "funciones.php";

        $bd=conectar();
        if($bd){
            // Aseguramos que el ID se recibe y es un número entero
            $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

            if($id !== false){
                $res=cargarIdRegion($bd, $id);
                if($res->rowCount()>0){
                    $row = $res->fetch(PDO::FETCH_ASSOC);
                        echo "<form method='POST' action = 'modificarRegion.php'>
                                <label for='id'>ID</label>
                                <input type='text' name='id' id='id' value=".$row['regionId']." readonly><br>
                                
                                <label for='descripcion'>Descripción</label>
                                <input type='text' name='descripcion' id='descripcion' value='".$row['regionDescription']."' required><br>
                                
                                <input type='submit' value='Guardar'>
                            </form>";
                } else {
                    echo "ID de Región no encontrado.<br>";
                }
            }else{
                echo "ID de Región incorrecto.<br>";
            }
        }
    ?>
    <br><a href='index.php'>Menu principal</a>
</body>
</html>