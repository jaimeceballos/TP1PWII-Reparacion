<?php

function get_tipos_equipo($usuario, $password) {
    $conn = Connection::userConnection($usuario, $password);
    if ($conn !== false) {
        try {
            $sql = "select * from tipo_equipo";

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