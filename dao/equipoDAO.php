<?php

function get_equipos($usuario, $password) {
    $conn = Connection::userConnection($usuario, $password);
    if ($conn !== false) {
        try {
            $sql = "select e.id, te.descripcion as tipo_equipo_id, p.ape_nom as cliente_id, e.descripcion_equipo 
                from equipo e join  tipo_equipo te on e.tipo_equipo_id = te.id 
                join cliente c on e.cliente_id = c.id join persona p on c.persona_id = p.id where c.activo and not e.baja";

            $stmt = $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            return -1;
        }
    }
}

function equipo_save($args) {
    
    $conn = Connection::userConnection($args['usuario'], $args['password']);
    if ($conn !== false) {
        (!empty($args['id'])) ? $id = $args['id'] : $id=false;
            
        if ($id === false) {
            try {
                $conn->beginTransaction();
                $sql = "INSERT INTO equipo(tipo_equipo_id,cliente_id,descripcion_equipo,estado_general) values(:tipo_equipo,:cliente,:descripcion,:estado)";
                $query = $conn->prepare($sql);
                $query->execute(array(':tipo_equipo' => $args['tipo_equipo_id'],
                                      ':cliente' => $args['cliente_id'],
                                      ':descripcion' => $args['descripcion_equipo'],
                                      ':estado' => $args['estado_general']));
                $conn->commit();
                return 1;
            } catch (PDOException $e) {
                $conn->rollBack();
                return 0;
            }
        } elseif ($id > 0) {
            try {
                $conn->beginTransaction();
                $sql = "UPDATE equipo set tipo_equipo_id=:tipo_equipo_id, cliente_id=:cliente_id, descripcion_equipo=:descripcion_equipo, estado_general=:estado_general where id=:id";
                $query = $conn->prepare($sql);
                $query->execute(array(':tipo_equipo_id' => $args['tipo_equipo_id'],
                                      ':cliente_id' => $args['cliente_id'],
                                      ':descripcion_equipo' => $args['descripcion_equipo'],
                                      ':estado_general' => $args['estado_general'],
                                      ':id' => $id
                                       ));
                $conn->commit();
                return 1;
            } catch (PDOException $e) {
                $conn->rollBack();
                return 0;
            }
        }
        return 0;
    }
}

function get_equipo_by_id($args) {
    $coneccion = Connection::userConnection($args['usuario'], $args['password']);
    if ($coneccion !== false) {
        try {
            $sql = "select id, tipo_equipo_id, cliente_id, descripcion_equipo, estado_general "
                    . "from equipo where id = :id";

            $stmt = $coneccion->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->bindParam(':id', $args['id']);
            $stmt->execute();
            $results = $stmt->fetch();
            return $results;
        } catch (PDOException $e) {
            return -1;
        }
    }
}

function del_equipo_by_id($args){
    $coneccion = Connection::getConn();
    if(!$coneccion){
        $coneccion = Connection::userConnection($args['usuario'], $args['password']);
    }
    if ($coneccion !== false) {
        try {
            $coneccion->beginTransaction();
            $sql = "UPDATE equipo set baja = 1 WHERE id = :id";

            $stmt = $coneccion->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':id', $args['id']);
            $stmt->execute();
            $coneccion->commit();
            return 1;
        } catch (PDOException $e) {
            $coneccion->rollBack();
            return -1;
        }
    }
}