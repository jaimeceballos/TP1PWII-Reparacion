<?php

namespace classes;

class TipoOrden 
{
   private $id;
   private $descripcion;
   
   public function __construct($descripcion) {
       $this->descripcion = $descripcion;
   }

   
   public function getDescripcion() {
       return $this->descripcion;
   }

   public function setDescripcion($descripcion) {
       $this->descripcion = $descripcion;
   }


}
