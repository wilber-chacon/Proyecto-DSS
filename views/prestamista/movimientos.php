<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head.php'; ?>
</head>

<body>
  <?php require_once '../components/layout/nav.php'; ?>

  <div class="container mt-4 mb-4 p-5">
    <h1 class="titulo">Cliente: <?= $_SESSION['usuario'][0]["nombre_cliente"]; ?></h1>
    <div class="row">
      <div class="col-md-12 mt-4 mb-4">
        <table id="tbl_movimientos" class="table table-bordered display nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="width: 16%;">Núm. Transacción</th>
              <th style="width: 16%;">Tipo Transacción</th>
              <th style="width: 16%;">Fecha Transacción</th>
              <th style="width: 16%;">Monto Transacción</th>
              <th style="width: 16%;">Lugar Transacción</th>
              <th style="width: 16%;">Cuenta Transacción</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr>
              <th style="width: 16%;">Núm. Transacción</th>
              <th style="width: 16%;">Tipo Transacción</th>
              <th style="width: 16%;">Fecha Transacción</th>
              <th style="width: 16%;">Monto Transacción</th>
              <th style="width: 16%;">Lugar Transacción</th>
              <th style="width: 16%;">Cuenta Transacción</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>
  <script src="../components/js/prestamista.main.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      await listarMovimientos();
    });
  </script>
</body>

</html>