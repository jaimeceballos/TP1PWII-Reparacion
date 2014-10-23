<?php
	require_once("ConfigBD.php");
	require_once("../classes/Usuario.php");
	class Connection
	{
                private static $CONN;

                private static function getDbConnection()
		{
			$conn = new ConfigBD();
			error_reporting(E_ALL);//notifica de todos los errores
			ini_set("display_errors", true);//establece que los errores se deben mostrar
			header('Content-Type: text/html; charset=UTF-8');
			  
			try {
				$pdo = new PDO(
			      'mysql:host='.$conn->host.';dbname='.$conn->dbName,
			      $conn->usuario, $conn->password);
			   
			    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);//habilita la preparacion de prepared statements
			    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $pdo->exec("SET NAMES UTF8");//establece el charset
			    return $pdo; 
			}
			catch (PDOException $e) {
				$error = $e->getMessage();
				return false;
			}
		}
		public static function userConnection($usuario,$password){
                    
                    if (Connection::$CONN){
                        return Connection::$CONN;
                    }else{
                        $conn = Connection::getDbConnection();
			if ($conn !== false) {
		        try {
		            $sql = "SELECT id,user,pass,rol FROM usuario WHERE user = :usuario and pass = :password";
		            $stmt = $conn->prepare($sql);
		            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'classes\Usuario');
		            $stmt->bindParam(':usuario', $usuario);
		            $stmt->bindParam(':password', $password);
		            $stmt->execute();
                            //$usuario = new classes\Usuario();
		            $usuario =  $stmt->fetch();
		            //$user = Usuario $usuario;

		            var_dump($usuario);
		            if($usuario === false){
		            	return false;
		            }else{
                                if(isset($_SESSION['usuario'])){
                                    unset($_SESSION['usuario']);
                                }
		            	$_SESSION['usuario'] = serialize($usuario);
                                Connection::$CONN = $conn;
		            	return $conn;
		            }
		        }catch (PDOException $e) {
		            return false;
		        }
                       }
                    }
					
		}
	}	
	