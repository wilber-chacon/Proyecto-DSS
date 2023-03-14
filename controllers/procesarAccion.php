<?php
header('Content-Type: text/html; charset=ISO-8859-1');

require_once '../connection/conexion.class.php';
require_once '../models/empleado.php';
require_once '../models/prestamo.php';

if ($_GET) {
  $op = $_GET['operacion'];
} else if ($_POST) {
  $op = $_POST['operacion'];
}

switch ($op) {
  case 'insertar':
    insert();
    break;
  case 'consultar':
    $id = $_GET['id'];
    obtenerR($id);
    break;
  case 'eliminar':
    $id = $_POST['id'];
    eliminar($id);
    break;
  case 'obtener':
    $id = $_GET['id'];
    consultar($id);
    break;
  case 'modificar':
    actualizar();
    break;
  case 'consultarPrestamo':
    $id = $_GET['id'];
    consultarPrestmo($id);
    break;
  case 'consultarPrestamo2':
    $id = $_GET['id'];
    consultarPrestmo2($id);
    break;
  case 'aprobarPrestamo':
    $id = $_GET['id'];
    aprobarPrestamo($id);
    break;
  case 'rechazarPrestamo':
    $id = $_GET['id'];
    rechazarPrestamo($id);
    break;
}
//Insertar empleado
function insert()
{
  $lstError = array();
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $dui = $_POST['dui'];
  $telefono = $_POST['telefono'];
  $direccion = $_POST['domicilio'];
  $fechanacimiento = $_POST['fechanacimiento'];
  $acciones = $_POST['acciones'];
  $rol = $_POST['rol'];
  $sucursal = $_POST['sucursal'];
  $estado = 'En espera de aprobación';
  $pass = $_POST['pass'];
  $regex = "/^[0-9]{4}-[0-9]{4}$/";
  $regexDUI = "/^[0-9]{8}-[0-9]{1}$/";

  if (empty($nombre)) {
    array_push($lstError, "Complete el campo nombre.");
  }
  if (empty($correo)) {
    array_push($lstError, "Complete el campo correo.");
  }
  if (!preg_match($regexDUI, $dui)) {
    array_push($lstError, "Ingrese DUI valido.");
  }
  if (!preg_match($regex, $telefono)) {
    array_push($lstError, "Ingrese telefono valido.");
  }
  if (empty($direccion)) {
    array_push($lstError, "Complete el campo direccion.");
  }
  if (empty($fechanacimiento)) {
    array_push($lstError, "Complete el campo fecha de nacimiento.");
  }
  if (empty($acciones)) {
    array_push($lstError, "Complete el campo acciones.");
  }
  if (empty($rol)) {
    array_push($lstError, "Complete el campo rol.");
  }
  if (empty($sucursal)) {
    array_push($lstError, "Complete el campo sucursal.");
  }
  if (empty($pass)) {
    array_push($lstError, "Complete el campo contraseña.");
  }

  $con = new Conexion();
  $empleado = new Empleado();

  $query = "SELECT codigo_sucursal, nombre_sucursal FROM sucursal WHERE codigo_sucursal =" . $sucursal;

  $stmt = $con->conectar()->prepare($query);
  $ejec = $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($ejec) {
    foreach ($result as $row) {
      $empleado->setcodigoSucursal($row["codigo_sucursal"]);
      $empleado->setsucursal($row["nombre_sucursal"]);
    }
  }

  $query = "SELECT codigo_rol, nombre_rol FROM roles WHERE codigo_rol =" . $rol;

  $stmt = $con->conectar()->prepare($query);
  $ejec = $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($result) {
    foreach ($result as $row) {
      $empleado->setidrol($row["codigo_rol"]);
      $empleado->setnombrerol($row["nombre_rol"]);
    }
  }

  $empleado->setnombre($nombre);
  $empleado->setcorreo($correo);
  $empleado->setdui($dui);
  $empleado->settelefono($telefono);
  $empleado->setdireccion($direccion);
  $empleado->setfechanacimiento($fechanacimiento);
  $empleado->setacciones($acciones);
  $empleado->setpass($pass);
  $empleado->setestado($estado);

  $con->desconectar();

  if (count($lstError) > 0) {
    $empleado = serialize($empleado);
    //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
    $empleado = urlencode($empleado);
    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/gerente_sucursal/registrar.php?lstError=' . $lstError . '&empleado=' . $empleado);
    //finalizando el script actual
    exit();
  } else {
    //Query utilizada para generar la insercion del registro en la base de datos
    $queryS = "INSERT INTO sesiones (usuario, pass) VALUES ('" . $correo . "', aes_encrypt('" . $pass . "', 'hunter2'))";
    $stmt = $con->conectar()->prepare($queryS);
    $ejec = $stmt->execute();
    $con->desconectar();
    //validando la exitencia
    if ($ejec) {
      $consulta = "SELECT MAX(codigo_sesion) codigo_sesion FROM sesiones";
      $stmt = $con->conectar()->prepare($consulta);
      $stmt->execute();
      $con->desconectar();
      $codigoSesion = 0;
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $fila) {
        $codigoSesion = $fila["codigo_sesion"];
      }

      $query = "INSERT INTO empleados (nombre_empleado, DUI_empleado, correo_empleado, telefono_empleado, Estado_empleado, domicilio_empleado, acciones, fechaNacimiento_empleado, codigo_rol, codigo_sesion, codigo_sucursal) VALUES ('" . $nombre . "','" . $dui . "','" . $correo . "','" . $telefono . "','" . $estado . "','" . $direccion . "','" . $acciones . "','" . $fechanacimiento . "'," . $rol . "," . $codigoSesion . "," . $sucursal . ")";

      $stmt = $con->conectar()->prepare($query);
      $ejec = $stmt->execute();
      $con->desconectar();

      if ($ejec) {
        $mensaje = 'si';
        $titulo = 'El empleado se agregó exitosamente.';
      } else {
        $mensaje = 'no';
        $titulo = 'Error no se logró guardar el registro, por favor intente nuevamente.';
      }
    } else {
      $mensaje = 'no';
      $titulo = 'Error no se logró guardar el registro, por favor intente nuevamente.';
    }
    //redireccion a la pagina donde se muestran los registros
    header('location:../views/gerente_sucursal/administrar_empleados.php?msj=' . $mensaje . '&titulo=' . $titulo);
    //finalizacion del proceso
    exit();
  }
}

