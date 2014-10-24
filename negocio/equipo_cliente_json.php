<?php
    session_start();
    require_once '../controller/Connection.php';
    $conn = Connection::getConn();
    $cliente = $_POST['cliente'];
    $usuario = $_SESSION['usu'];
    $password = $_SESSION['password'];
    if(!$conn){
        $conn = Connection::userConnection($usuario, $password);
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
                    return $results;
            } catch (PDOException $e) {
                    return -1;
            }
    }
