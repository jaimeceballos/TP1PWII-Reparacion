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

