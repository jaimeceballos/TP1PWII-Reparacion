<?php



namespace classes;


class Empleado 
{
    private $id;
    private $persona_id;
    
    public function getPersona_id() {
        return $this->persona_id;
    }

    public function setPersona_id($persona_id) {
        $this->persona_id = $persona_id;
    }




}
