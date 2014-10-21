<?php



namespace classes;

class Equipo 
{
    private $id;
    private $tipo_equipo_id;
    private $cliente_id;
    private $descripcion_equipo;
    private $estado_general;
    
    public function __construct($tipo_equipo_id, $cliente_id, $descripcion_equipo, $estado_general) {
        $this->tipo_equipo_id = $tipo_equipo_id;
        $this->cliente_id = $cliente_id;
        $this->descripcion_equipo = $descripcion_equipo;
        $this->estado_general = $estado_general;
    }

    public function getTipo_equipo_id() {
        return $this->tipo_equipo_id;
    }

    public function getCliente_id() {
        return $this->cliente_id;
    }

    public function getDescripcion_equipo() {
        return $this->descripcion_equipo;
    }

    public function getEstado_general() {
        return $this->estado_general;
    }

    public function setTipo_equipo_id($tipo_equipo_id) {
        $this->tipo_equipo_id = $tipo_equipo_id;
    }

    public function setCliente_id($cliente_id) {
        $this->cliente_id = $cliente_id;
    }

    public function setDescripcion_equipo($descripcion_equipo) {
        $this->descripcion_equipo = $descripcion_equipo;
    }

    public function setEstado_general($estado_general) {
        $this->estado_general = $estado_general;
    }


}
