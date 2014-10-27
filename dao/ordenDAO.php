<?php

function get_ordenes($args){
    $conn = Connection::getConn();
    if(!$conn){
        $conn = Connection::userConnection($args['usuario'], $args['password']);
    }
    if ($conn !== false) {
        try {
            $sql = "select ot.id, p.ape_nom, tor.descripcion, ot.fecha_entrada,"
                    . "ot.descripcion_falla,ot.trabajo_realizado,ot.fecha_finalizado,"
                    . "ot.fecha_salida,ot.importe_trabajo,ot.nro_factura,ot.remito_entrega,"
                    . "case ot.presupuestado when 1 then 'ok' else '' end as presupuestado "
                    . "from orden_trabajo ot "
                    . "join cliente c on ot.cliente_id = c.id "
                    . "join persona p on c.persona_id = p.id "
                    . "join tipo_orden tor on ot.tipo_orden_id = tor.id";

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

function orden_save($args) {
    
    $conn = Connection::getConn();
    if(!$conn){
        $conn = Connection::userConnection($args['usuario'], $args['password']);
    }
    if ($conn !== false) {
        (!empty($args['id'])) ? $id = $args['id'] : $id=false;
            
        if ($id === false) {
            try {
                $conn->beginTransaction();
                $sql = "INSERT INTO orden(cliente_id,empleado_id,tipo_orden_id,descripcion_falla,fecha_entrada) values(:cliente,:empleado,:tipo_orden,:falla,:fecha_entrada)";
                $query = $conn->prepare($sql);
                $query->execute(array(':cliente' => $args['cliente_id'],
                                      ':empleado' => $args['empleado'],
                                      ':tipo_orden' => $args['tipo_orden_id'],
                                      ':falla' => $args['descripcion_falla'],
                                      ':fecha_entrada'=> time()));
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