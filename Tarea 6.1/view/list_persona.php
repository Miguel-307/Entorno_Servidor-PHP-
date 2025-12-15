<div class="row">
    <div class="col-md-12 text-right">
        <a href="index.php?controller=persona&action=edit" class="btn btn-outline-primary">Crear Persona</a>
        <hr/>
    </div>
    
    <?php if(count($dataToView["data"])>0){ 
        foreach($dataToView["data"] as $persona){ // Iteramos sobre 'persona'
    ?>
    <div class="col-md-4">
        <div class="card-body border border-secondary rounded mb-3">
            <h5 class="card-title"><?php echo $persona['nombre']; ?></h5>
            <div class="card-text">NIF: **<?php echo $persona['nif']; ?>**</div>
            
            <hr class="mt-1"/>
            <a href="index.php?controller=persona&action=edit&id=<?php echo $persona['id']; ?>" class="btn btn-primary">Editar</a>
            <a href="index.php?controller=persona&action=confirmDelete&id=<?php echo $persona['id']; ?>" class="btn btn-danger">Eliminar</a>
        </div>
    </div>
    <?php } 
    }else{ ?>
    <div class="alert alert-info"> 
        Actualmente no existen personas registradas. 
    </div>
    <?php } ?>
</div>