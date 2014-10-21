<?php
	namespace classes;
	class Persona{
		private $id;
		private $ape_nom;
		private $dni;
		private $domicilio;
		private $telefono;
		private $email;
		private $juridica;
		private $cuit;
                
                public function __construct($ape_nom, $dni, $domicilio, $juridica, $cuit) {
                    if(isset($juridica) and $juridica === False){
                        $this->ape_nom = $ape_nom;
                        $this->dni = $dni;
                        $this->domicilio = $domicilio;
                    }elseif (isset($cuit)) {
                        $this->ape_nom = $ape_nom;
                        $this->cuit = $cuit;
                        $this->domicilio = $domicilio;
                    }else{
                        return "Debe indicar nro Cuit";
                    }
                    $this->juridica = $juridica;
                }

                public function getApe_nom() {
                    return $this->ape_nom;
                }

                public function getDni() {
                    return $this->dni;
                }

                public function getDomicilio() {
                    return $this->domicilio;
                }

                public function getTelefono() {
                    return $this->telefono;
                }

                public function getEmail() {
                    return $this->email;
                }

                public function getJuridica() {
                    return $this->juridica;
                }

                public function getCuit() {
                    return $this->cuit;
                }

                public function setApe_nom($ape_nom) {
                    $this->ape_nom = $ape_nom;
                }

                public function setDni($dni) {
                    $this->dni = $dni;
                }

                public function setDomicilio($domicilio) {
                    $this->domicilio = $domicilio;
                }

                public function setTelefono($telefono) {
                    $this->telefono = $telefono;
                }

                public function setEmail($email) {
                    $this->email = $email;
                }

                public function setJuridica($juridica) {
                    $this->juridica = $juridica;
                }

                public function setCuit($cuit) {
                    $this->cuit = $cuit;
                }


	}