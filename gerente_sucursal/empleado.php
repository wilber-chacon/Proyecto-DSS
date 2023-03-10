<?php

class Entidad{
    
    private $nombre; 
    private $correo;
    private $dui;
    private $telefono;
    private $direccion;
    private $fechanacimiento;
    private $acciones;
    private $rol;
    private $sucursal;
    private $estado;
    private $pass;
    
    
    public function __construct() {
       
        $this->nombre= "";
        $this->correo= "";
        $this->apellidosEntidad= "";
        $this->telefonoEntidad= "";
        $this->direccionEntidad= "";
        $this->dUIEntidad= "";
        $this->correo= "";
        $this->pass= "";
    }
    
   
	
    public function getCodigoEntidad() {
            return $this->codigoEntidad;
    }
    public function setCodigoEntidad($codigoEntidad_) {
            $this->codigoEntidad = $codigoEntidad_;
    }
    public function getNombresEntidad() {
            return $this->nombresEntidad;
    }
    public function setNombresEntidad($nombresEntidad_) {
            $this->nombresEntidad = $nombresEntidad_;
    }
    public function getApellidosEntidad() {
            return $this->apellidosEntidad;
    }
    public function setApellidosEntidad($apellidosEntidad_) {
            $this->apellidosEntidad = $apellidosEntidad_;
    }
    public function getTelefonoEntidad() {
            return $this->telefonoEntidad;
    }
    public function setTelefonoEntidad($telefonoEntidad_) {
            $this->telefonoEntidad = $telefonoEntidad_;
    }
    public function getDireccionEntidad() {
            return $this->direccionEntidad;
    }
    public function setDireccionEntidad($direccionEntidad_) {
            $this->direccionEntidad = $direccionEntidad_;
    }
    public function getDUIEntidad() {
            return $this->dUIEntidad;
    }
    public function setDUIEntidad($dUIEntidad_) {
            $this->dUIEntidad = $dUIEntidad_;
    }
    public function getCorreo() {
            return $this->correo;
    }
    public function setCorreo($correo_) {
            $this->correo = $correo_;
    }
    public function getPass() {
            return $this->pass;
    }
    public function setPass($pass_) {
            $this->pass = $pass_;
    }
    
}

?>