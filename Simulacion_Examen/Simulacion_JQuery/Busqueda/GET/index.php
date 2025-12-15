<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados - Northwind (GET)</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #ddd;
        }
        form {
            text-align: center;
            margin: 20px;
        }
        input {
            margin: 0 5px;
            padding: 5px;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Listado de Empleados (Northwind - GET)</h2>

<form id="filtros">
    <input type="text" name="title" id="title" placeholder="Título">
    <input type="text" name="city" id="city" placeholder="Ciudad">
    <input type="text" name="country" id="country" placeholder="País">
</form>

<div id="tabla-empleados"></div>

<script>
$(document).ready(function(){
    // Función que carga los empleados según los filtros
    function cargarDatos() {
        $.get("filtrar.php", {
            title: $("#title").val(),
            city: $("#city").val(),
            country: $("#country").val()
        }, function(data){
            $("#tabla-empleados").html(data);
        });
    }

    // Cargar todos los empleados al iniciar
    cargarDatos();

    // Actualizar la tabla cada vez que se cambia un filtro
    $("#title, #city, #country").on("keyup change", function(){
        cargarDatos();
    });
});
</script>

</body>
</html>
