<?php

function listar_tipos_orden($args){
  require_once '../dao/tipo_ordenDAO.php';
  return get_tipos_orden($args);
}