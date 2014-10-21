<?php
require_once("../controller/Connection.php");
    
function cliente_save($ape_nom, $dni, $domicilio, $telefono, $email, $juridica, $cuit) {
    
    $conn = Connection::userConnection($usuario, $password);
    if ($conn !== false) {
        $id = cliente_exist($apellido, $nombre, $edad, $usuario, $password);
        if ($id === false) {
            try {
                $coneccion->beginTransaction();
                $sql = "INSERT INTO clientes(apellido,nombre,edad) values(:apellido,:nombre,:edad)";
                $query = $coneccion->prepare($sql);
                $query->execute(array(':apellido' => $apellido,
                    ':nombre' => $nombre,
                    ':edad' => $edad));
                $coneccion->commit();
                return 1;
            } catch (PDOException $e) {
                $coneccion->rollBack();
                return 0;
            }
        } elseif ($id > 0) {
            try {
                $coneccion->beginTransaction();
                $sql = "UPDATE clientes set apellido=:apellido, nombre=:nombre,edad=:edad where id=:id";
                $query = $coneccion->prepare($sql);
                $query->execute(array(':apellido' => $apellido,
                    ':nombre' => $nombre,
                    ':edad' => $edad,
                    ':id' => $id));
                $coneccion->commit();
                return 1;
            } catch (PDOException $e) {
                $coneccion->rollBack();
                return 0;
            }
        }
        return 0;
    }
}

function cliente_exist($apellido, $nombre, $edad, $usuario, $password) {
    $coneccion = get_conection($usuario, $password);
    if ($coneccion !== false) {
        try {
            $sql = "SELECT id FROM clientes WHERE apellido = :apellido and nombre = :nombre and edad = :edad";

            $stmt = $coneccion->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':edad', $edad);

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

function get_clientes($usuario, $password) {
    $conn = Connection::userConnection($usuario, $password);
    if ($conn !== false) {
        try {
            $sql = "SELECT * FROM persona where id in (select persona_id from cliente)";

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

function get_cliente_by_id($id, $usuario, $password) {
    $coneccion = get_conection($usuario, $password);
    if ($coneccion !== false) {
        try {
            $sql = "SELECT * FROM clientes WHERE id = :id";

            $stmt = $coneccion->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':id', $id);
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

function update_cliente_id($id, $apellido, $nombre, $edad, $usuario, $password){
        $coneccion = get_conection($usuario, $password);
        if(coneccion !== false){
        try {
                $coneccion->beginTransaction();
                $sql = "UPDATE clientes set apellido=:apellido, nombre=:nombre,edad=:edad where id=:id";
                $query = $coneccion->prepare($sql);
                $query->execute(array(':apellido' => $apellido,
                    ':nombre' => $nombre,
                    ':edad' => $edad,
                    ':id' => $id));
                $coneccion->commit();
                return 1;
            } catch (PDOException $e) {
                $coneccion->rollBack();
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