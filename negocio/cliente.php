<?php
    //require_once 'clienteDAO.php';
					
	function alta_cliente($args){
		if($args['juridica']== "1"){
                    if(strlen($args['cuit']) < 10){
                        return "debe ingresar el numero de cuit";
                    }else{
                        if($args['ape_nom'] != ""){
                            if($args['domicilio'] != ""){
                                require_once '../dao/clienteDAO.php';
                                return cliente_save($args);
                            }else{
                                return "debe indicar el domicilio";
                            }
                        }else{
                            return "debe indicar el nombre y apellido";
                        }
                   }
                }else{
                    if($args['ape_nom'] != ""){
                        if($args['dni'] != ""){
                            if($args['domicilio'] != ""){
                                require_once '../dao/clienteDAO.php';
                                return cliente_save($args);
                            }else{
                                return "debe indicar el domicilio";
                            }
                        }else{
                            return "debe indicar el dni";
                        }
                    }else{
                        return "debe indicar el nombre y apellido";
                    }
                }
	}
        function listar_clientes($usuario,$password){
            require_once '../dao/clienteDAO.php';
            return get_clientes($usuario,$password);
        }
        function obtener_cliente($args){
            require_once '../dao/clienteDAO.php';
            return get_cliente_by_id($args);
        }
        function borrar_cliente($id,$usuario,$password){
            require_once '../dao/clienteDAO.php';
            return del_cliente_by_id($id,$usuario,$password);
        }
        function update_cliente($args){
            require_once '../dao/clienteDAO.php';
            return update_cliente_id($args);
        }
        function buscar($apellido,$nombre,$usuario,$password){
            require_once '../dao/clienteDAO.php';
            return search($apellido,$nombre,$usuario,$password);
        }
        