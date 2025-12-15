<?php
include 'cab.php';
include 'bd.php';

// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos variables
    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
    $apellido1 = isset($_REQUEST['ape1']) ? $_REQUEST['ape1'] : null;
    $apellido2 = isset($_REQUEST['ape2']) ? $_REQUEST['ape2'] : null;
    $departamento = isset($_REQUEST['departamento']) ? $_REQUEST['departamento'] : null;
    // Variables
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO empleados (nombre, apellido1, apellido2, departamento) VALUES (:nombre, :ape1, :ape2, :depart)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'nombre' => $nombre,
            'ape1' => $apellido1,
            'ape2' => $apellido2,
            'depart' => $departamento
        )
    );
    // Redireccionamos a Leer
    header('Location: lista.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea 3.3</title>
</head>
<body>
    <?php ponerCabecera($usuario); ?>
    <form action="" method="post">
        <p>
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre">
        </p>
        <p>
            <label for="ape1">Apellido 1</label>
            <input id="ape1" type="text" name="ape1">
        </p>
        <p>
            <label for="ape2">Apellido 2</label>
            <input id="ape2" type="text" name="ape2">
        </p>
        <p>
            <div>Departamento</div>
            <?php
                // Conecta con base de datos
                $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
                // Prepara SELECT
                $miConsulta = $miPDO->prepare('select coddept, nombre from departamentos;');
                // Ejecuta consulta
                $miConsulta->execute();            

                foreach ($miConsulta as $clave => $valor): 
            ?>
                    <input id="<?= $valor['nombre'] ?>" type="radio" name="departamento" value="<?= $valor['coddept'] ?>"> <label for="<?= $valor['nombre'] ?>"><?= $valor['nombre'] ?></label>
            <?php endforeach; ?>
        </p>
        <p>
            <input type="submit" value="Guardar">
        </p>
    </form>
</body>
</html>