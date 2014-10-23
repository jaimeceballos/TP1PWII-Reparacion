<?php
require_once("../controller/Connection.php");
    
function persona_save($args) {
    
    //$conn = Connection::userConnection($args['usuario'], $args['password']);
     $conn = Connection::getConn();
    if(!$conn){
        $conn = Connection::userConnection($args['usuario'], $args['password']);
    }
    if ($conn !== false) {
        if(!empty($args['id'])){
            $id = $args['id'];
            
        }else{
            $id = persona_exist($args);
        }
        if ($id === false) {
            try {
                $conn->beginTransaction();
                $sql = "INSERT INTO persona(ape_nom,dni,domicilio,telefono,email,juridica,cuit) values(:ape_nom,:dni,:domicilio,:telefono,:email,:juridica,:cuit)";
                $query = $conn->prepare($sql);
                $query->execute(array(':ape_nom' => $args['ape_nom'],
                    ':dni' => $args['dni'],
                    ':domicilio' => $args['domicilio'],
                    ':telefono' => $args['telefono'],
                    ':email' => $args['email'],
                    ':juridica' => ($args['juridica']== '1' ? true : false ),
                    ':cuit' => $args['cuit']
                    ));
                $conn->commit();
                return persona_exist($args);
            } catch (PDOException $e) {
                $conn->rollBack();
                return 0;
            }
        } elseif ($id > 0) {
            try {
                //$conn->beginTransaction();
                $sql = "UPDATE persona p set p.ape_nom=:ape_nom, "
                        . "p.domicilio=:domicilio, p.telefono=:telefono, p.email=:email "
                        . "where p.id= (select persona_id from cliente where id = :id)";
                $query = $conn->prepare($sql);
                $query->execute(array(':ape_nom' => $args['ape_nom'],
                    ':domicilio' => $args['domicilio'],
                    ':telefono' => $args['telefono'],
                    ':email' => $args['email'],
                    ':id' => $id
                    ));
                //$conn->commit();
                return persona_exist($args);
            } catch (PDOException $e) {
               // $conn->rollBack();
                return 0;
            }
        }
        return 0;
    }
}

function persona_exist($args) {
    
    //$coneccion = Connection::userConnection($args['usuario'], $args['password']);
    
     $coneccion = Connection::getConn();
    if(!$coneccion){
        $coneccion = Connection::userConnection($args['usuario'], $args['password']);
    }
    if ($coneccion !== false) {
        if($args['juridica'] == 0){
            try {
                $sql = "SELECT id FROM persona WHERE ape_nom = :ape_nom and dni = :dni";

                $stmt = $coneccion->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(':ape_nom', $args['ape_nom']);
                $stmt->bindParam(':dni', $args['dni']);
                
                $stmt->execute();
                $results = $stmt->fetch();
                if ($results !== false) {
                    return (int) $results['id'];
                } else {
                    return $results;
                }
            } catch (PDOException $e) {
                return -1;
            }
        }else{
            try {
                $sql = "SELECT id FROM persona WHERE ape_nom = :ape_nom and cuit = :cuit";

                $stmt = $coneccion->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(':ape_nom', $args['ape_nom']);
                $stmt->bindParam(':cuit', $args['cuit']);
                
                $stmt->execute();
                $results = $stmt->fetch();
                if ($results !== false) {
                    return (int) $results['id'];
                } else {
                    return $results;
                }
            } catch (PDOException $e) {
                return -1;
            }
        }
    }
}