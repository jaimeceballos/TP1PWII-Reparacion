<?php

function listar_equipos($usuario,$password){
  require_once '../dao/equipoDAO.php';
  return get_equipos($usuario,$password);
}

function alta_equipo($args){
     if($args['tipo_equipo_id'] != ''){
         if($args['cliente_id'] != ''){
             if($args['descripcion_equipo'] != ''){
                 if($args['estado_general'] != ''){
                     
                 }else{
                     return "debe ingresar el estado general del equipo recibido";
                 }
             }else{
                 return "debe ingresar las caracteristicas tecnicas del equipo";
             }
         }else{
             return "debe indicar un cliente como propietario";
         }
     }else{
         return 'debe indicar el tipo de equipo';
     }
}
