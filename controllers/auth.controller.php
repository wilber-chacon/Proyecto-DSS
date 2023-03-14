<?php

require_once '../models/auth.class.php';
require_once '../helpers/helper.class.php';

$am = new Auth();
$hlp = new Helper();

if (isset($_POST) || isset($_GET)) {
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;
  $nombre = isset($_POST['nombre']) ? $hlp->limpiarParametro($_POST['nombre']) : false;
  $dui = isset($_POST['dui']) ? $hlp->limpiarParametro($_POST['dui']) : false;
  $correo = isset($_POST['correo']) ? $hlp->limpiarParametro($_POST['correo']) : false;
  $tel = isset($_POST['tel']) ? $hlp->limpiarParametro($_POST['tel']) : false;
  $domicilio = isset($_POST['domicilio']) ? $hlp->limpiarParametro($_POST['domicilio']) : false;
  $fecha_naci = isset($_POST['fecha_naci']) ? $hlp->limpiarParametro($_POST['fecha_naci']) : false;
  $sueldo = isset($_POST['sueldo']) ? $hlp->limpiarParametro($_POST['sueldo']) : false;
  $usuario = isset($_POST['usuario']) ? $hlp->limpiarParametro($_POST['usuario']) : false;
  $contrasenia = isset($_POST['contrasenia']) ? $hlp->limpiarParametro($_POST['contrasenia']) : false;
  $contrasenia = md5($contrasenia);
  $cod = isset($_POST['cod']) ? $hlp->limpiarParametro($_POST['cod']) : false;

  if ($accion) {
    switch ($accion) {
      case 'registrar':
        if (!$nombre || !$dui || !$correo || !$tel || !$domicilio || !$fecha_naci || !$sueldo || !$usuario || !$contrasenia) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Debe ingresar todos los datos!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } elseif (!$hlp->validarDui($dui)) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡El DUI ingresado es inválido!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡El correo ingresado es inválido!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } elseif (!$hlp->validarTelefono($tel)) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡El teléfono ingresado es inválido!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } elseif (!$hlp->validarDecimal($sueldo)) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡El sueldo ingresado es inválido!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          $cliente = $am->obtenerClientePorUsuarioCorreoDuiTel($usuario, $correo, $dui, $tel);
          if (count($cliente) > 0) {
            print_r(json_encode([
              "ok" => false,
              "mensaje" => "¡Un dato ingresado ya se ha registrado!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            $sesion = $am->registrarSesion($usuario, $contrasenia);
            if ($sesion) {
              $cod_sesion = $am->obtenerUltimoCodSesion();
              $registro = $am->registrarCliente($nombre, $dui, $correo, $tel, $domicilio, $fecha_naci, $sueldo, $cod_sesion["codigo_sesion"]);
              $hlp->enviarCorreo($correo, $usuario);
            }
            if ($registro) {
              print_r(json_encode([
                "ok" => true,
                "mensaje" => "¡Se ha registrado correctamente!",
              ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
            } else {
              print_r(json_encode([
                "ok" => false,
                "mensaje" => "¡Ocurrió un error al registrarse!",
              ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
            }
          }
        }
        break;
      case 'login':
        if (!$usuario || !$contrasenia) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Debe ingresar todos los datos!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          $sesion = $am->verificarSesion($usuario, $contrasenia);
          if (count($sesion) > 0) {
            session_start();
            $_SESSION['usuario'] = $sesion;
            print_r(json_encode([
              'ok' => true,
              'mensaje' => '¡Bienvenido/a ' . $_SESSION['usuario'][0]['usuario'] . '!',
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              'ok' => false,
              'mensaje' => '¡Usuario o contraseña incorrectos, o no ha verificado su correo!',
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'verificar':
        if (!$usuario || !$cod) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Debe ingresar todos los datos!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          $verificado = $am->verificarCorreo($cod, $usuario);
          if ($verificado) {
            print_r(json_encode([
              'ok' => true,
              'mensaje' => '¡Correo verificado correctamente!',
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              'ok' => false,
              'mensaje' => '¡Ocurrió un error al verificar el correo!',
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'cerrar':
        session_start();
        session_destroy();
        print_r(json_encode([
          'ok' => true,
          'mensaje' => '¡Sesión cerrada correctamente!',
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        break;
      default:
        print_r(json_encode([
          "ok" => false,
          "mensaje" => "¡Accion no encontrada!",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        break;
    }
  }
}
