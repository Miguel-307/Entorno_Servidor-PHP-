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
    $sql = "SELECT custId, companyName, contactName, contactTitle, address, city, region, postalCode, country, phone, mobile, email, fax
            FROM Customer";

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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea 3.3 - Listado de Clientes con Filtros</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        h1 { color: orange; }
        table { border-collapse: collapse; width: 100%; background-color: white; margin-top: 15px; }
        th, td { border: 1px solid orange; text-align: center; padding: 8px; }
        th { background-color: orange; color: white; }
        input { margin-right: 10px; padding: 5px; }
        button { padding: 6px 12px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>

<h1>Listado de Clientes</h1>

<!-- === FORMULARIO GET === -->
<form method="get">
    <input type="text" name="cia" placeholder="Cía" value="<?= htmlspecialchars($_GET['cia'] ?? '') ?>">
    <input type="text" name="nombre" placeholder="Nombre" value="<?= htmlspecialchars($_GET['nombre'] ?? '') ?>">
    <input type="text" name="ciudad" placeholder="Ciudad" value="<?= htmlspecialchars($_GET['ciudad'] ?? '') ?>">
    <input type="text" name="pais" placeholder="País" value="<?= htmlspecialchars($_GET['pais'] ?? '') ?>">
    <button type="submit">Buscar (GET)</button>
</form>

<!-- === FORMULARIO POST (AJAX) === -->
<div style="margin-top: 15px;">
    <input type="text" id="cia" placeholder="Cía">
    <input type="text" id="nombre" placeholder="Nombre">
    <input type="text" id="ciudad" placeholder="Ciudad">
    <input type="text" id="pais" placeholder="País">
    <button type="button" onclick="filtrarPOST()">Buscar (POST)</button>
</div>

<!-- === TABLA === -->
<table id="tablaClientes">
    <tr>
        <th>custId</th>
        <th>companyName</th>
        <th>contactName</th>
        <th>contactTitle</th>
        <th>address</th>
        <th>city</th>
        <th>region</th>
        <th>postalCode</th>
        <th>country</th>
        <th>phone</th>
        <th>mobile</th>
        <th>email</th>
        <th>fax</th>
    </tr>
    <?php foreach ($clientes as $valor): ?>
        <tr>
            <td><?= htmlspecialchars($valor['custId'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['companyName'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['contactName'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['contactTitle'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['address'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['city'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['region'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['postalCode'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['country'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['phone'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['mobile'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['email'] ?? '') ?></td>
            <td><?= htmlspecialchars($valor['fax'] ?? '') ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- === SCRIPT PARA POST === -->
<script>
function filtrarPOST() {
  const filtros = {
    cia: document.getElementById('cia').value,
    nombre: document.getElementById('nombre').value,
    ciudad: document.getElementById('ciudad').value,
    pais: document.getElementById('pais').value
  };

  fetch('', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify(filtros)
  })
  .then(res => res.json())
  .then(data => {
    const tabla = document.getElementById('tablaClientes');

    //  Reescribimos toda la tabla (cabecera + filas)
    let html = `
    <thead>
        <tr>
        <th>custId</th>
        <th>companyName</th>
        <th>contactName</th>
        <th>contactTitle</th>
        <th>address</th>
        <th>city</th>
        <th>region</th>
        <th>postalCode</th>
        <th>country</th>
        <th>phone</th>
        <th>mobile</th>
        <th>email</th>
        <th>fax</th>
        </tr>
    </thead>
    <tbody>
    `;

    //  Añadimos las filas de datos
    data.forEach(c => {
    html += `
        <tr>
        <td>${c.custId ?? ''}</td>
        <td>${c.companyName ?? ''}</td>
        <td>${c.contactName ?? ''}</td>
        <td>${c.contactTitle ?? ''}</td>
        <td>${c.address ?? ''}</td>
        <td>${c.city ?? ''}</td>
        <td>${c.region ?? ''}</td>
        <td>${c.postalCode ?? ''}</td>
        <td>${c.country ?? ''}</td>
        <td>${c.phone ?? ''}</td>
        <td>${c.mobile ?? ''}</td>
        <td>${c.email ?? ''}</td>
        <td>${c.fax ?? ''}</td>
        </tr>
    `;
    });

    html += '</tbody>';
    tabla.innerHTML = html; 
});
}
</script>


</body>
</html>
