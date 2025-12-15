<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas (AJAX jQuery estilo Miguel)</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>🧾 Listado de Ventas (AJAX con jQuery)</h1>

<!-- FILTRO -->
<div id="filter">
    <form id="formulario">

            <label for="factura">Factura:</label>
            <input type="text" id="factura" name="factura" onkeyup="updateVentas()">

            <label for="empleado">Empleado:</label>
            <input type="text" id="empleado" name="empleado" onkeyup="updateVentas()">

            <label for="cliente">Cliente:</label>
            <input type="text" id="cliente" name="cliente" onkeyup="updateVentas()">

            <label for="fruta">Fruta:</label>
            <input type="text" id="fruta" name="fruta" onkeyup="updateVentas()">

    </form>
</div>

<!-- TABLA -->
<table>
    <thead>
        <tr>
            <th>Factura</th>
            <th>Empleado</th>
            <th>Cliente</th>
            <th>Fruta</th>
            <th>Cantidad</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody id="tbody">
        <!-- Aquí jQuery insertará las filas -->
    </tbody>
</table>

<a href="index.php" class="volver">⬅ Volver al menú</a>

<script>
function updateVentas() {
    var filtros = {
        factura: $('#factura').val(),
        empleado: $('#empleado').val(),
        cliente: $('#cliente').val(),
        fruta: $('#fruta').val()
    };

    $.ajax({
        type: "GET",
        url: "ventas_backend.php", // archivo PHP que devuelve las filas
        data: filtros,
        cache: false,
        success: function(data) {
            $('#tbody').html(data);
        },
        error: function() {
            $('#tbody').html("<tr><td colspan='6' class='error'>Error al cargar los datos</td></tr>");
        }
    });
}

// Cargar datos al abrir la página
$(document).ready(function() {
    updateVentas();
});
</script>
</body>
</html>
