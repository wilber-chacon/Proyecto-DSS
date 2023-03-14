<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head.php'; ?>
</head>

<body>
  <?php require_once '../components/layout/nav.php'; ?>
  <div class="container mt-4 mb-4 pt-4">
    <h1 class="titulo mb-5">Editar empleado</h1>
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
          <input type="text" class="form-control" name="nombre" id="nombre" value="<?php print($empleado->getnombre()); ?>" required>
        </div>
        <div class="col-md-4 form-group">
          <label for="correo" class="col-sm-12 col-form-label">Correo electronico:</label>
          <input type="email" class="form-control" name="correo" id="correo" value="<?php print($empleado->getcorreo()); ?>" required />
        </div>
        <div class="col-md-4 form-group">
          <label for="dui" class="col-sm-12 col-form-label">DUI:</label>
          <input type="text" class="form-control" name="dui" id="dui" value="<?php print($empleado->getdui()); ?>" pattern="^[0-9]{8}-[0-9]{8}{1}$" placeholder="00000000-0" required>
        </div>
        <div class="col-md-4 form-group">
          <label for="telefono" class="col-sm-12 col-form-label">Telefono:</label>
          <input type="tel" class="form-control" placeholder="0000-0000" value="<?php print($empleado->gettelefono()); ?>" name="telefono" id="telefono" required pattern="^[0-9]{4}-[0-9]{4}$" />
        </div>
        <div class="col-md-8 form-group">
          <label for="domicilio" class="col-sm-12 col-form-label">Domicilio:</label>
          <textarea name="domicilio" id="domicilio" cols="15" class="form-control" rows="3" required><?php print($empleado->getdireccion()); ?></textarea>
        </div>
        <div class="col-md-4 form-group">
          <label for="fechanacimiento" class="col-sm-12 col-form-label">Fecha de nacimiento:</label>
          <input type="date" name="fechanacimiento" id="fechanacimiento" value="<?php print($empleado->getfechanacimiento()); ?>" class="form-control datepicker" required>
        </div>
        <div class="col-md-8 form-group">
          <label for="acciones" class="col-sm-12 col-form-label">Acciones:</label>
          <textarea name="acciones" id="acciones" cols="15" class="form-control" rows="3" required><?php print($empleado->getacciones()); ?></textarea>
        </div>
        <div class="col-md-4 form-group">
          <label for="rol" class="col-sm-3 col-form-label">Rol:</label>
          <select name="rol" id="rol" class="form-control">
            <option value="">Seleccione un rol</option>
            <?php
            $select = $con->conectar()->prepare("SELECT codigo_rol, nombre_rol FROM roles WHERE codigo_rol < 5;");
            $select->execute();
            $data = $select->fetchAll();

            foreach ($data as $value) {
              if (!$empleado->getidrol() == "") {
            ?>
                <option value="<?php echo $empleado->getidrol(); ?>" selected><?php echo $empleado->getnombrerol(); ?></option>
              <?php
              } else {
              ?>
                <option value="<?php echo $value["codigo_rol"]; ?>"><?php echo $value["nombre_rol"]; ?></option>
            <?php
              }
            } ?>
          </select>
        </div>
        <div class="col-md-4 form-group">
          <label for="sucursal" class="col-sm-12 col-form-label">Sucursal:</label>
          <select name="sucursal" id="sucursal" class="form-control">
            <option value="">Seleccione una sucural</option>
            <?php
            $select = $con->conectar()->prepare("SELECT codigo_sucursal, nombre_sucursal FROM sucursal;");
            $select->execute();
            $data = $select->fetchAll();

            foreach ($data as $value) {
              if (!$empleado->getcodigoSucursal() == "") {
            ?>
                <option value="<?php echo $empleado->getcodigoSucursal(); ?>" selected><?php echo $empleado->getsucursal(); ?></option>
              <?php
              } else {
              ?>
                <option value="<?php echo $value["codigo_sucursal"]; ?>"><?php echo $value["nombre_sucursal"]; ?></option>
            <?php
              }
            } ?>
          </select>
        </div>
        <div class="col-md-4 form-group">
          <label for="sucursal" class="col-sm-12 col-form-label">Estado:</label>
          <?php
          $selIna = "";
          $selAct = "";
          if ($empleado->getestado() == "Activo") {
            $selAct = "selected";
          } else {
            $selIna = "selected";
          }
          ?>
          <select name="estado" id="estado" class="form-control">
            <option value="">Seleccione estado</option>
            <option <?= $selAct; ?> value="Activo">Activo</option>
            <option <?= $selIna; ?> value="Inactivo">Inactivo</option>
          </select>
        </div>
        <div class="col-md-4 form-group">
          <label for="pass" class="col-sm-12 col-form-label">Contraseña:</label>
          <input type="text" class="form-control" name="pass" value="<?php print($empleado->getpass()); ?>" id="pass" required>
        </div>
        <div class="col-md-12">
          <input type="hidden" name="operacion" id="operacion" value="modificar">
          <input type="hidden" name="codigoempleado" id="codigoempleado" value="<?php print($empleado->getcodigoE()); ?>">
          <input type="hidden" name="codigosesion" id="codigosesion" value="<?php print($empleado->getcodigosesion()); ?>">
          <input type="submit" value="Guardar" class="btn btn-success btn-sm mt-5 mb-4 btn-block" style="width: 50%; margin: auto;">
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