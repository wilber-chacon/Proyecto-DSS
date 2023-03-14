<?php
header('Content-Type: text/html; charset=ISO-8859-1');

if ($_GET) {
  $op = $_GET['operacion'];
} else if ($_POST) {
  $op = $_POST['operacion'];
}

switch ($op) {
  case 'ingresar':
    ingresar();
    break;
  case 'salir':
    salir();
    break;
}

function salir()
{
  session_start();
  if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuario']);
    header('Location:../views/login_admin');
  }
}

function ingresar()
{
  require("../connection/conexion.class.php");
  //aplicando la interpretacion del español a la conexion de la base de datos
  $con = new Conexion();
  session_start();
  $lstError = array();
  $user = $_POST['username'];
  $pass = $_POST['pass'];

  if (empty($user)) {
    array_push($lstError, "Complete el campo de correo.");
  }
  if (empty($user)) {
    array_push($lstError, "Complete el campo de contraseña.");
  }

  if (count($lstError) > 0) {
    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/login_admin/index.php?lstError=' . $lstError);
    //finalizando el script actual
    exit();
  } else {
    $rol = 0;
    $query = "SELECT e.nombre_empleado, e.codigo_rol
        FROM sesiones as s
        INNER JOIN empleados as e
        ON e.codigo_sesion = s.codigo_sesion
        WHERE aes_decrypt(s.pass, 'hunter2') = '" . $pass . "' AND s.usuario = '" . $user . "'";

    $stmt = $con->conectar()->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
      $_SESSION['usuario'] = $result[0]["nombre_empleado"];
      $rol = $result[0]["codigo_rol"];
      // cambiar la ruta por la de su pagina principal
      switch ($rol) {
        case 1:
          // header('Location:../gerente_sucursal/panelPrincipalGS.php');
          break;
        case 2:
          // header('Location:../gerente_sucursal/panelPrincipalGS.php');
          break;
        case 3:
          // header('Location:../gerente_sucursal/panelPrincipalGS.php');
          break;
        case 4:
          // header('Location:../gerente_sucursal/panelPrincipalGS.php');
          break;
        case 5:
          header('Location:../views/gerente_sucursal/');
          break;
        case 6:
          // header('Location:../gerente_sucursal/panelPrincipalGS.php');
          break;
        case 7:
          // header('Location:../gerente_sucursal/panelPrincipalGS.php');
          break;
        case 8:
          // header('Location:../gerente_sucursal/panelPrincipalGS.php');
          break;
        default:
          array_push($lstError, "Usuario y contraseña incorrectos.");
          //convertiendo la matriz $lstError en una cadena
          $lstError = serialize($lstError);
          //codificando en URL la matriz con urlencode() para poder agregarla a la URL
          $lstError = urlencode($lstError);
          //redireccionando
          header('Location:../views/login_admin/index.php?lstError=' . $lstError);
          break;
      }
    } else {
      array_push($lstError, "Usuario y contraseña incorrectos.");
      //convertiendo la matriz $lstError en una cadena
      $lstError = serialize($lstError);
      //codificando en URL la matriz con urlencode() para poder agregarla a la URL
      $lstError = urlencode($lstError);
      //redireccionando
      header('Location:../views/login_admin/index.php?lstError=' . $lstError);
      //finalizando el script actual
      exit();
    }
  }
}