//consultar para visualizar
function obtenerR($codigo_)
{
  $con = new Conexion();
  $empleado = new Empleado();
  $codigo = $codigo_;

  $query = "SELECT e.codigo_empleado, e.nombre_empleado, e.DUI_empleado, e.telefono_empleado, e.Estado_empleado, e.domicilio_empleado, e.acciones, e.fechaNacimiento_empleado, r.codigo_rol, r.nombre_rol, s.codigo_sesion, s.usuario, aes_decrypt(s.pass, 'hunter2') AS pass, su.codigo_sucursal, su.nombre_sucursal 
        FROM empleados as e
        INNER JOIN sesiones as s
        ON e.codigo_sesion = s.codigo_sesion
        INNER JOIN roles as r
        ON e.codigo_rol = r.codigo_rol
        INNER JOIN sucursal as su
        ON e.codigo_sucursal = su.codigo_sucursal WHERE e.codigo_empleado =" . $codigo;

  $stmt = $con->conectar()->prepare($query);
  $ejec = $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $con->desconectar();

  if ($ejec) {
    foreach ($result as $row) {
      $empleado->setcodigoE($row["codigo_empleado"]);
      $empleado->setnombre($row["nombre_empleado"]);
      $empleado->setcorreo($row["usuario"]);
      $empleado->setdui($row["DUI_empleado"]);
      $empleado->settelefono($row["telefono_empleado"]);
      $empleado->setdireccion($row["domicilio_empleado"]);
      $empleado->setfechanacimiento($row["fechaNacimiento_empleado"]);
      $empleado->setacciones($row["acciones"]);
      $empleado->setidrol($row["codigo_rol"]);
      $empleado->setnombrerol($row["nombre_rol"]);
      $empleado->setcodigoSucursal($row["codigo_sucursal"]);
      $empleado->setsucursal($row["nombre_sucursal"]);
      $empleado->setestado($row["Estado_empleado"]);
      $empleado->setpass($row["pass"]);
      $empleado->setcodigosesion($row["codigo_sesion"]);
    }
  }

  //convertiendo el objeto $empleado en una cadena
  $empleado = serialize($empleado);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $empleado = urlencode($empleado);
  //redireccionando
  header('Location:../views/gerente_sucursal/consultar.php?empleado=' . $empleado);
  //finalizando el script actual
  exit();
}


