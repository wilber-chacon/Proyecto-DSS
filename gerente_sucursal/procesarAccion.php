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
    case 'eliminar':
        $id = $_GET['id'];
        eliminar($id);
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


    if (count($lstError) > 0) {
        //convertiendo la matriz $lstError en una cadena
        $lstError = serialize($lstError);
        //codificando en URL la matriz con urlencode() para poder agregarla a la URL
        $lstError = urlencode($lstError);
        //redireccionando
        header('Location: registar.php?lstError=' . $lstError);
        //finalizando el script actual
        exit();
    } else {

        require("../conexion/conexiondb.php");
        //aplicando la interpretacion del español a la conexion de la base de datos
        $conexion->set_charset("utf8");

        //Query utilizada para generar la insercion del registro en la base de datos
        $queryS = "INSERT INTO sesiones (usuario, pass) VALUES ('".$correo."', '".$pass."')";

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



//Eliminar registro
function eliminar($codigo_)
{

    $mCode = 0;
    //url contra la que atacamos
    $ch = curl_init("http://localhost:8080/entidadrest/rest/entidades/delete/" . $codigo_);
    //a true, obtendremos una respuesta de la url, en otro caso, 
    //true si es correcto, false si no lo es
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //establecemos el verbo http que queremos utilizar para la petición
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //obtenemos la respuesta
    $response = curl_exec($ch);

    // Se cierra el recurso CURL y se liberan los recursos del sistema
    curl_close($ch);
    //print_r($mCode);  
    $mCode = http_response_code();

    if ($mCode == 200) {
        $mensaje = 'si';
        $titulo = 'La entidad se eliminó exitosamente';
    } else {
        $mensaje = 'no';
        $titulo = 'La entidad se logró eliminar';
    }
    header('Location: /ClienteRest/index.php?msj=' . $mensaje . '&titulo=' . $titulo);

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


    if (count($lstError) > 0) {

        //convertiendo la matriz $lstError en una cadena
        $lstError = serialize($lstError);
        //codificando en URL la matriz con urlencode() para poder agregarla a la URL
        $lstError = urlencode($lstError);
        //redireccionando
        header('Location:editar.php?lstError=' . $lstError.'&codigo="'.$codigoempleado.'"');
        //finalizando el script actual
        exit();
    } else {

        require("../conexion/conexiondb.php");
        //aplicando la interpretacion del español a la conexion de la base de datos
        $conexion->set_charset("utf8");

        //Query utilizada para generar la insercion del registro en la base de datos
        $queryS = "UPDATE sesiones set usuario = '".$correo."', pass='".$pass."' WHERE codigo_sesion = ".$codigosesion;

        //validando la exitencia
        if ($conexion->query($queryS)) {

            $query = "UPDATE empleados set nombre_empleado = '".$nombre."', correo_empleado = '".$correo."', DUI_empleado = '".$dui."', telefono_empleado = '".$telefono."', domicilio_empleado = '".$direccion."', fechaNacimiento_empleado = '".$fechanacimiento."', acciones = '".$acciones."', codigo_rol = '".$rol."', codigo_sucursal = '".$sucursal."', Estado_empleado = '".$estado."' WHERE codigo_empleado = ".$codigoempleado;

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