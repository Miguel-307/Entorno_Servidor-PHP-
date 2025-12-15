<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo registro Región</title>
</head>
<body>
    <h1>Insertar nuevo registro Región</h1>
    <form method="POST" action = "insertarRegion.php">
        <label for="descripcion">Descripción de la Región</label>
        <input type="text" name="descripcion" id="descripcion" placeholder="Introduce la descripción" required><br>
        
        <input type="submit" value="Guardar">
    </form>
    <br><a href='index.php'>Menu principal</a>
</body>
</html>