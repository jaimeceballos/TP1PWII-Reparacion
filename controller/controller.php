<?php
	session_start();
	require_once('Connection.php');
        require_once('../negocio/cliente.php');
        require_once('../negocio/equipo.php');
        require_once('../negocio/tipo_equipo.php');
        if(isset($_SESSION['usuario'])){
            $usuario = unserialize($_SESSION['usuario']);
        }
	if(isset($_POST['usuario']) && isset($_POST['password'])){
		if($_POST['usuario'] != "" && $_POST['password']!= ""){
			$usuario = $_POST['usuario'];
			$password = $_POST['password'];
			$conn = Connection::userConnection($usuario,md5($password));
			if($conn!==false){
				
				$_SESSION['session_begin']=  date("d/m/Y H:i");
                                header("Location: ../index.php");
                                die();
			}else{
				header("Location: ../index.php?error="."No se puede Conectar");
				session_destroy();
				die();

				 
			}
		}
			
	}elseif(!empty($_POST['formulario']) && $_POST['formulario'] == 'nuevo'){
                        $user                   = unserialize($_SESSION['usuario']);
			$args['usuario']	= $user->user;
			$args['password'] 	= $user->pass;
			$args['ape_nom']	= $_POST['ape_nom'];
			$args['dni']		= $_POST['dni'];
			$args['domicilio']	= $_POST['domicilio'];
                        $args['telefono']       = $_POST['telefono'];
                        $args['email']          = $_POST['email'];
                        $args['juridica']       = $_POST['juridica'];
                        $args['cuit']           = $_POST['cuit'];

			
			
			$estado = alta_cliente($args);
			if($estado == 1){
				$_SESSION['archivo'] = "nuevo.php";
				header( "Location: ../index.php?conf=ok");
				die(); 				
			}else{
				$_SESSION['archivo'] = "nuevo.php";
				header( "Location: ../index.php?err=no se pudo guardar");
				die();
			}

	}elseif(!empty($_POST['formulario']) && $_POST['formulario'] == 'modifica'){
                        $user                   = unserialize($_SESSION['usuario']);
			$args['usuario']	= $user->user;
			$args['password'] 	= $user->pass;
			$args['ape_nom']	= $_POST['ape_nom'];
			$args['dni']		= isset($_POST['dni']) ? $_POST['dni'] : "";
			$args['domicilio']	= $_POST['domicilio'];
                        $args['telefono']       = $_POST['telefono'];
                        $args['email']          = $_POST['email'];
                        $args['juridica']       = $_POST['juridica'];
                        $args['cuit']           = isset($_POST['cuit']) ? $_POST['cuit'] : "" ;
                        $args['id']             = $_POST['id'];

                        
                        $estado = update_cliente($args);
                        
                        if($estado >= 1){
				$cliente = obtener_cliente($args);
                                $_SESSION['archivo'] = "edita_cliente.php";
                                $_SESSION['cliente'] = serialize($cliente);
				header( "Location: ../index.php?conf=ok");
				die(); 				
			}else{
				$cliente = obtener_cliente($id, $usuario, $password);
                                $_SESSION['archivo'] = "edita_cliente.php";
                                $_SESSION['cliente'] = $cliente;
				header( "Location: ../index.php?err=no se pudo guardar");
				die();
			}
                        
        }elseif(!empty($_POST['formulario']) && $_POST['formulario'] == 'nuevo_equipo'){
                         $user                          = unserialize($_SESSION['usuario']);
                         $args['usuario']               = $user->user;
                         $args['password']              = $user->pass;
                         $args['tipo_equipo_id']        = $_POST['tipo_equipo_id'];
                         $args['cliente_id']            = $_POST['cliente_id'];
                         $args['descripcion_equipo']    = $_POST['descripcion_equipo'];
                         $args['estado_general']        = $_POST['estado_general'];
                         
                         $estado = alta_equipo($args);
                         
                         if($estado == 1){
                               $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->user, $usuario->pass);
                               $_SESSION['clientes']     = listar_clientes($usuario, $password);
                               $_SESSION['archivo'] = "nuevo_equipo.php";
                               header( "Location: ../index.php?conf=ok");
                         }else{
                               $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->user, $usuario->pass);
                               $_SESSION['clientes']     = listar_clientes($usuario, $password);
                               $_SESSION['archivo'] = "nuevo_equipo.php";
                               header( "Location: ../index.php?err=no se pudo guardar.");
                         }
             
        }

	if(!empty($_GET['op'])){
		if($_GET['op'] == 'salir'){
			header( "Location: ../index.php");
			session_destroy();
			die(); 
		}elseif($_GET['op'] == 'abm_Cliente'){

                    if($usuario->rol=='empleado'){

                        $results = listar_clientes($usuario->user,$usuario->pass);
                        $_SESSION['archivo'] = "listado.php";
                        $_SESSION['listado'] = $results;
                        header( "Location: ../index.php");
                        die();
                    }else{
                        header( "Location: controller.php?op=salir");
                        session_destroy();
                        die();
                    }
		}elseif($_GET['op'] == 'nuevo'){
                    if($usuario->rol =='empleado'){
			$_SESSION['archivo'] = "nuevo.php";
			header( "Location: ../index.php");
			die(); 
                    }else{
                        header( "Location: controller.php?op=salir");
                        session_destroy();
                        die();
                    }

		}elseif($_GET['op'] == 'edit' ){
                    $args['id'] = $_GET['row'];
                    $args['usuario'] = $usuario->user;
                    $args['password'] = $usuario->pass;
                    if($usuario->rol =='empleado'){
                        $cliente = obtener_cliente($args);
                        $_SESSION['archivo'] = "edita_cliente.php";
                        $_SESSION['cliente'] = serialize($cliente);
                        header("Location: ../index.php");
                        die();
                    
                    }else{
                        header( "Location: controller.php?op=salir");
                        session_destroy();
                        die();
                    }
                    
                    
                    
                }elseif($_GET['op'] == 'remove' ){
                    $args['id'] = $_GET['row'];
                    $args['usuario'] = $usuario->user;
                    $args['password']= $usuario->pass;
                    if($usuario->rol =='empleado'){
                        $cliente = borrar_cliente($args);
                        $results = listar_clientes($usuario, $password);
                        $_SESSION['archivo'] = "listado.php";
                        $_SESSION['listado'] = $results;
                        header("Location: ../index.php?del=ok");
                        die();
                    }else{
                        header( "Location: controller.php?op=salir");
                        session_destroy();
                        die();
                    }
                }elseif($_GET['op'] == 'buscar_form'){
                    if(isset($_SESSION['listado'])){
                        unset($_SESSION['listado']);
                    }
                    $_SESSION['archivo'] = "buscar.php";
                    header("Location: ../index.php");
                    die();
                }elseif($_GET['op'] == 'abm_equipo'){
                    if($usuario->rol=='empleado'){

                        $results = listar_equipos($usuario->user,$usuario->pass);
                        $_SESSION['archivo'] = "listado_equipo.php";
                        $_SESSION['listado'] = $results;
                        header( "Location: ../index.php");
                        die();
                    }else{
                        header( "Location: controller.php?op=salir");
                        session_destroy();
                        die();
                    }
                }elseif ($_GET['op'] == 'alta_equipo'){
                    if($usuario->rol=='empleado'){
                        $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->user, $usuario->pass);
                        $_SESSION['clientes']     = listar_clientes($usuario, $password);
                        $_SESSION['archivo'] = "nuevo_equipo.php";
			header( "Location: ../index.php");
			die(); 
                    }else{
                        header( "Location: controller.php?op=salir");
                        session_destroy();
                        die();
                    }
                }elseif($_GET['op'] == 'edit_equipo' ){
                    $args['id'] = $_GET['row'];
                    $args['usuario'] = $usuario->user;
                    $args['password'] = $usuario->pass;
                    if($usuario->rol =='empleado'){
                        
                        $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->user, $usuario->pass);
                        $_SESSION['clientes']     = listar_clientes($usuario, $password);
                        $_SESSION['archivo'] = "edit_equipo.php";
			
                        $equipo = obtener_equipo($args);
                        $_SESSION['equipo'] = serialize($equipo);
                        header("Location: ../index.php");
                        die();
                    
                    }else{
                        header( "Location: controller.php?op=salir");
                        session_destroy();
                        die();
                    }
                }
		
	}
        if(!empty($_GET['formulario']) && $_GET['formulario']=='buscar'){
            $usuario = $_SESSION['usuario'];
            $password= $_SESSION['pass'];
            if(empty($_GET['nombre'])){
                $nombre = '%';
            }else{
                $nombre = '%'.$_GET['nombre'].'%';
            }
            if(empty($_GET['apellido'])){
                $apellido = '%';
            }else{
                $apellido = '%'.$_GET['apellido'].'%';
            }
            /*if(empty($_GET['edad'])){
                $edad = '%';
            }else{
                $edad = $_GET['edad'];
            }*/
            
            
            $results = buscar($apellido,$nombre,$usuario,$password);
            $_SESSION['archivo'] = "buscar.php";
            $_SESSION['listado'] = $results;
            header("Location: ../index.php");
            die();
        }