<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../phpmailer/src/Exception.php';
require_once '../phpmailer/src/PHPMailer.php';
require_once '../phpmailer/src/SMTP.php';

class Helper
{
  public function limpiarParametro($string)
  {
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    return $string;
  }

  public function validarDecimal($string)
  {
    $valido = false;
    if (preg_match('/^[0-9]\d{1,6}(\.\d{1,2})?$/', $string)) {
      $valido = true;
    }
    return $valido;
  }

  public function validarTelefono($string)
  {
    $valido = false;
    if (preg_match('/^([2|6|7]{1}[0-9]{3})[-][0-9]{4}$/', $string)) {
      $valido = true;
    }
    return $valido;
  }

  public function validarDui($string)
  {
    $valido = false;
    if (preg_match('/^([0-9]{8})[-][0-9]{1}$/', $string)) {
      $valido = true;
    }
    return $valido;
  }

  public function enviarCorreo($correo, $usuario)
  {
    $enviado = false;
    try {
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = "bancoagricultura@gmail.com"; // Correo
      $mail->Password = "vukvsgtzyeusftyh"; // Contraseña
      $mail->SMTPSecure = "ssl";
      $mail->Port = 465;
      $mail->setFrom('bancoagricultura@gmail.com');
      $mail->addAddress($correo);
      $mail->isHTML(true);
      $cod_verificacion = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
      $mail->Subject = 'Verificar Correo';
      $html = "<p>Tu código de verificación es: <b style='font-size: 30px;'>$cod_verificacion</b></p><br><a href='http://localhost/proyecto/views/login/verificar.php?usuario=$usuario'>Verificar</a>";
      $mail->Body = $html;
      $mail->send();
      $enviado = true;
    } catch (Exception $e) {
      die("Error: " . $e->getMessage());
    }
    return $enviado;
  }
}
