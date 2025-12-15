<?php
include 'bd.php';
include 'cab.php';

// Conecta con base de datos
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
// Prepara SELECT
$miConsulta = $miPDO->prepare('select codemple, empleados.nombre as nombre, apellido1, apellido2, departamentos.nombre as depart, ciudad from empleados inner join departamentos on departamento = coddept;');
// Ejecuta consulta
$miConsulta->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarea 3.3</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table td {
            border: 1px solid orange;
            text-align: center;
            padding: 1.3rem;
        }
        .button {
            border-radius: .5rem;
            color: white;
            background-color: orange;
            padding: 1rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php ponerCabecera($usuario); ?>
    <p><a class="button" href="nuevo.php">Crear</a></p>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido 1</th>
            <th>Apellido 2</th>
            <th>Deparmento</th>
            <th>Ciudad</th>
            <td></td>
            <td></td>
        </tr>
    <?php foreach ($miConsulta as $clave => $valor): ?> 
        <tr>
           <td><?= $valor['nombre']; ?></td>
           <td><?= $valor['apellido1']; ?></td>
           <td><?= $valor['apellido2']; ?></td>
           <td><?= $valor['depart'] ?></td>
           <td><?= $valor['ciudad'] ?></td>
           <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
           <td><a class="button" href="modificar.php?codigo=<?= $valor['codemple'] ?>">Modificar</a></td>
           <td><a class="button" href="borrar.php?codigo=<?= $valor['codemple'] ?>">Borrar</a></td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>