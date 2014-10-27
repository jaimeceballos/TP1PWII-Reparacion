<?php

function listar_orden($args){
    require_once '../dao/ordenDAO.php';
    return get_ordenes($args);
}

function alta_orden($args){
    if($args['cliente_id'] == ""){
        if($args['tipo_orden_id'] == ""){
            if($args['equipo'] ==""){
                if($args['descripcion_falla'] == "" or strlen($args['descripcion_falla'])>10){
                    require_once '../dao/ordenDAO.php';
                    return orden_save($args);
                }else{
                    return "debe indicar la falla del/los equipo/s";
                }
            }else{
                return "debe seleccionar al menos un equipo";
            }
        }else{
            
        } return "debe indicar el tipo de orden a generar";
    }else{
        return "debe indicar el cliente.";
    }
}
