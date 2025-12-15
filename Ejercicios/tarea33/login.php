<?php include 'bd.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tarea 3.3</title>
    </head>
    <body>
        <?php 
            // Comprobamos que nos llega los datos del formulario
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Variables del formulario
                $nomb = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
                $clav = isset($_REQUEST['clave']) ? $_REQUEST['clave'] : null;

                $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

                $miConsulta = $miPDO->prepare('select codigo, nombre from usuarios WHERE nombre = :nombre and clave = :clave;');
                // Ejecuta consulta
                $miConsulta->execute(
                    [
                        'nombre' => $nomb,
                        'clave' => $clav
                    ]
                );

                $resultado = $miConsulta->fetchAll();
                if(isset($resultado[0])) {
                    session_start();
                    $_SESSION['codigo'] = $resultado[0]['codigo'];
                    $_SESSION['usu'] = $resultado[0]['nombre'];
                    $miPDO = null;
                    // Redireccionamos a la página segura
                    header('Location: main.php');
                    die();                    
                } else {
                    echo '<p style="color: red">Valores incorrectos.</p>';
                }
            }
        ?>
        <form method="post">
            <p>
                <input type="text" name="nombre" placeholder="Nombre"> 
            </p> 
            <p>
                <input type="password" name="clave" placeholder="Clave"> 
            </p>
            <p>
                <input type="submit" value="Entrar"> 
            </p>
        </form>
    </body>
</html>