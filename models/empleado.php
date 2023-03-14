<?php

class Empleado
{
  private $codigoE;
  private $nombre;
  private $correo;
  private $dui;
  private $telefono;
  private $direccion;
  private $fechanacimiento;
  private $acciones;
  private $idrol;
  private $nombrerol;
  private $sucursal;
  private $estado;
  private $pass;
  private $codigosesion;
  private $codigoSucursal;


  public function __construct()
  {
    $this->codigoE = "";
    $this->nombre = "";
    $this->correo = "";
    $this->correo = "";
    $this->dui = "";
    $this->telefono = "";
    $this->direccion = "";
    $this->fechanacimiento = "";
    $this->acciones = "";
    $this->idrol = "";
    $this->nombrerol = "";
    $this->sucursal = "";
    $this->estado = "";
    $this->pass = "";
    $this->codigosesion = "";
    $this->codigoSucursal = "";
  }

  public function getcodigoE()
  {
    return $this->codigoE;
  }
  public function setcodigoE($codigoE_)
  {
    $this->codigoE = $codigoE_;
  }
  public function getnombre()
  {
    return $this->nombre;
  }
  public function setnombre($nombre_)
  {
    $this->nombre = $nombre_;
  }
  public function getcorreo()
  {
    return $this->correo;
  }
  public function setcorreo($correo_)
  {
    $this->correo = $correo_;
  }
  public function getdui()
  {
    return $this->dui;
  }
  public function setdui($dui_)
  {
    $this->dui = $dui_;
  }
  public function gettelefono()
  {
    return $this->telefono;
  }
  public function settelefono($telefono_)
  {
    $this->telefono = $telefono_;
  }
  public function getdireccion()
  {
    return $this->direccion;
  }
  public function setdireccion($direccion_)
  {
    $this->direccion = $direccion_;
  }
  public function getfechanacimiento()
  {
    return $this->fechanacimiento;
  }
  public function setfechanacimiento($fechanacimiento_)
  {
    $this->fechanacimiento = $fechanacimiento_;
  }
  public function getacciones()
  {
    return $this->acciones;
  }
  public function setacciones($acciones_)
  {
    $this->acciones = $acciones_;
  }
  public function getidrol()
  {
    return $this->idrol;
  }
  public function setidrol($idrol_)
  {
    $this->idrol = $idrol_;
  }
  public function getnombrerol()
  {
    return $this->nombrerol;
  }
  public function setnombrerol($nombrerol_)
  {
    $this->nombrerol = $nombrerol_;
  }
  public function getsucursal()
  {
    return $this->sucursal;
  }
  public function setsucursal($sucursal_)
  {
    $this->sucursal = $sucursal_;
  }
  public function getestado()
  {
    return $this->estado;
  }
  public function setestado($estado_)
  {
    $this->estado = $estado_;
  }
  public function getpass()
  {
    return $this->pass;
  }
  public function setpass($pass_)
  {
    $this->pass = $pass_;
  }
  public function getcodigosesion()
  {
    return $this->codigosesion;
  }
  public function setcodigosesion($codigosesion_)
  {
    $this->codigosesion = $codigosesion_;
  }
  public function getcodigoSucursal()
  {
    return $this->codigoSucursal;
  }
  public function setcodigoSucursal($codigoSucursal_)
  {
    $this->codigoSucursal = $codigoSucursal_;
  }
}
