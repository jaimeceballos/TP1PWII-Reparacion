<?php
	session_start();
	require_once('Connection.php');
        require_once('../negocio/cliente.php');
        require_once('../negocio/equipo.php');
        require_once('../negocio/tipo_equipo.php');
        require_once('../negocio/orden.php');
        require_once('../negocio/tipo_orden.php');
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
			$args['usuario']	= $user->getUser();
			$args['password'] 	= $user->getPass();
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
			$args['usuario']	= $user->getUser();
			$args['password'] 	= $user->getPass();
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
                         $args['usuario']               = $user->getUser();
                         $args['password']              = $user->getPass();
                         $args['tipo_equipo_id']        = $_POST['tipo_equipo_id'];
                         $args['cliente_id']            = $_POST['cliente_id'];
                         $args['descripcion_equipo']    = $_POST['descripcion_equipo'];
                         $args['estado_general']        = $_POST['estado_general'];
                         
                         $estado = alta_equipo($args);
                         
                         if($estado == 1){
                               $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->getUser(), $usuario->getPass());
                               $_SESSION['clientes']     = listar_clientes($usuario, $password);
                               $_SESSION['archivo'] = "nuevo_equipo.php";
                               header( "Location: ../index.php?conf=ok");
                         }else{
                               $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->getUser(), $usuario->getPass());
                               $_SESSION['clientes']     = listar_clientes($usuario, $password);
                               $_SESSION['archivo'] = "nuevo_equipo.php";
                               header( "Location: ../index.php?err=no se pudo guardar.");
                         }
             
        }elseif(!empty($_POST['formulario']) && $_POST['formulario'] == 'edit_equipo'){
                        $user                           = unserialize($_SESSION['usuario']);
			$args['usuario']                = $user->getUser();
			$args['password']               = $user->getPass();
                        $args['empleado']               = $user->getId();
			$args['cliente_id']             = $_POST['cliente_id'];
			$args['tipo_orden_id']          = $_POST['tipo_orden_id'];
			$args['equipo']         	= $_POST['equipo'];
                        $args['descripcion_falla']      = $_POST['descripcion_falla'];
                        

                        
                        $estado = alta_orden($args);
                        
                        if($estado >= 1){
				$equipo = obtener_equipo($args);
                                $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->getUser(), $usuario->getPass());
                                $_SESSION['clientes']     = listar_clientes($usuario, $password);
                                $_SESSION['archivo'] = "edit_equipo.php";
                                $_SESSION['equipo'] = serialize($equipo);
				header( "Location: ../index.php?conf=ok");
				die(); 				
			}else{
				$equipo = obtener_equipo($args);
                                $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->getUser(), $usuario->getPass());
                                $_SESSION['clientes']     = listar_clientes($usuario, $password);
                                $_SESSION['archivo'] = "edit_equipo.php";
                                $_SESSION['equipo'] = $equipo;
				header( "Location: ../index.php?err=no se pudo guardar");
				die();
			}
                        
        }elseif(!empty($_POST['formulario']) && $_POST['formulario'] == 'nueva_orden'){
            
        }

	if(!empty($_GET['op'])){
		if($_GET['op'] == 'salir'){
			header( "Location: ../index.php");
			session_destroy();
			die(); 
		}elseif($_GET['op'] == 'abm_Cliente'){

                    if($usuario->getRol()=='empleado'){

                        $results = listar_clientes($usuario->getUser(),$usuario->getPass());
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
                    if($usuario->getRol() =='empleado'){
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
                    $args['usuario'] = $usuario->getUser();
                    $args['password'] = $usuario->getPass();
                    if($usuario->getRol() =='empleado'){
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
                    $args['usuario'] = $usuario->getUser();
                    $args['password']= $usuario->getPass();
                    if($usuario->getRol() =='empleado'){
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
                    if($usuario->getRol()=='empleado'){

                        $results = listar_equipos($usuario->getUser(),$usuario->getPass());
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
                    if($usuario->getRol()=='empleado'){
                        $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->getUser(), $usuario->getPass());
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
                    $args['usuario'] = $usuario->getUser();
                    $args['password'] = $usuario->getPass();
                    if($usuario->getRol() =='empleado'){
                        
                        $_SESSION['tipos_equipo'] = listar_tipos_equipo($usuario->getUser(), $usuario->getPass());
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
                }elseif($_GET['op'] == 'remove_equipo' ){
                    $args['id'] = $_GET['row'];
                    $args['usuario'] = $usuario->getUser();
                    $args['password']= $usuario->getPass();
                    if($usuario->getRol() =='empleado'){
                        $equipo = borrar_equipo($args);
                        $results = listar_equipos($usuario->getUser(),$usuario->getPass());
                        $_SESSION['archivo'] = "listado_equipo.php";
                        $_SESSION['listado'] = $results;
                        header( "Location: ../index.php");
                        die();
                    }else{
                        header( "Location: controller.php?op=salir");
                        session_destroy();
                        die();
                    }
                }elseif($_GET['op'] == 'abm_orden'){
                    if($usuario->getRol()=='empleado'){
                        $args['usuario'] = $usuario->getUser();
                        $args['password'] = $usuario->getPass();
                        $results = listar_orden($args);
                        $_SESSION['archivo'] = "listado_orden.php";
                        $_SESSION['listado'] = $results;
                        header( "Location: ../index.php");
                        die();
                    }else{
                        header( "Location: controller.php?op=salir");
                        session_destroy();
                        die();
                    }
                }elseif($_GET['op'] == 'alta_orden'){
                    if($usuario->getRol()=='empleado'){
                        $args['usuario'] = $usuario->getUser();
                        $args['password'] = $usuario->getPass();
                        
                        $_SESSION['tipos_orden'] = listar_tipos_orden($args);
                        $_SESSION['clientes']     = listar_clientes($usuario->getUser(), $usuario->getPass());
                        
                        $_SESSION['archivo'] = "nuevo_orden.php";
                        $_SESSION['listado'] = $results;
                        header( "Location: ../index.php");
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
        header("Location: ../public/404.php");
        die();