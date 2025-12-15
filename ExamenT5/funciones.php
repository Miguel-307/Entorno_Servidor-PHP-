<?php
require_once "conexion.php";

// =========================================================
// FUNCIONES DE CATEGORÍAS
// =========================================================

// Insertar nueva categoría
function insertarCategoria($conexion, $nombre) {
    $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute([":nombre" => $nombre]);
}

// Cargar una categoría por su ID
function cargarCategoria($conexion, $id) {
    $sql = "SELECT id, nombre FROM categorias WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt;
}

// Modificar el nombre de una categoría existente
function modificarCategoria($conexion, $id, $nombre) {
    $sql = "UPDATE categorias SET nombre = :nombre WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute([":nombre" => $nombre, ":id" => $id]);
}

// Borrar categoría + sus cangrejos asociados manualmente
function borrarCategoria($conexion, $id) {
    try {
        // Primero borramos los cangrejos relacionados
        $sql1 = "DELETE FROM cangrejos WHERE categoria = :id";
        $stmt1 = $conexion->prepare($sql1);
        $stmt1->execute([":id" => $id]);

        // Luego la categoría
        $sql2 = "DELETE FROM categorias WHERE id = :id";
        $stmt2 = $conexion->prepare($sql2);
        $stmt2->execute([":id" => $id]);

        if ($stmt2->rowCount() > 0) {
            echo "<p style='color:green;'>✅ Categoría y cangrejos asociados eliminados correctamente.</p>";
            return true;
        } else {
            echo "<p style='color:red;'>⚠️ No existe ninguna categoría con ese ID.</p>";
            return false;
        }
    } catch (PDOException $e) {
        echo "<p style='color:red;'>❌ Error al borrar: " . $e->getMessage() . "</p>";
        return false;
    }
}
?>
