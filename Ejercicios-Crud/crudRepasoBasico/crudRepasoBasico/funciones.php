<?php

    function cargarRegion($conexion){
        $sql = "SELECT regionId, regionDescription FROM Region";
        $res = $conexion->query($sql);
        
        if(!$res){
            return null;
        }

        return $res;
    }

    function mostrarTablaRegion($datos){
        $res = "";
        if($datos->rowCount()>0){
            $res = "<h2>TABLA REGION</h2>";
            $res.= "<table border = 1>";
            $res.= "<tr><th>ID</th><th>Descripción</th><th>Modificar</th><th>Borrar</th></tr>";
            foreach($datos as $reg){
                $res.= "<tr><td>".$reg['regionId']."</td><td>".$reg['regionDescription']."</td><td><a href = 'formularioModificarRegion.php?id=".$reg['regionId']."'>Modificar</a></td><td><a href = 'formularioBorrarRegion.php?id=".$reg['regionId']."'>Borrar</a></td></tr>";
            }
            $res.= "</table><br>";
            $res.= "<a href='formularioInsertarRegion.php'>Nuevo registro Region</a>";
        }else{
            $res = "No hay datos de Región para mostrar";
        }

        return $res;
    }

    function borrarRegion($conexion, $id){
        // Usamos una consulta preparada para seguridad, aunque tu estilo no lo use,
        // es una buena práctica especialmente para IDs que pueden estar involucrados en FKs.
        $sql = "DELETE FROM Region WHERE regionId = :id";
        $stmt = $conexion->prepare($sql);
        $res = $stmt->execute([':id' => $id]);
        
        return $res; // Devuelve true/false basado en el éxito de execute
    }

    function insertarRegion($conexion, $regionDescription){
        // Como regionId no es AUTO_INCREMENT en tu DDL, es obligatorio.
        // Simularemos encontrar el próximo ID o lo pediremos en el formulario.
        // Para seguir el patrón de tu CRUD, vamos a simular el ID:
        
        $sql_max_id = "SELECT MAX(regionId) AS maxId FROM Region";
        $stmt_max = $conexion->query($sql_max_id);
        $max_id = $stmt_max->fetch(PDO::FETCH_ASSOC)['maxId'];
        $new_id = $max_id + 1;

        $sql = "INSERT INTO Region (regionId, regionDescription) VALUES (:new_id, :description)";
        $stmt = $conexion->prepare($sql);
        
        $res = $stmt->execute([
            ':new_id' => $new_id,
            ':description' => $regionDescription
        ]);

        return $res;
    }

    function cargarIdRegion($conexion, $id){
        $sql = "SELECT regionId, regionDescription FROM Region WHERE regionId = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt;
    }

    function modificarRegion($conexion, $id, $regionDescription){
        $sql = "UPDATE Region SET regionDescription = :description WHERE regionId = :id";
        $stmt = $conexion->prepare($sql);
        $res = $stmt->execute([
            ':description' => $regionDescription,
            ':id' => $id
        ]);
        if(!$res){
            return false;
        }
        return true;
    }
?>