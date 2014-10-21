<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace classes;

/**
 * Description of EquipoOrdenTrabajo
 *
 * @author jaime
 */
class EquipoOrdenTrabajo {
    private $id;
    private $equipo_id;
    private $orden_trabajo_id;

    public function __construct($equipo_id, $orden_trabajo_id) {
        $this->equipo_id = $equipo_id;
        $this->orden_trabajo_id = $orden_trabajo_id;
    }

    
    public function getEquipo_id() {
        return $this->equipo_id;
    }

    public function getOrden_trabajo_id() {
        return $this->orden_trabajo_id;
    }

    public function setEquipo_id($equipo_id) {
        $this->equipo_id = $equipo_id;
    }

    public function setOrden_trabajo_id($orden_trabajo_id) {
        $this->orden_trabajo_id = $orden_trabajo_id;
    }


}
