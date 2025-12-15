<?php
function modificar($conexion, $id, $nombre, $telef){
    $sql = "update shipper set companyName='".$nombre."', phone='".$telef."' where shipperId=".$id;
    $res = $conexion->query($sql);
    if(!$res) {
        return false;
    }
    return true;   
}

function cargarId($conexion, $id) {
    $sql = "select * from shipper where shipperId = ".$id;
    $res = $conexion->query($sql);
    return $res;
}

function insertar($conexion, $nombre, $telef) {
    $sql = "insert into shipper (companyName,phone) VALUES ('".$nombre."','".$telef."')";
    $res = $conexion->query($sql);
    if(!$res) {
        return false;
    }
    return true;
}

function borrar($conexion, $id) {
    $sql = "delete from shipper where shipperId = ".$id;
    $res = $conexion->query($sql);
    if(!$res) {
        return false;
    }
    return true;
}

function cargar_shippers($conexion) {
    $sql = "select * from shipper";
    $res = $conexion->query($sql);
    if(!$res) {
        return null;
    }
    return $res;
}

function mostrar_tabla($datos) {
    $res="";
    if($datos->rowCount()>0) {
        $res="TABLA SHIPPERS<br>";
        $res.="<table border=1>";
        $res.="<tr><th>Id</th><th>Nombre</th><th>Teléfono</th><th>Modificar</th><th>Borrar</th></tr>";
        foreach($datos as $sh) {
            $res.="<tr><td>".$sh[0]."</td>
            <td>".$sh[1]."</td>
            <td>".$sh[2]."</td>
            <td><a href='formulariomodificar.php?id=".$sh[0]."'>Modificar</a></td>
            <td><a href='borrar.php?id=".$sh[0]."'>Eliminar</a></td></tr>";
        }
        $res.="</table><br>";
        $res.="<a href='formularioinsertar.php'>Nuevo registro</a>";
    } else {
        $res="No hay datos para mostrar.";
    }
    return $res;
}
?>