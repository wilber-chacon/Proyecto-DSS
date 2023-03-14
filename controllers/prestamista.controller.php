<?php

require_once '../models/prestamista.class.php';
require_once '../helpers/helper.class.php';

$pm = new Prestamista();
$hlp = new Helper();
session_start();

if (isset($_POST) || isset($_GET)) {
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;
  $cod_cliente = $_SESSION["usuario"][0]["codigo_cliente"];
  $tipo_cuenta = isset($_POST['tipo_cuenta']) ? $hlp->limpiarParametro($_POST['tipo_cuenta']) : false;
  $saldo = isset($_POST['saldo']) ? $hlp->limpiarParametro($_POST['saldo']) : false;

  if ($accion) {
    switch ($accion) {
      case 'listar':
        $cuentas = $pm->obtenerCuentasPorCliente($cod_cliente);
        if (count($cuentas) > 0) {
          print_r(json_encode([
            "ok" => true,
            "cuentas" => $cuentas,
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          print_r(json_encode([
            "ok" => false,
            "cuentas" => [],
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
        break;
      case 'crear':
        if (!$tipo_cuenta || !$saldo) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡Debe ingresar todos los datos!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } elseif (!$hlp->validarDecimal($saldo)) {
          print_r(json_encode([
            "ok" => false,
            "mensaje" => "¡El saldo ingresado es inválido!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          $contador = $pm->obtenerContadorCuentasPorCliente($cod_cliente);
          if ($contador >= 3) {
            print_r(json_encode([
              "ok" => false,
              "mensaje" => "¡Solo se puede tener un máximo de 3 cuentas por cliente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            $cuenta = $pm->registrarCuentaBancaria($tipo_cuenta, $saldo, $cod_cliente);
            if ($cuenta) {
              print_r(json_encode([
                "ok" => true,
                "mensaje" => "¡Se ha creado la cuenta correctamente!",
              ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
            } else {
              print_r(json_encode([
                "ok" => false,
                "mensaje" => "¡Ocurrió un error al crear la cuenta!",
              ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
            }
          }
        }
        break;
      case 'movimientos':
        $movimientos = $pm->obtenerMovimientoPorCliente($cod_cliente);
        if (count($movimientos["data"]) > 0) {
          print_r(json_encode($movimientos, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          print_r(json_encode([
            "sEcho" => 1,
            "iTotalRecords" => 0,
            "iTotalDisplayRecords" => 0,
            "aaData" => []
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
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
