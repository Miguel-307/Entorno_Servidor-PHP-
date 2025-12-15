<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>🍏 Listado de Frutas</title>
</head>
<body>
<h1>🍏 Listado de Frutas</h1>

<div id="filtros">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre">

    <label for="temporada">Temporada o Mes:</label>
    <input type="text" id="temporada" name="temporada">

    <label for="precio_min">Precio mín.:</label>
    <input type="number" id="precio_min" name="precio_min" step="0.01">

    <label for="precio_max">Precio máx.:</label>
    <input type="number" id="precio_max" name="precio_max" step="0.01">

    <button type="button" id="btnFiltrar">Filtrar</button>
</div>

<div id="resultado"></div>

<a href="index.php" class="volver">⬅ Volver al menú</a>

<script>
function updateFrutas() {
    const nombre = document.getElementById("nombre").value;
    const temporada = document.getElementById("temporada").value;
    const precio_min = document.getElementById("precio_min").value;
    const precio_max = document.getElementById("precio_max").value;

    // 🔹 CAMBIAMOS A frutas_backend.php
    const params = `nombre=${encodeURIComponent(nombre)}&temporada=${encodeURIComponent(temporada)}&precio_min=${encodeURIComponent(precio_min)}&precio_max=${encodeURIComponent(precio_max)}`;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "frutas_backend.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    document.getElementById("resultado").innerHTML = "<p class='cargando'>⏳ Cargando datos...</p>";

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.getElementById("resultado").innerHTML = xhr.responseText.trim() || "<p class='error'>❌ No se recibieron datos.</p>";
            } else {
                document.getElementById("resultado").innerHTML = "<p class='error'>❌ Error al cargar los datos (" + xhr.status + ").</p>";
            }
        }
    };

    xhr.send(params);
}

// 🔹 Cargar los datos automáticamente al abrir la página
window.addEventListener("DOMContentLoaded", updateFrutas);
document.getElementById("btnFiltrar").addEventListener("click", updateFrutas);
</script>
</body>
</html>
