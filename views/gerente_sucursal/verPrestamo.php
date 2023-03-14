<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head.php'; ?>
</head>

<body>
  <?php
  require_once '../components/layout/nav.php';
  ?>
  <div class="container mt-4 mb-4 pt-4">
    <h1 class="titulo mb-5">Ver prestamo</h1>
    <form action="#" method="post" class="formA p-5" style="margin: auto;">
      <?php
      include '../../models/prestamo.php';
      $prestamo = new Prestamo();
      if ($_GET) {
        if (isset($_GET['prestamo'])) {
          $prestamo = unserialize($_GET['prestamo']); ?>
          <fieldset>
            <div class="form-group row">
              <label for="cliente" class="col-sm-3 col-form-label">Cliente:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="cliente" id="cliente" value="<?php print($prestamo->getnombreCliente()); ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="estado" class="col-sm-3 col-form-label">Estado:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="estado" id="estado" value="<?php print($prestamo->getestadoprestamo()); ?>" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label for="fechaApertura" class="col-sm-3 col-form-label">Fecha de apertura:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fechaApertura" id="fechaApertura" value="<?php print($prestamo->getfechaApertura()); ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="monto" class="col-sm-3 col-form-label">Monto de prestamo:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php print('$ ' . $prestamo->getmontoprestamo()); ?>" name="monto" id="monto" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label for="porcentajeInteres" class="col-sm-3 col-form-label">Porcentaje de interes:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php print($prestamo->getporcentajeInteres() . ' %'); ?>" name="porcentajeInteres" id="porcentajeInteres" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label for="cuota" class="col-sm-3 col-form-label">Cuota mensual:</label>
              <div class="col-sm-9">
                <input type="text" name="cuota" id="cuota" value="<?php print('$ ' . $prestamo->getcuotaMensual()); ?>" class="form-control datepicker" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="cantYear" class="col-sm-3 col-form-label">Cantidad de años por pagar:</label>
              <div class="col-sm-9">
                <input type="text" name="cantYear" id="cantYear" value="<?php print($prestamo->getcantYearAPagar()); ?>" class="form-control datepicker" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <a href="#" data-toggle="modal" data-target="#AprobarModal" class="btn btn-success mt-5  btn-sm btn-block" style="width: 100%; margin: auto;">Aprobar</a>
              </div>
              <div class="col">
                <a href="#" data-toggle="modal" data-target="#RechazarModal" class="btn btn-danger mt-5  btn-sm btn-block" style="width: 100%; margin: auto;">Rechazar</a>
              </div>
              <div class="col">
                <a href="./administrar_prestamos.php" class="btn btn-primary mt-5  btn-sm btn-block" style="width: 100%; margin: auto;">Atras</a>
              </div>
            </div>

        <?php
        }
      } ?>
          </fieldset>
    </form>
    <br><br><br>
  </div>

  <div class="modal fade" id="AprobarModal" tabindex="-1" role="dialog" aria-labelledby="Aprobar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Aprobar</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Seguro que desea aprobar el prestamo?
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancelar
          </button>
          <a class="btn btn-primary" href="../../controllers/procesarAccion.php?operacion=aprobarPrestamo&id=<?php print($prestamo->getnumPrestamo()); ?>">
            Aceptar
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="RechazarModal" tabindex="-1" role="dialog" aria-labelledby="Rechazar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Rechazar</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Seguro que desea rechazar el prestamo?
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancelar
          </button>
          <a class="btn btn-primary" href="../../controllers/procesarAccion.php?operacion=rechazarPrestamo&id=<?php print($prestamo->getnumPrestamo()); ?>">
            Aceptar
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>
</body>

</html>