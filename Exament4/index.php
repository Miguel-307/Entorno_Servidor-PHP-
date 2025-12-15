<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Customers</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #e8e8e8;
        }
        form {
            text-align: center;
            margin: 20px;
        }
        input, button {
            margin: 5px;
            padding: 6px;
        }
        button {
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Listado de Customers</h2>

<form id="filtros">
    <input type="text" id="customerName" placeholder="Customer Name">
    <input type="text" id="city" placeholder="City">
    <input type="text" id="country" placeholder="Country">
    <input type="number" id="creditLimit" placeholder="Credit Limit (<=)">
    <button type="button" id="btn-filtrar">Filtrar</button>
    <button type="button" id="btn-todos">Mostrar Todos</button>
</form>

<div id="tabla-clientes"></div>

<script>
$(document).ready(function() {

    function cargarClientes(filtros = {}) {
        $.ajax({
            type: "GET",
            url: "filtro.php", 
            data: filtros,
            cache: false,
            success: function(data) {
                $('#tabla-clientes').html(data);
            },
            error: function() {
                $('#tabla-clientes').html("<p style='text-align:center;color:red;'>Error al cargar los datos.</p>");
            }
        });
    }

    $('#btn-filtrar').click(function() {
        const filtros = {
            customerName: $('#customerName').val(),
            city: $('#city').val(),
            country: $('#country').val(),
            creditLimit: $('#creditLimit').val()
        };
        cargarClientes(filtros);
    });

    $('#btn-todos').click(function() {
        $('#customerName, #city, #country, #creditLimit').val('');
        cargarClientes();
    });

    cargarClientes();
});
</script>

</body>
</html>
