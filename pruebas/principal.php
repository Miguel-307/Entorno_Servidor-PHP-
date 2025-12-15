<?php
include 'conector.php';

try {
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // --- FILTROS GET ---
    $filtros = [];
    $parametros = [];

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (!empty($_GET['cia'])) {
            $filtros[] = "companyName LIKE :cia";
            $parametros[':cia'] = "%" . $_GET['cia'] . "%";
        }
        if (!empty($_GET['nombre'])) {
            $filtros[] = "contactName LIKE :nombre";
            $parametros[':nombre'] = "%" . $_GET['nombre'] . "%";
        }
        if (!empty($_GET['ciudad'])) {
            $filtros[] = "city LIKE :ciudad";
            $parametros[':ciudad'] = "%" . $_GET['ciudad'] . "%";
        }
        if (!empty($_GET['pais'])) {
            $filtros[] = "country LIKE :pais";
            $parametros[':pais'] = "%" . $_GET['pais'] . "%";
        }
    }

    // --- FILTROS POST (para AJAX) ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data['cia'])) {
            $filtros[] = "companyName LIKE :cia";
            $parametros[':cia'] = "%" . $data['cia'] . "%";
        }
        if (!empty($data['nombre'])) {
            $filtros[] = "contactName LIKE :nombre";
            $parametros[':nombre'] = "%" . $data['nombre'] . "%";
        }
        if (!empty($data['ciudad'])) {
            $filtros[] = "city LIKE :ciudad";
            $parametros[':ciudad'] = "%" . $data['ciudad'] . "%";
        }
        if (!empty($data['pais'])) {
            $filtros[] = "country LIKE :pais";
            $parametros[':pais'] = "%" . $data['pais'] . "%";
        }
    }

    // --- CONSULTA PRINCIPAL ---
    $sql = "SELECT employeeld , lastname, firstname,title,city,country,postalCode
            FROM Employee";

    if (!empty($filtros)) {
        $sql .= " WHERE " . implode(" AND ", $filtros);
    }

    $miConsulta = $miPDO->prepare($sql);
    $miConsulta->execute($parametros);
    $clientes = $miConsulta->fetchAll();

    // Si viene de POST (AJAX), devolver JSON y salir
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo json_encode($clientes);
        exit;
    }

} catch (PDOException $e) {
    die("Error en la conexión o consulta: " . $e->getMessage());
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtros propio</title>
</head>
<body>
        <div class="Container ">
    <h2>Tabla Empleados</h2>

    <form id="formulario">
        <input type="number" id="numero" name="numero" placeholder="Introduce un número">
        <input type="submit" value="Calcular">
    </form><br>

    <div id="resultado"></div>
    </div>
</body>
</html>