//obtener para editar
function consultar($codigo_)
{
  $con = new Conexion();
  $empleado = new Empleado();
  $codigo = $codigo_;

  $query = "SELECT e.codigo_empleado, e.nombre_empleado, e.DUI_empleado, e.telefono_empleado, e.Estado_empleado, e.domicilio_empleado, e.acciones, e.fechaNacimiento_empleado, r.codigo_rol, r.nombre_rol, s.codigo_sesion, s.usuario, aes_decrypt(s.pass, 'hunter2') AS pass, su.codigo_sucursal, su.nombre_sucursal 
        FROM empleados as e
        INNER JOIN sesiones as s
        ON e.codigo_sesion = s.codigo_sesion
        INNER JOIN roles as r
        ON e.codigo_rol = r.codigo_rol
        INNER JOIN sucursal as su
        ON e.codigo_sucursal = su.codigo_sucursal WHERE e.codigo_empleado =" . $codigo;

  $stmt = $con->conectar()->prepare($query);
  $ejec = $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $con->desconectar();

  if ($ejec) {
    foreach ($result as $row) {
      $empleado->setcodigoE($row["codigo_empleado"]);
      $empleado->setnombre($row["nombre_empleado"]);
      $empleado->setcorreo($row["usuario"]);
      $empleado->setdui($row["DUI_empleado"]);
      $empleado->settelefono($row["telefono_empleado"]);
      $empleado->setdireccion($row["domicilio_empleado"]);
      $empleado->setfechanacimiento($row["fechaNacimiento_empleado"]);
      $empleado->setacciones($row["acciones"]);
      $empleado->setidrol($row["codigo_rol"]);
      $empleado->setnombrerol($row["nombre_rol"]);
      $empleado->setcodigoSucursal($row["codigo_sucursal"]);
      $empleado->setsucursal($row["nombre_sucursal"]);
      $empleado->setestado($row["Estado_empleado"]);
      $empleado->setpass($row["pass"]);
      $empleado->setcodigosesion($row["codigo_sesion"]);
    }
  }

  //convertiendo el objeto $empleado en una cadena
  $empleado = serialize($empleado);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $empleado = urlencode($empleado);
  //redireccionando
  header('Location:../views/gerente_sucursal/editar.php?empleado=' . $empleado);
  //finalizando el script actual
  exit();
}


//Eliminar registro
function eliminar($codigo_)
{
  $con = new Conexion();

  $query = "UPDATE empleados set Estado_empleado = 'Inactivo' WHERE codigo_empleado = " . $codigo_;
  $stmt = $con->conectar()->prepare($query);
  $ejec = $stmt->execute();
  $con->desconectar();

  if ($ejec) {
    $mensaje = 'si';
    $titulo = 'El empleado se desactivó exitosamente.';
  } else {

    $mensaje = 'no';
    $titulo = 'Error no se logró desactivar el empleado, por favor intente nuevamente.';
  }

  //redireccion a la pagina donde se muestran los registros
  header('location:../views/gerente_sucursal/administrar_empleados.php?msj=' . $mensaje . '&titulo=' . $titulo);

  //finalizacion del proceso
  exit();
}

