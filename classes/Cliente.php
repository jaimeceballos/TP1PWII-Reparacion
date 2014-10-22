<?php
namespace classes;
 class Cliente extends Persona
 {
     private $id;
     private $persona_id;
     private $activo = 1;
     
     public function getPersona_id() {
         return $this->persona_id;
     }

     public function setPersona_id($persona_id) {
         $this->persona_id = $persona_id;
     }
     public function getActivo() {
         return $this->activo;
     }
     public function setActivo($activo){
         $this->activo = $activo;
     }
 }