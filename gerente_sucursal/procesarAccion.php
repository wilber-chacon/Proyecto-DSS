<?php
header('Content-Type: text/html; charset=ISO-8859-1');

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

    require("../conexion/conexiondb.php");
    //aplicando la interpretacion del español a la conexion de la base de datos
    $conexion->set_charset("utf8");

    include 'empleado.php';
    $empleado = new Empleado();

    $query = "SELECT codigo_sucursal, nombre_sucursal FROM sucursal WHERE codigo_sucursal =" . $sucursal;

    if ($result = $conexion->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $empleado->setcodigoSucursal($row["codigo_sucursal"]);
            $empleado->setsucursal($row["nombre_sucursal"]);
        }
    }

    $query2 = "SELECT codigo_rol, nombre_rol FROM roles WHERE codigo_rol =" . $rol;

    if ($result2 = $conexion->query($query2)) {
        while ($row2 = $result2->fetch_assoc()) {
            $empleado->setidrol($row2["codigo_rol"]);
            $empleado->setnombrerol($row2["nombre_rol"]);
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

    $conexion->close();


    if (count($lstError) > 0) {
        $empleado = serialize($empleado);
        //codificando en URL el objeto con urlencode() para poder agregarlo a la URL
        $empleado = urlencode($empleado);
        //convertiendo la matriz $lstError en una cadena
        $lstError = serialize($lstError);
        //codificando en URL la matriz con urlencode() para poder agregarla a la URL
        $lstError = urlencode($lstError);
        //redireccionando
        header('Location:registrar.php?lstError=' . $lstError . '&empleado=' . $empleado);
        //finalizando el script actual
        exit();
    } else {

        require("../conexion/conexiondb.php");
        //aplicando la interpretacion del español a la conexion de la base de datos
        $conexion->set_charset("utf8");

        //Query utilizada para generar la insercion del registro en la base de datos
        $queryS = "INSERT INTO sesiones (usuario, pass) VALUES ('" . $correo . "', aes_encrypt('".$pass."', 'hunter2'))";

        //validando la exitencia
        if ($conexion->query($queryS)) {

            $consulta = "SELECT MAX(codigo_sesion) FROM sesiones";
            $ejecutar = mysqli_query($conexion, $consulta);
            $codigoSesion = 0;
            while ($fila = mysqli_fetch_array($ejecutar)) {
                $codigoSesion = $fila[0];
            }

            $query = "INSERT INTO empleados (nombre_empleado, DUI_empleado, correo_empleado, telefono_empleado, Estado_empleado, domicilio_empleado, acciones, fechaNacimiento_empleado, codigo_rol, codigo_sesion, codigo_sucursal) VALUES ('" . $nombre . "','" . $dui . "','" . $correo . "','" . $telefono . "','" . $estado . "','" . $direccion . "','" . $acciones . "','" . $fechanacimiento . "'," . $rol . "," . $codigoSesion . "," . $sucursal . ")";

            if ($conexion->query($query)) {

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
        header('location:administrar_empleados.php?msj=' . $mensaje . '&titulo=' . $titulo);

        //finalizacion del proceso
        exit();

    }

}


//consultar para visualizar
function obtenerR($codigo_)
{
    require("../conexion/conexiondb.php");
    //aplicando la interpretacion del español a la conexion de la base de datos
    $conexion->set_charset("utf8");
    include 'empleado.php';
    $codigo = $codigo_;

    $empleado = new Empleado();

    $query = "SELECT e.codigo_empleado, e.nombre_empleado, e.DUI_empleado, e.telefono_empleado, e.Estado_empleado, e.domicilio_empleado, e.acciones, e.fechaNacimiento_empleado, r.codigo_rol, r.nombre_rol, s.codigo_sesion, s.usuario, aes_decrypt(s.pass, 'hunter2') AS pass, su.codigo_sucursal, su.nombre_sucursal 
        FROM empleados as e
        INNER JOIN sesiones as s
        ON e.codigo_sesion = s.codigo_sesion
        INNER JOIN roles as r
        ON e.codigo_rol = r.codigo_rol
        INNER JOIN sucursal as su
        ON e.codigo_sucursal = su.codigo_sucursal WHERE e.codigo_empleado =" . $codigo;

    if ($result = $conexion->query($query)) {
        while ($row = $result->fetch_assoc()) {
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
    header('Location:consultar.php?empleado=' . $empleado);
    //finalizando el script actual
    exit();

}


//obtener para editar
function consultar($codigo_)
{
    require("../conexion/conexiondb.php");
    //aplicando la interpretacion del español a la conexion de la base de datos
    $conexion->set_charset("utf8");
    include 'empleado.php';
    $codigo = $codigo_;

    $empleado = new Empleado();

    $query = "SELECT e.codigo_empleado, e.nombre_empleado, e.DUI_empleado, e.telefono_empleado, e.Estado_empleado, e.domicilio_empleado, e.acciones, e.fechaNacimiento_empleado, r.codigo_rol, r.nombre_rol, s.codigo_sesion, s.usuario, aes_decrypt(s.pass, 'hunter2') AS pass, su.codigo_sucursal, su.nombre_sucursal 
        FROM empleados as e
        INNER JOIN sesiones as s
        ON e.codigo_sesion = s.codigo_sesion
        INNER JOIN roles as r
        ON e.codigo_rol = r.codigo_rol
        INNER JOIN sucursal as su
        ON e.codigo_sucursal = su.codigo_sucursal WHERE e.codigo_empleado =" . $codigo;

    if ($result = $conexion->query($query)) {
        while ($row = $result->fetch_assoc()) {
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
    header('Location:editar.php?empleado=' . $empleado);
    //finalizando el script actual
    exit();

}


//Eliminar registro
function eliminar($codigo_)
{

    require("../conexion/conexiondb.php");
    //aplicando la interpretacion del español a la conexion de la base de datos
    $conexion->set_charset("utf8");

    $query = "UPDATE empleados set Estado_empleado = 'Inactivo' WHERE codigo_empleado = " . $codigo_;

    if ($conexion->query($query)) {

        $mensaje = 'si';
        $titulo = 'El empleado se desactivó exitosamente.';

    } else {

        $mensaje = 'no';
        $titulo = 'Error no se logró desactivar el empleado, por favor intente nuevamente.';

    }

    //redireccion a la pagina donde se muestran los registros
    header('location:administrar_empleados.php?msj=' . $mensaje . '&titulo=' . $titulo);

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

    require("../conexion/conexiondb.php");
    //aplicando la interpretacion del español a la conexion de la base de datos
    $conexion->set_charset("utf8");

    include 'empleado.php';
    $empleado = new Empleado();

    $query = "SELECT codigo_sucursal, nombre_sucursal FROM sucursal WHERE codigo_sucursal =" . $sucursal;

    if ($result = $conexion->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $empleado->setcodigoSucursal($row["codigo_sucursal"]);
            $empleado->setsucursal($row["nombre_sucursal"]);
        }
    }

    $query2 = "SELECT codigo_rol, nombre_rol FROM roles WHERE codigo_rol =" . $rol;

    if ($result2 = $conexion->query($query2)) {
        while ($row2 = $result2->fetch_assoc()) {
            $empleado->setidrol($row2["codigo_rol"]);
            $empleado->setnombrerol($row2["nombre_rol"]);
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

    $conexion->close();

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
        header('Location:editar.php?lstError=' . $lstError . '&empleado=' . $empleado);
        //finalizando el script actual
        exit();
    } else {

        require("../conexion/conexiondb.php");
        //aplicando la interpretacion del español a la conexion de la base de datos
        $conexion->set_charset("utf8");

        //Query utilizada para generar la insercion del registro en la base de datos
        $queryS = "UPDATE sesiones set usuario = '" . $correo . "', pass = aes_encrypt('".$pass."', 'hunter2') WHERE codigo_sesion = " . $codigosesion;

        //validando la exitencia
        if ($conexion->query($queryS)) {

            $query = "UPDATE empleados set nombre_empleado = '" . $nombre . "', correo_empleado = '" . $correo . "', DUI_empleado = '" . $dui . "', telefono_empleado = '" . $telefono . "', domicilio_empleado = '" . $direccion . "', fechaNacimiento_empleado = '" . $fechanacimiento . "', acciones = '" . $acciones . "', codigo_rol = '" . $rol . "', codigo_sucursal = '" . $sucursal . "', Estado_empleado = '" . $estado . "' WHERE codigo_empleado = " . $codigoempleado;

            if ($conexion->query($query)) {

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
        header('location:administrar_empleados.php?msj=' . $mensaje . '&titulo=' . $titulo);

        //finalizacion del proceso
        exit();
    }
}


?>