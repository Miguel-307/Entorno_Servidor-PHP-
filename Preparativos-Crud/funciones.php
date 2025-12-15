<?php
function cargar_shippers($conexion) {
    $sql = "SELECT * FROM shipper";
    return $conexion->query($sql);
}

function mostrar_tabla($datos) {
    if(!$datos || $datos->rowCount() == 0) return "<p>No hay datos.</p>";

    $res = "<h3>TABLA SHIPPERS</h3>
            <table border='1' cellpadding='5'>
            <tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Modificar</th><th>Borrar</th></tr>";

    foreach($datos as $sh) {
        $res .= "<tr>
                    <td>".$sh['shipperId']."</td>
                    <td>".$sh['companyName']."</td>
                    <td>".$sh['phone']."</td>
                    <td><a href='formulariomodificar.php?id=".$sh['shipperId']."'>Modificar</a></td>
                    <td><a href='borrar.php?id=".$sh['shipperId']."'>Borrar</a></td>
                 </tr>";
    }
    $res .= "</table><br><a href='formularioinsertar.php'>Nuevo registro</a>";
    return $res;
}

function insertar($conexion, $nombre, $telef) {
    $sql = "INSERT INTO shipper (companyName, phone) VALUES ('$nombre', '$telef')";
    return $conexion->query($sql);
}

function cargarId($conexion, $id) {
    $sql = "SELECT * FROM shipper WHERE shipperId = $id";
    return $conexion->query($sql);
}

function modificar($conexion, $id, $nombre, $telef) {
    $sql = "UPDATE shipper SET companyName='$nombre', phone='$telef' WHERE shipperId=$id";
    return $conexion->query($sql);
}

function borrar($conexion, $id) {
    $sql = "DELETE FROM shipper WHERE shipperId=$id";
    return $conexion->query($sql);
}
?>
