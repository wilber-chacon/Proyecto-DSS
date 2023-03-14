<?php
require_once('../connection/conexion.class.php');
$con = new Conexion();

class Auth
{
  public function obtenerUltimoCodSesion()
  {
    global $con;
    $ultimoCodigo = [];
    $sql = "SELECT CASE WHEN codigo_sesion IS NULL THEN 1 ELSE codigo_sesion END codigo_sesion FROM (
      SELECT MAX(b.codigo_sesion) codigo_sesion FROM sesiones b ORDER BY b.codigo_sesion DESC
    ) tbl;";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->execute();
      $ultimoCodigo = $stmt->fetch(PDO::FETCH_ASSOC);
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $ultimoCodigo;
  }

  public function obtenerClientePorUsuarioCorreoDuiTel($usuario, $correo, $dui, $telefono)
  {
    global $con;
    $cliente = [];
    $sql = "SELECT * FROM sesiones a INNER JOIN cliente b ON a.codigo_sesion = b.codigo_sesion
    WHERE a.usuario = :n1 OR b.correo_cliente = :n2 OR b.DUI_cliente = :n3 OR b.telefono_cliente = :n4;";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->bindParam(':n1', $usuario, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $correo, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $dui, PDO::PARAM_STR);
      $stmt->bindParam(':n4', $telefono, PDO::PARAM_STR);
      $stmt->execute();
      $cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $cliente;
  }

  public function registrarSesion($usuario, $contrasenia)
  {
    global $con;
    $registrado = false;
    $sql = "INSERT INTO sesiones VALUES (NULL, :n1, :n2, NULL, NULL);";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->bindParam(':n1', $usuario, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $contrasenia, PDO::PARAM_STR);
      $registrado = $stmt->execute();
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $registrado;
  }

  public function registrarCliente($nombre, $dui, $correo, $telefono, $domicilio, $fecha_nacimiento, $sueldo, $cod_sesion)
  {
    global $con;
    $registrado = false;
    $sql = "INSERT INTO cliente VALUES (NULL, :n1, :n2, :n3, :n4, :n5, :n6, :n7, :n8);";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->bindParam(':n1', $nombre, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $dui, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $correo, PDO::PARAM_STR);
      $stmt->bindParam(':n4', $telefono, PDO::PARAM_STR);
      $stmt->bindParam(':n5', $domicilio, PDO::PARAM_STR);
      $stmt->bindParam(':n6', $fecha_nacimiento, PDO::PARAM_STR);
      $stmt->bindParam(':n7', $sueldo, PDO::PARAM_STR);
      $stmt->bindParam(':n8', $cod_sesion, PDO::PARAM_STR);
      $registrado = $stmt->execute();
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $registrado;
  }

  public function verificarSesion($usuario, $contrasenia)
  {
    global $con;
    $sesion = [];
    $sql = "SELECT b.*, a.usuario FROM sesiones a INNER JOIN cliente b ON a.codigo_sesion = b.codigo_sesion
    WHERE a.usuario = :n1 AND a.pass = :n2 AND a.cod_verificacion IS NOT NULL AND a.date_verficacion IS NOT NULL;";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->bindParam(':n1', $usuario, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $contrasenia, PDO::PARAM_STR);
      $stmt->execute();
      $sesion = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $sesion;
  }

  public function verificarCorreo($cod, $usuario)
  {
    global $con;
    $verificado = false;
    $sql = "UPDATE sesiones a SET a.cod_verificacion = :n1, a.date_verficacion = NOW() WHERE a.usuario = :n2;";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->bindParam(':n1', $cod, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $usuario, PDO::PARAM_STR);
      $verificado = $stmt->execute();
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $verificado;
  }
}