//Actualizar
function actualizar()
{
  $lstError = array();
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $dui = $_POST['dui'];
  $telefono = $_POST['telefono'];
  $direccion = $_POST['domicilio'];
  $fechanacimiento = $_POST['fechanacimiento'];
  $acciones = $_POST['acciones'];
  $rol = $_POST['rol'];
  $sucursal = $_POST['sucursal'];
  $estado = $_POST['estado'];
  $pass = $_POST['pass'];
  $regex = "/^[0-9]{4}-[0-9]{4}$/";
  $regexDUI = "/^[0-9]{8}-[0-9]{1}$/";
  $codigosesion = $_POST['codigosesion'];
  $codigoempleado = $_POST['codigoempleado'];

  if (empty($nombre)) {
    array_push($lstError, "Complete el campo nombre.");
  }
  if (empty($correo)) {
    array_push($lstError, "Complete el campo correo.");
  }
  if (!preg_match($regexDUI, $dui)) {
    array_push($lstError, "Ingrese DUI valido.");
  }
  if (!preg_match($regex, $telefono)) {
    array_push($lstError, "Ingrese telefono valido.");
  }
  if (empty($direccion)) {
    array_push($lstError, "Complete el campo direccion.");
  }
  if (empty($fechanacimiento)) {
    array_push($lstError, "Complete el campo fecha de nacimiento.");
  }
  if (empty($acciones)) {
    array_push($lstError, "Complete el campo acciones.");
  }
  if (empty($rol)) {
    array_push($lstError, "Complete el campo rol.");
  }
  if (empty($sucursal)) {
    array_push($lstError, "Complete el campo sucursal.");
  }
  if (empty($pass)) {
    array_push($lstError, "Complete el campo contraseña.");
  }

  $con = new Conexion();
  $empleado = new Empleado();

  $query = "SELECT codigo_sucursal, nombre_sucursal FROM sucursal WHERE codigo_sucursal =" . $sucursal;

  $stmt = $con->conectar()->prepare($query);
  $ejec = $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($ejec) {
    foreach ($result as $row) {
      $empleado->setcodigoSucursal($row["codigo_sucursal"]);
      $empleado->setsucursal($row["nombre_sucursal"]);
    }
  }

  $query = "SELECT codigo_rol, nombre_rol FROM roles WHERE codigo_rol =" . $rol;

  $stmt = $con->conectar()->prepare($query);
  $ejec = $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($result) {
    foreach ($result as $row) {
      $empleado->setidrol($row["codigo_rol"]);
      $empleado->setnombrerol($row["nombre_rol"]);
    }
  }

  $empleado->setcodigoE($codigoempleado);
  $empleado->setnombre($nombre);
  $empleado->setcorreo($correo);
  $empleado->setdui($dui);
  $empleado->settelefono($telefono);
  $empleado->setdireccion($direccion);
  $empleado->setfechanacimiento($fechanacimiento);
  $empleado->setacciones($acciones);
  $empleado->setpass($pass);
  $empleado->setestado($estado);
  $empleado->setcodigosesion($codigosesion);

  $con->desconectar();

  if (count($lstError) > 0) {
    //convertiendo el objeto $empleado en una cadena
    $empleado = serialize($empleado);
    //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
    $empleado = urlencode($empleado);
    //convertiendo la matriz $lstError en una cadena
    $lstError = serialize($lstError);
    //codificando en URL la matriz con urlencode() para poder agregarla a la URL
    $lstError = urlencode($lstError);
    //redireccionando
    header('Location:../views/gerente_sucursal/editar.php?lstError=' . $lstError . '&empleado=' . $empleado);
    //finalizando el script actual
    exit();
  } else {
    //Query utilizada para generar la insercion del registro en la base de datos
    $queryS = "UPDATE sesiones set usuario = '" . $correo . "', pass = aes_encrypt('" . $pass . "', 'hunter2') WHERE codigo_sesion = " . $codigosesion;

    $stmt = $con->conectar()->prepare($queryS);
    $ejec = $stmt->execute();
    //validando la exitencia
    if ($ejec) {
      $query = "UPDATE empleados set nombre_empleado = '" . $nombre . "', correo_empleado = '" . $correo . "', DUI_empleado = '" . $dui . "', telefono_empleado = '" . $telefono . "', domicilio_empleado = '" . $direccion . "', fechaNacimiento_empleado = '" . $fechanacimiento . "', acciones = '" . $acciones . "', codigo_rol = '" . $rol . "', codigo_sucursal = '" . $sucursal . "', Estado_empleado = '" . $estado . "' WHERE codigo_empleado = " . $codigoempleado;

      $stmt = $con->conectar()->prepare($query);
      $ejec = $stmt->execute();

      if ($ejec) {
        $mensaje = 'si';
        $titulo = 'El empleado se actualizó exitosamente.';
      } else {

        $mensaje = 'no';
        $titulo = 'Error no se logró actualizar el registro, por favor intente nuevamente.';
      }
    } else {

      $mensaje = 'no';
      $titulo = 'Error no se logró actualizar el registro, por favor intente nuevamente.';
    }

    //redireccion a la pagina donde se muestran los registros
    header('location:../views/gerente_sucursal/administrar_empleados.php?msj=' . $mensaje . '&titulo=' . $titulo);

    //finalizacion del proceso
    exit();
  }
}

/* -----------------------------------------------PRÉSTAMOS----------------------------------------------- */

