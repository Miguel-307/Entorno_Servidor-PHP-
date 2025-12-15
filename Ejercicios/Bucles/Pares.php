<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;  
            text-aling:center;
            padding: 10px;}
            </style>
</head>
<body>
    <table>
            <thead><h1>Tabla pares</h1></thead>

                 <?php
            for ($i=1; $i <= 100 ; $i++) { 
                if ($i % 2 == 0) {
                    echo"<th> $i</th>";
                }
            }
        ?>
 
</table>
<ul>
    <h1>Tabla impares</h1>
        <?php
            for ($i=1; $i <= 100 ; $i++) { 
                if ($i % 2 != 0) {
                    echo"<li> $i</li>";
                }
            }
        ?>
</body>
</html>