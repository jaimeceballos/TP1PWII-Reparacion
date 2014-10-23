<?php

function listar_orden($args){
    require_once '../dao/ordenDAO.php';
    return get_ordenes($args);
}
