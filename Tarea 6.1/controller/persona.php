<?php
require_once 'model/persona.php'; // Requiere el nuevo modelo

class personaController{ // Nombre de la clase adaptado
    public $page_title;
    public $view;
    public $personaObj; // Objeto del modelo Persona

    public function __construct() {
        $this->view = 'list_persona'; // Vista por defecto adaptada
        $this->page_title = '';
        $this->personaObj = new Persona();
    }

    /* List all personas */
    public function list(){
        $this->page_title = 'Listado de Personas';
        return $this->personaObj->getPersonas(); // Llama al nuevo método
    }

    /* Load persona for edit */
    public function edit($id = null){
        $this->page_title = 'Editar Persona';
        $this->view = 'edit_persona'; // Vista adaptada
        if(isset($_GET["id"])) $id = $_GET["id"];
        return $this->personaObj->getPersonaById($id); // Llama al nuevo método
    }

    /* Create or update persona */
    public function save(){
        $this->view = 'edit_persona';
        $this->page_title = 'Editar Persona';
        $id = $this->personaObj->save($_POST); // Usa el método save del modelo Persona
        $result = $this->personaObj->getPersonaById($id);
        $_GET["response"] = true;
        return $result;
    }

    /* Confirm to delete */
    public function confirmDelete(){
        $this->page_title = 'Eliminar Persona';
        $this->view = 'confirm_delete_persona'; // Vista adaptada
        return $this->personaObj->getPersonaById($_GET["id"]);
    }

    /* Delete */
    public function delete(){
        $this->page_title = 'Listado de Personas';
        $this->view = 'delete_persona'; // Vista adaptada
        return $this->personaObj->deletePersonaById($_POST["id"]); // Llama al nuevo método
    }
}
?>