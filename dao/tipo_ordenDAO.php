<?php

function get_tipos_orden($args) {
    (Connection::getConn()) ? $conn = Connection::getConn() : $conn = Connection::userConnection($args['usuario'], $args['password']);
    if ($conn !== false) {
        try {
            $sql = "select id,descripcion from tipo_orden";

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