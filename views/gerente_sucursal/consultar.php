<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head.php'; ?>
</head>

<body>
  <?php require_once '../components/layout/nav.php'; ?>
  <div class="container mt-4 mb-4 pt-4">
    <h1 class="titulo mb-5">Ver empleado</h1>
    <form action="../../controllers/procesarAccion.php" method="post" class="formA p-5" style="margin: auto;">
      <?php
      if ($_GET) {
        /* Comprobamos que ha llegado correctamente el campo 'lstError' */
        if (isset($_GET['lstError'])) { ?>

          <div class="alert alert-danger">
            <ul>
              <?php
              /* Deshacemos el trabajo hecho por 'serialize' */
              $lista = unserialize($_GET['lstError']);
              foreach ($lista as $er) {
                echo ("<li>{$er}</li>");
              }
              ?>
            </ul>
          </div>
      <?php
        }
      }
      include '../../models/empleado.php';
      include '../../connection/conexion.class.php';
      $con = new Conexion();
      $empleado = new Empleado();
      if ($_GET) {
        if (isset($_GET['empleado'])) {
          $empleado = unserialize($_GET['empleado']);
        }
      }
      ?>
      <div class="row">
        <div class="col-md-4 form-group">
          <label for="nombre" class="col-sm-12 col-form-label">Nombre:</label>
          <input type="text" class="form-control" name="nombre" id="nombre" value="<?php print($empleado->getnombre()); ?>" readonly>
        </div>
        <div class="col-md-4 form-group">
          <label for="correo" class="col-sm-12 col-form-label">Correo electronico:</label>
          <input type="email" class="form-control" name="correo" id="correo" value="<?php print($empleado->getcorreo()); ?>" readonly />
        </div>
        <div class="col-md-4 form-group">
          <label for="dui" class="col-sm-12 col-form-label">DUI:</label>
          <input type="text" class="form-control" name="dui" id="dui" value="<?php print($empleado->getdui()); ?>" pattern="^[0-9]{8}-[0-9]{8}{1}$" placeholder="00000000-0" readonly>
        </div>
        <div class="col-md-4 form-group">
          <label for="telefono" class="col-sm-12 col-form-label">Telefono:</label>
          <input type="tel" class="form-control" placeholder="0000-0000" value="<?php print($empleado->gettelefono()); ?>" name="telefono" id="telefono" readonly pattern="^[0-9]{4}-[0-9]{4}$" />
        </div>
        <div class="col-md-8 form-group">
          <label for="domicilio" class="col-sm-12 col-form-label">Domicilio:</label>
          <textarea name="domicilio" id="domicilio" cols="15" class="form-control" rows="3" readonly><?php print($empleado->getdireccion()); ?></textarea>
        </div>
        <div class="col-md-4 form-group">
          <label for="fechanacimiento" class="col-sm-12 col-form-label">Fecha de nacimiento:</label>
          <input type="date" name="fechanacimiento" id="fechanacimiento" value="<?php print($empleado->getfechanacimiento()); ?>" class="form-control datepicker" readonly>
        </div>
        <div class="col-md-8 form-group">
          <label for="acciones" class="col-sm-12 col-form-label">Acciones:</label>
          <textarea name="acciones" id="acciones" cols="15" class="form-control" rows="3" readonly><?php print($empleado->getacciones()); ?></textarea>
        </div>
        <div class="col-md-4 form-group">
          <label for="rol" class="col-sm-3 col-form-label">Rol:</label>
          <input type="text" class="form-control" value="<?php print($empleado->getnombrerol()); ?>" name="rol" id="rol" readonly />
        </div>
        <div class="col-md-4 form-group">
          <label for="sucursal" class="col-sm-12 col-form-label">Sucursal:</label>
          <input type="text" class="form-control" value="<?php print($empleado->getsucursal()); ?>" name="sucursal" id="sucursal" readonly />
        </div>
        <div class="col-md-4 form-group">
          <label for="estado" class="col-sm-12 col-form-label">Estado:</label>
          <input type="text" class="form-control" name="estado" value="<?php print($empleado->getestado()); ?>" id="estado" readonly>
        </div>
        <div class="col-md-4 form-group">
          <label for="pass" class="col-sm-12 col-form-label">Contraseña:</label>
          <input type="text" class="form-control" name="pass" value="<?php print($empleado->getpass()); ?>" id="pass" readonly>
        </div>
        <div class="col-md-12">
          <a href="./administrar_empleados.php" class="btn btn-primary mt-5  btn-sm btn-block" style="width: 50%; margin: auto;">Atras</a>
        </div>
      </div>
    </form>
    <br><br>
  </div>
  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>
</body>

</html>