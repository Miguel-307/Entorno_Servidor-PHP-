<?php include "barra.php"; // Incluye la barra de navegación y valida sesión ?>
<h2>Menú principal</h2>

<?php
$acceso = $_SESSION['accesso'];
?>
        <ol>
            <li><a href="clientes.php">Gestión de Clientes</a></li>
            <li><a href="productos.php">Gestión de Productos</a></li>
            <li><a href="ventas.php">Gestión de Ventas</a></li>
        

<?php
    if ($acceso == "permitido") {
?>
        
            
            <li><a href="empleados.php">Gestión de Empleados</a></li>
            <li><a href="categorias.php">Gestión de Categorías</a></li>
            <li><a href="oficinas.php">Gestión de Oficinas</a></li>

<?php
}
?>
</ol>


