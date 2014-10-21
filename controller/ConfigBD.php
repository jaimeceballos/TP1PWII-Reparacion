<?php

	class ConfigBD{ 
	    public $host; 
	    public $dbName; 
	    public $usuario; 
	    public $password; 
	    function __construct(){ 
	        $this->host='localhost'; 
	        $this->usuario='root'; 
	        $this->password='123456'; 
	        $this->dbName='proyectoBD'; 
	    } 
	} 



	/*$config = array(
		"dbname" => "proyectoBD",
		"username" => "root",
		"password" => "123456",
		"host" => "localhost"
	);*/