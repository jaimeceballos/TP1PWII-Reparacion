<?php
require_once("../controller/Connection.php");
require_once('personaDAO.php');    
function cliente_save($args) {
    
    $conn = Connection::userConnection($args['usuario'], $args['password']);
    if ($conn !== false) {
        $id = cliente_exist($args);
        if ($id === false) {
            try {
                $conn->beginTransaction();
                $idPersona = persona_save($args);
                $sql = "INSERT INTO cliente(persona_id) values(:persona)";
                $query = $conn->prepare($sql);
                $query->execute(array(':persona' => $idPersona));
                $conn->commit();
                return 1;
            } catch (PDOException $e) {
                $conn->rollBack();
                return 0;
            }
        } elseif ($id > 0) {
            try {
                $conn->beginTransaction();
                $sql = "UPDATE cliente set apellido=:ape_nom, dni=:dni, domicilio=:domicilio telefono=:telefono, email=:email, juridica=:juridica,cuit=:cuit where id=:id";
                $query = $coneccion->prepare($sql);
                $query->execute(array(':ape_nom' => $args['ape_nom'],
                    ':dni' => $args['dni'],
                    ':domicilio' => $args['domicilio'],
                    ':telefono' => $args['telefono'],
                    ':email' => $args['email'],
                    ':juridica' => $args['juridica'],
                    ':cuit' => $args['cuit'],
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

function cliente_exist($args) {
    $coneccion = Connection::userConnection($args['usuario'], $args['password']);
    if ($coneccion !== false) {
        if($args['juridica'] == 0){
            try {
                $sql = "SELECT id FROM persona WHERE ape_nom = :ape_nom and dni = :dni and id in (select id from cliente)";

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
                $sql = "SELECT id FROM persona WHERE ape_nom = :ape_nom and cuit = :cuit and id in (select id from cliente)";

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

function get_clientes($usuario, $password) {
    $conn = Connection::userConnection($usuario, $password);
    if ($conn !== false) {
        try {
            $sql = "select c.id as id, p.ape_nom as ape_nom, p.dni as dni, p.domicilio as domicilio, "
                    . "p.telefono as telefono, p.email as email, p.juridica as juridica, p.cuit as cuit "
                    . "from cliente c join persona p on c.persona_id =  p.id";

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

function get_cliente_by_id($args) {
    $coneccion = Connection::userConnection($args['usuario'], $args['password']);
    if ($coneccion !== false) {
        try {
            $sql = "select c.id as id, p.ape_nom as ape_nom, p.dni as dni, p.domicilio as domicilio, "
                    . "p.telefono as telefono, p.email as email, p.juridica as juridica, p.cuit as cuit "
                    . "from cliente c join persona p on c.persona_id =  p.id "
                    . "where c.id = :id";

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

function del_cliente_by_id($id, $usuario, $password) {
    $coneccion = get_conection($usuario, $password);
    if ($coneccion !== false) {
        try {
            $coneccion->beginTransaction();
            $sql = "DELETE FROM clientes WHERE id = :id";

            $stmt = $coneccion->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $coneccion->commit();
            return 1;
        } catch (PDOException $e) {
            $coneccion->rollBack();
            return -1;
        }
    }
}

function update_cliente_id($args){
        $coneccion = Connection::userConnection($args['usuario'], $args['password']);
        if($coneccion !== false){
        try {
                return persona_save($args);
            } catch (PDOException $e) {
                return 0;
            }
        }
}

function search($apellido,$nombre,$usuario,$password){
    $coneccion = get_conection($usuario, $password);
    if ($coneccion !== false) {
        try {
            $sql = "SELECT * FROM clientes WHERE apellido like :apellido and nombre like :nombre";// and edad = :edad";

            $stmt = $coneccion->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':nombre', $nombre);
            //$stmt->bindParam(':edad', $edad);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            return -1;
        }
    }
    
}