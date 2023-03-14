<?php
require_once('../connection/conexion.class.php');
$con = new Conexion();

class Prestamista
{
  public function obtenerContadorCuentasPorCliente($cod_cliente)
  {
    global $con;
    $cantidad = 0;
    $sql = "SELECT COUNT(a.codigo_cliente) contador FROM cuentabancaria a WHERE a.codigo_cliente = :n1;";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->bindParam(':n1', $cod_cliente, PDO::PARAM_STR);
      $stmt->execute();
      $cantidad = $stmt->fetch(PDO::FETCH_ASSOC);
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $cantidad["contador"];
  }

  public function obtenerCuentasPorCliente($usuario)
  {
    global $con;
    $cuentas = [];
    $sql = "SELECT a.numCuenta, DATE_FORMAT(a.fechaCreacion, '%d/%m/%Y') fechaCreacion,
      a.tipoCuenta, a.saldoCuenta, a.lugarCreacion, b.nombre_cliente
    FROM cuentabancaria a
    INNER JOIN cliente b ON a.codigo_cliente = b.codigo_cliente
    WHERE a.codigo_cliente = :n1;";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->bindParam(':n1', $usuario, PDO::PARAM_STR);
      $stmt->execute();
      $cuentas = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $cuentas;
  }

  public function registrarCuentaBancaria($tipo_cuenta, $saldo, $cod_cliente)
  {
    global $con;
    $registrada = false;
    $num_cuenta = rand(100000, 999999);
    $sql = "INSERT INTO cuentabancaria VALUES (:n1, NOW(), :n2, :n3, 'San Salvador', :n4);";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->bindParam(':n1', $num_cuenta, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $tipo_cuenta, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $saldo, PDO::PARAM_STR);
      $stmt->bindParam(':n4', $cod_cliente, PDO::PARAM_STR);
      $registrada = $stmt->execute();
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $registrada;
  }

  public function obtenerMovimientoPorCliente($cod_cliente)
  {
    global $con;
    $movimientos = [];
    $sql = "SELECT a.numTransaccion, a.tipoTransaccion, DATE_FORMAT(a.fechaTransaccion, '%d/%m/%Y') fechaTransaccion,
    a.montoTransaccion, a.lugarTransaccion, a.numCuenta
    FROM movimientos a
    INNER JOIN cuentabancaria b ON a.numCuenta = b.numCuenta
    INNER JOIN cliente c ON b.codigo_cliente = c.codigo_cliente
    WHERE b.codigo_cliente = :n1
    ORDER BY a.fechaTransaccion DESC;";
    try {
      $stmt = $con->conectar()->prepare($sql);
      $stmt->bindParam(':n1', $cod_cliente, PDO::PARAM_STR);
      $stmt->execute();
      $movimientos["data"] = $stmt->fetchAll();
      $con->desconectar();
    } catch (PDOException $e) {
      $con->desconectar();
      die("Error: " . $e->getMessage());
    }
    return $movimientos;
  }
}
