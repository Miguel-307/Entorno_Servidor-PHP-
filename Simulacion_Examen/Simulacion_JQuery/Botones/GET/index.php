<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados - Northwind</title>
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
        input, button {
            margin: 0 5px;
            padding: 5px;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Listado de Empleados (Northwind)</h2>

<form id="filtros">
    <input type="text" name="title" id="title" placeholder="Título">
    <input type="text" name="city" id="city" placeholder="Ciudad">
    <input type="text" name="country" id="country" placeholder="País">
    <button type="button" id="btn-filtrar">Filtrar</button> <!-- Un solo botón de filtrado -->
    <button type="button" id="btn-todos">Mostrar Todos</button>
</form>

<div id="tabla-empleados"></div>

<script>
$(document).ready(function(){

    // Función que carga los datos con filtros
    function cargarDatos() {
        $.get("filtrar.php", {
            title: $("#title").val(),
            city: $("#city").val(),
            country: $("#country").val()
        }, function(data){
            $("#tabla-empleados").html(data);
        });
    }

    // Botón Filtrar
    $("#btn-filtrar").click(function(){
        cargarDatos(); // Aplica todos los filtros a la vez
    });

    // Botón Mostrar Todos
    $("#btn-todos").click(function(){
        $("#title, #city, #country").val(''); // Limpia filtros
        cargarDatos();
    });

    // Cargar todos al iniciar
    cargarDatos();
});
</script>

</body>
</html>
