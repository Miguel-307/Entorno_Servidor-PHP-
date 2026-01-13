<?php
// index.php
require 'db.php';

// Obtenemos la acción de la URL (por defecto mostramos el menú)
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'menu';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicio Web Clientes</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f4f4; }
        h1 { color: #333; }
        
        /* Estilos para la TABLA */
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #2c3e50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        
        /* Estilos para la FICHA (CARD) */
        .ficha { 
            background: white; border: 1px solid #ccc; padding: 20px; 
            max-width: 500px; margin: 20px auto; border-radius: 8px; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .ficha h2 { border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        .ficha p { margin: 8px 0; }
        .label { font-weight: bold; color: #555; }
        
        /* Botón de volver */
        .btn { 
            display: inline-block; padding: 10px 15px; background: #2980b9; 
            color: white; text-decoration: none; border-radius: 4px; margin-bottom: 15px;
        }
        .btn:hover { background: #3498db; }
    </style>
</head>
<body>

<?php if ($accion == 'clientes'): ?>
    <a href="index-get.php" class="btn">← Volver al inicio</a>
    <h1>Listado de Clientes (Tabla)</h1>
    
    <?php
    $stmt = $pdo->query("SELECT customerNumber, customerName, contactFirstName, phone, city, country FROM customers");
    ?>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th>País</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch()): ?>
            <tr>
                <td><?= htmlspecialchars($row['customerNumber']) ?></td>
                <td><?= htmlspecialchars($row['customerName']) ?></td>
                <td><?= htmlspecialchars($row['contactFirstName']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['city']) ?></td>
                <td><?= htmlspecialchars($row['country']) ?></td>
                <td>
                    <a href="index-get.php?accion=clienteporid&id=<?= $row['customerNumber'] ?>">Ver Ficha</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

<?php elseif ($accion == 'clienteporid'): ?>
    <a href="index-get.php?accion=clientes" class="btn">← Volver al listado</a>
    
    <?php
    // Validamos que venga el ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Usamos sentencias preparadas para seguridad (evitar inyección SQL)
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE customerNumber = ?");
        $stmt->execute([$id]);
        $cliente = $stmt->fetch();

        if ($cliente): 
    ?>
            <div class="ficha">
                <h2>Ficha del Cliente #<?= $cliente['customerNumber'] ?></h2>
                <p><span class="label">Nombre Empresa:</span> <?= htmlspecialchars($cliente['customerName']) ?></p>
                <p><span class="label">Contacto:</span> <?= htmlspecialchars($cliente['contactFirstName']) ?> <?= htmlspecialchars($cliente['contactLastName']) ?></p>
                <p><span class="label">Teléfono:</span> <?= htmlspecialchars($cliente['phone']) ?></p>
                <hr>
                <p><span class="label">Dirección:</span> <?= htmlspecialchars($cliente['addressLine1']) ?></p>
                <p><span class="label">Ciudad:</span> <?= htmlspecialchars($cliente['city']) ?></p>
                <p><span class="label">Código Postal:</span> <?= htmlspecialchars($cliente['postalCode']) ?></p>
                <p><span class="label">País:</span> <?= htmlspecialchars($cliente['country']) ?></p>
                <hr>
                <p><span class="label">Límite de Crédito:</span> <?= number_format($cliente['creditLimit'], 2) ?> €</p>
            </div>
    <?php 
        else:
            echo "<p style='color:red; text-align:center;'>Cliente no encontrado.</p>";
        endif;
    } else {
        echo "<p>No se ha especificado un ID.</p>";
    }
    ?>

<?php else: ?>
    <h1>Bienvenido al Servicio Web</h1>
    <p>Selecciona una opción:</p>
    <ul>
        <li><a href="index-get.php?accion=clientes">Ver todos los clientes (Endpoint 1)</a></li>
        <li><a href="index-get.php?accion=clienteporid&id=103">Ver Cliente con ID 103 (Endpoint 2)</a></li>
    </ul>

<?php endif; ?>

</body>
</html>