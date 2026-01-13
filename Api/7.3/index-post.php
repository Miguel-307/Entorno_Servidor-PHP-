<?php
// =================================================================
// 1. CONFIGURACIÓN Y LÓGICA (EL CEREBRO)
// =================================================================

// Incluimos el archivo que conecta a la base de datos ($pdo)
require 'db.php';

// Inicializamos variables para evitar errores de "variable indefinida"
$resultado = null; // Aquí guardaremos los datos que traiga la BD
$vista = 'menu';   // Esta variable controla qué pantalla ve el usuario: 'menu', 'tabla' o 'ficha'

// Comprobamos si el usuario ha enviado un formulario (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // --- ESCENARIO 1: El usuario pidió ver TODOS los clientes ---
    // Verificamos si el campo oculto 'accion' es igual a 'clientes'
    if (isset($_POST['accion']) && $_POST['accion'] === 'clientes') {
        
        // Hacemos la consulta SQL simple
        $stmt = $pdo->query("SELECT customerNumber, customerName, contactFirstName, phone, city, country FROM customers");
        
        // Guardamos todas las filas en el array $resultado
        $resultado = $stmt->fetchAll();
        
        // Cambiamos el estado de la vista para que abajo se dibuje la tabla
        $vista = 'tabla';
    }

    // --- ESCENARIO 2: El usuario pidió ver UN cliente específico ---
    // Verificamos si 'accion' es 'clienteporid'
    elseif (isset($_POST['accion']) && $_POST['accion'] === 'clienteporid') {
        
        // Recogemos el ID. Usamos '??' para asignar vacío si no existe el campo
        $id = $_POST['id_cliente'] ?? '';
        
        // Solo buscamos si el ID no está vacío
        if (!empty($id)) {
            // SEGURIDAD: Usamos sentencias preparadas (el signo ?)
            // Esto evita que alguien hackee la base de datos escribiendo código SQL en el input
            $stmt = $pdo->prepare("SELECT * FROM customers WHERE customerNumber = ?");
            
            // Ejecutamos la consulta pasando el ID real
            $stmt->execute([$id]);
            
            // Fetch devuelve una sola fila (porque buscamos por ID único)
            $resultado = $stmt->fetch();
            
            // Cambiamos el estado para que abajo se dibuje la ficha
            $vista = 'ficha';
        } else {
            // Si el ID estaba vacío, mostramos error y nos quedamos en el menú
            $error = "Por favor, introduce un ID válido.";
            $vista = 'menu';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicio Clientes POST</title>
    <style>
        /* Estilos CSS simples para que se vea ordenado */
        body { font-family: sans-serif; padding: 20px; background-color: #f9f9f9; }
        .container { max-width: 900px; margin: 0 auto; }
        .form-box { background: white; padding: 20px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background: #2980b9; color: white; }
        .ficha { background: white; border: 1px solid #2980b9; padding: 20px; border-radius: 8px; max-width: 500px; margin: 0 auto; }
        .btn-volver { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #2980b9; font-weight: bold; }
        button { cursor: pointer; background: #2c3e50; color: white; border: none; padding: 8px 12px; border-radius: 4px; }
    </style>
</head>
<body>
<div class="container">

    <?php if ($vista === 'tabla'): ?>
        
        <a href="index-post.php" class="btn-volver">← Volver al menú</a>
        
        <h2>Listado Completo (Vía POST)</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empresa</th>
                    <th>Contacto</th>
                    <th>Ciudad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['customerNumber']) ?></td>
                    <td><?= htmlspecialchars($row['customerName']) ?></td>
                    <td><?= htmlspecialchars($row['contactFirstName']) ?></td>
                    <td><?= htmlspecialchars($row['city']) ?></td>
                    <td>
                        <form method="POST" action="index-post.php" style="margin:0;">
                            <input type="hidden" name="accion" value="clienteporid">
                            <input type="hidden" name="id_cliente" value="<?= $row['customerNumber'] ?>">
                            <button type="submit" style="padding: 5px 10px; font-size: 12px;">Ver Ficha</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php elseif ($vista === 'ficha'): ?>
        
        <a href="index-post.php" class="btn-volver">← Volver al menú</a>
        
        <?php if ($resultado): ?>
            <div class="ficha">
                <h2>👤 <?= htmlspecialchars($resultado['customerName']) ?></h2>
                <p><strong>ID:</strong> <?= $resultado['customerNumber'] ?></p>
                <p><strong>Contacto:</strong> <?= htmlspecialchars($resultado['contactFirstName']) ?> <?= htmlspecialchars($resultado['contactLastName']) ?></p>
                <hr>
                <p><strong>Ciudad:</strong> <?= htmlspecialchars($resultado['city']) ?></p>
                <p><strong>País:</strong> <?= htmlspecialchars($resultado['country']) ?></p>
                <p><strong>Crédito:</strong> <?= number_format($resultado['creditLimit'], 2, ',', '.') ?> €</p>
            </div>
        <?php else: ?>
            <p style="color:red">Error: No se encontró ningún cliente con ese ID.</p>
        <?php endif; ?>

    <?php else: ?>
        
        <h1>Gestión de Clientes (Método POST)</h1>
        
        <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

        <div class="form-box">
            <h3>Opción 1: Obtener todos los clientes</h3>
            <form method="POST" action="index-post.php">
                <input type="hidden" name="accion" value="clientes">
                <button type="submit">Cargar Tabla de Clientes</button>
            </form>
        </div>

        <div class="form-box">
            <h3>Opción 2: Obtener cliente por ID</h3>
            <form method="POST" action="index-post.php">
                <input type="hidden" name="accion" value="clienteporid">
                <label>Introduce ID del cliente:</label>
                <input type="text" name="id_cliente" placeholder="Ej: 103" required style="padding:8px;">
                <button type="submit">Buscar Cliente</button>
            </form>
        </div>
    <?php endif; ?>

</div>
</body>
</html>