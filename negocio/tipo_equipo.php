<?php

function listar_tipos_equipo($usuario,$password){
  require_once '../dao/tipo_equipoDAO.php';
  return get_tipos_equipo($usuario,$password);
}