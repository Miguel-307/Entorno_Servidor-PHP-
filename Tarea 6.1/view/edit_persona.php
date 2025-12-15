<?php 
$id = $nombre = $nif = "";
if(isset($dataToView["data"]["id"])) $id = $dataToView["data"]["id"];
if(isset($dataToView["data"]["nombre"])) $nombre = $dataToView["data"]["nombre"]; // Nuevo
if(isset($dataToView["data"]["nif"])) $nif = $dataToView["data"]["nif"]; // Nuevo
?>
<div class="row">
    <?php if(isset($_GET["response"]) and $_GET["response"] === true){ ?>
    <div class="alert alert-success"> 
        Operación realizada correctamente. 
        <a href="index.php?controller=persona&action=list">Volver al listado</a> 
    </div>
    <?php } ?>
    
    <form class="form" action="index.php?controller=persona&action=save" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        
        <div class="form-group">
            <label>Nombre</label>
            <input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>" required />
        </div>
        
        <div class="form-group mb-2">
            <label>NIF</label>
            <input class="form-control" type="text" name="nif" value="<?php echo $nif; ?>" required maxlength="10" />
        </div>
        
        <input type="submit" value="Guardar" class="btn btn-primary"/>
        <a class="btn btn-outline-danger" href="index.php?controller=persona&action=list">Cancelar</a>
    </form>
</div>