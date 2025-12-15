<?php
// Variables
include 'bd.php';
include 'cab.php';

$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
$ape1 = isset($_REQUEST['ape1']) ? $_REQUEST['ape1'] : null;
$ape2 = isset($_REQUEST['ape2']) ? $_REQUEST['ape2'] : null;
$departamento = isset($_REQUEST['departamento']) ? $_REQUEST['departamento'] : null;

// Conecta con base de datos
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE empleados SET nombre = :nombre, apellido1 = :ape1, apellido2 = :ape2, departamento = :dept WHERE codemple = :codigo');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'codigo' => $codigo,
            'nombre' => $nombre,
            'ape1' => $ape1,
            'ape2' => $ape2,            
            'dept' => $departamento
        ]
    );
    // Redireccionamos a Leer
    header('Location: lista.php');
} else {
    // Prepara SELECT
    $miConsulta = $miPDO->prepare("select codemple, empleados.nombre as nombre, apellido1, apellido2, departamentos.coddept as depart, ciudad from empleados inner join departamentos on departamento = coddept WHERE codemple = $codigo;");
    // Ejecuta consulta
    $miConsulta->execute();
}

// Obtiene un resultado
$empleado = $miConsulta->fetch();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea 3.3</title>
</head>
<body>
    <?php ponerCabecera($usuario); ?>
    <form method="post">
        <p>
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre" value="<?= $empleado['nombre'] ?>">
        </p>
        <p>
            <label for="ape1">Apellido 1</label>
            <input id="ape1" type="text" name="ape1" value="<?= $empleado['apellido1'] ?>">
        </p>
        <p>
            <label for="ape2">Apellido 1</label>
            <input id="ape2" type="text" name="ape2" value="<?= $empleado['apellido2'] ?>">
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
                    <input id="<?= $valor['nombre'] ?>" type="radio" name="departamento" value="<?= $valor['coddept'] ?>" <?= $empleado['depart']==$valor['coddept'] ? ' checked' : '' ?>> <label for="<?= $valor['nombre'] ?>"><?= $valor['nombre'] ?></label>
            <?php endforeach; ?>            
        </p>
        <p>
            <input type="hidden" name="codigo" value="<?= $codigo ?>">
            <input type="submit" value="Modificar">
        </p>
    </form>
</body>
</html>