function consultarPrestmo($codigo_)
{
  $codigo = $codigo_;
  $con = new Conexion();
  $prestamo = new Prestamo();

  $query = "SELECT p.numPrestamo, p.estado_prestamo, p.fechaApertura, p.monto_prestamo, p.porcentajeInteres, p.cuotaMensual, p.cantYearAPagar, p.codigo_cliente, c.nombre_cliente
    FROM prestamos as p
    INNER JOIN cliente as c
    ON p.codigo_cliente = c.codigo_cliente WHERE p.numPrestamo = " . $codigo;

  $stmt = $con->conectar()->prepare($query);
  $ejec = $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $con->desconectar();

  if ($ejec) {
    foreach ($result as $row) {
      $prestamo->setnumPrestamo($row["numPrestamo"]);
      $prestamo->setestadoprestamo($row["estado_prestamo"]);
      $prestamo->setfechaApertura($row["fechaApertura"]);
      $prestamo->setmontoprestamo($row["monto_prestamo"]);
      $prestamo->setporcentajeInteres($row["porcentajeInteres"]);
      $prestamo->setcuotaMensual($row["cuotaMensual"]);
      $prestamo->setcantYearAPagar($row["cantYearAPagar"]);
      $prestamo->setcodigocliente($row["codigo_cliente"]);
      $prestamo->setnombreCliente($row["nombre_cliente"]);
    }
  }

  //convertiendo el objeto $empleado en una cadena
  $prestamo = serialize($prestamo);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $prestamo = urlencode($prestamo);
  //redireccionando
  header('Location:../views/gerente_sucursal/verPrestamo.php?prestamo=' . $prestamo);
  //finalizando el script actual
  exit();
}


function consultarPrestmo2($codigo_)
{
  $codigo = $codigo_;
  $con = new Conexion();
  $prestamo = new Prestamo();

  $query = "SELECT p.numPrestamo, p.estado_prestamo, p.fechaApertura, p.monto_prestamo, p.porcentajeInteres, p.cuotaMensual, p.cantYearAPagar, p.codigo_cliente, c.nombre_cliente
    FROM prestamos as p
    INNER JOIN cliente as c
    ON p.codigo_cliente = c.codigo_cliente WHERE p.numPrestamo = " . $codigo;

  $stmt = $con->conectar()->prepare($query);
  $ejec = $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $con->desconectar();

  if ($ejec) {
    foreach ($result as $row) {
      $prestamo->setnumPrestamo($row["numPrestamo"]);
      $prestamo->setestadoprestamo($row["estado_prestamo"]);
      $prestamo->setfechaApertura($row["fechaApertura"]);
      $prestamo->setmontoprestamo($row["monto_prestamo"]);
      $prestamo->setporcentajeInteres($row["porcentajeInteres"]);
      $prestamo->setcuotaMensual($row["cuotaMensual"]);
      $prestamo->setcantYearAPagar($row["cantYearAPagar"]);
      $prestamo->setcodigocliente($row["codigo_cliente"]);
      $prestamo->setnombreCliente($row["nombre_cliente"]);
    }
  }

  //convertiendo el objeto $empleado en una cadena
  $prestamo = serialize($prestamo);
  //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
  $prestamo = urlencode($prestamo);
  //redireccionando
  header('Location:../views/gerente_sucursal/verPrestamo2.php?prestamo=' . $prestamo);
  //finalizando el script actual
  exit();
}


function aprobarPrestamo($codigo_)
{
  $con = new Conexion();
  $codigo = $codigo_;

  $queryS = "UPDATE prestamos set estado_prestamo = 'Aprobado' WHERE numPrestamo = " . $codigo;

  $stmt = $con->conectar()->prepare($queryS);
  $ejec = $stmt->execute();
  $con->desconectar();

  if ($ejec) {
    $mensaje = 'si';
    $titulo = 'El prestamo se aprobó exitosamente.';
  } else {
    $mensaje = 'no';
    $titulo = 'Error no se logró aprobar el prestamo, por favor intente nuevamente.';
  }

  //redireccion a la pagina donde se muestran los registros
  header('location:../views/gerente_sucursal/administrar_prestamos.php?msj=' . $mensaje . '&titulo=' . $titulo);

  //finalizacion del proceso
  exit();
}



function rechazarPrestamo($codigo_)
{
  $con = new Conexion();
  $codigo = $codigo_;

  $queryS = "UPDATE prestamos set estado_prestamo = 'Rechazado' WHERE numPrestamo = " . $codigo;

  $stmt = $con->conectar()->prepare($queryS);
  $ejec = $stmt->execute();
  $con->desconectar();

  if ($ejec) {
    $mensaje = 'si';
    $titulo = 'El prestamo se rechazó exitosamente.';
  } else {
    $mensaje = 'no';
    $titulo = 'Error no se logró rechazar el prestamo, por favor intente nuevamente.';
  }

  //redireccion a la pagina donde se muestran los registros
  header('location:../views/gerente_sucursal/administrar_prestamos.php?msj=' . $mensaje . '&titulo=' . $titulo);

  //finalizacion del proceso
  exit();
}
