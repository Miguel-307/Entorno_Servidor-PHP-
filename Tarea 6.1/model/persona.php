<?php
// Asegúrate de que db.php está requerido si aún no lo está
// require_once 'model/db.php'; 

class Persona {
    private $table = 'persona';
    private $conection;

    public function __construct() {}

    /* Set conection */
    public function getConection(){
        $dbObj = new Db(); // Asume que la clase Db está disponible
        $this->conection = $dbObj->conection;
    }

    /* Get all personas */
    public function getPersonas(){
        $this->getConection();
        $sql = "SELECT * FROM ".$this->table;
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* Get persona by id */
    public function getPersonaById($id){
        if(is_null($id)) return false;
        $this->getConection();
        $sql = "SELECT * FROM ".$this->table. " WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /* Save persona (Create or Update) */
    public function save($param){
        $this->getConection();

        /* Set default values */
        $id = null;
        $nombre = $nif = "";

        /* Check if exists */
        $exists = false;
        if(isset($param["id"]) and $param["id"] !=''){
            $actualPersona = $this->getPersonaById($param["id"]);
            if(isset($actualPersona["id"])){
                $exists = true;
                /* Actual values */
                $id = $param["id"];
                $nombre = $actualPersona["nombre"];
                $nif = $actualPersona["nif"];
            }
        }

        /* Received values */
        if(isset($param["nombre"])) $nombre = $param["nombre"];
        if(isset($param["nif"])) $nif = $param["nif"]; // ¡Nuevo campo!

        /* Database operations */
        if($exists){
            // UPDATE
            $sql = "UPDATE ".$this->table. " SET nombre=?, nif=? WHERE id=?";
            $stmt = $this->conection->prepare($sql);
            $res = $stmt->execute([$nombre, $nif, $id]);
        }else{
            // INSERT
            $sql = "INSERT INTO ".$this->table. " (nombre, nif) values(?, ?)";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$nombre, $nif]);
            $id = $this->conection->lastInsertId();
        }
        return $id;
    }

    /* Delete persona by id */
    public function deletePersonaById($id){
        $this->getConection();
        $sql = "DELETE FROM ".$this->table. " WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>