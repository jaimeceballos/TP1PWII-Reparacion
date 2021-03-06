<?php
    session_start();
    require_once '../controller/Connection.php';
    
    $cliente = $_GET['cliente'];
    $usuario    = unserialize($_SESSION['usuario']);
    $conn = Connection::getConn();
    if(!$conn){
        $conn = Connection::userConnection($usuario->getUser(), $usuario->getPass());
    }
    if($conn){
            try {
                    $sql = "select id,descripcion_equipo from equipo where cliente_id = :cliente";

                    $stmt = $conn->prepare($sql);
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $stmt->bindParam(':cliente', $cliente);
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                    $results = json_encode($results);
                    echo $results;
            } catch (PDOException $e) {
                    return -1;
            }
    }
