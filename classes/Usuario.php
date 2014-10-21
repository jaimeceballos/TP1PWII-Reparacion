<?php
namespace classes;
class Usuario
{
	private  $id;
	private  $user;
	private  $pass;
	private  $rol;


	/*public function __construct($usuario, $password, $rol)
	{
		if($rol == 'cliente' or $rol == 'empleado'){
			$this->usuario = $usuario;
			$this->password = $password;
			$this->rol = $rol;
		}else{
			return 'Rol invalido';
		}
	}
*/
	public function getId()
	{
		return  $this->id;
	}	
	public function getUser()
	{
		return  $this->user;
	}
	public function getPass()
	{
		return  $this->pass;
	}
	public function getRol()
	{
		return  $this->rol;
	}
	public function setUser($usuario)
	{
		$this->user = $usuario;
	}
	public function setPass($password)
	{
		$this->pass = $password;
	}
	public function setRol($rol)
	{
		if($rol == 'cliente' or $rol == 'empleado'){
			$this->rol = $rol;
		}
		return 'Rol invalido';
	}

}