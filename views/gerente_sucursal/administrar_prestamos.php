<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head.php'; ?>
</head>

<body>
  <?php
  require_once '../components/layout/nav.php';
  require_once '../../connection/conexion.class.php';
  $con = new Conexion();
  ?>
  <div class="container mt-4 mb-4 p-5">
    <h1 class="titulo mb-5">Casos de préstamos</h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
          Aperturados
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
          Aprobados
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
          Rechazados
        </a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Fecha de apertura</th>
                    <th>Monto</th>
                    <th>Cuota mensual</th>
                    <th>Interes</th>
                    <th>Operaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT p.numPrestamo, c.nombre_cliente, p.estado_prestamo, p.fechaApertura,
                    p.monto_prestamo, p.cuotaMensual, p.porcentajeInteres
                  FROM prestamos as p
                  INNER JOIN cliente as c ON p.codigo_cliente = c.codigo_cliente
                  WHERE p.estado_prestamo = 'En espera'";

                  $stmt = $con->conectar()->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $con->desconectar();

                  foreach ($result as $fila) {
                  ?>
                    <tr>
                      <td>
                        <?php echo $fila["nombre_cliente"] ?>
                      </td>
                      <td>
                        <?php echo $fila["estado_prestamo"] ?>
                      </td>
                      <td>
                        <?php echo $fila["fechaApertura"] ?>
                      </td>
                      <td>
                        $<?php echo $fila["monto_prestamo"] ?>
                      </td>
                      <td>
                        $<?php echo $fila["cuotaMensual"] ?>
                      </td>
                      <td>
                        <?php echo $fila["porcentajeInteres"] ?>%
                      </td>
                      <td style=" display: flex; align-items: center;">
                        <a onclick="consultar('<?php echo $fila['numPrestamo']; ?>')" class="btn btn-info m-3" title="Ver">
                          <i class="fas fa-fw fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Fecha de apertura</th>
                    <th>Monto</th>
                    <th>Cuota mensual</th>
                    <th>Interes</th>
                    <th>Operaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT p.numPrestamo, c.nombre_cliente, p.estado_prestamo, p.fechaApertura, p.monto_prestamo,
                    p.cuotaMensual, p.porcentajeInteres
                  FROM prestamos as p
                  INNER JOIN cliente as c
                  ON p.codigo_cliente = c.codigo_cliente
                  WHERE p.estado_prestamo = 'Aprobado'";

                  $stmt = $con->conectar()->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $con->desconectar();

                  foreach ($result as $fila) {
                  ?>
                    <tr>
                      <td>
                        <?php echo $fila["nombre_cliente"] ?>
                      </td>
                      <td>
                        <?php echo $fila["estado_prestamo"] ?>
                      </td>
                      <td>
                        <?php echo $fila["fechaApertura"] ?>
                      </td>
                      <td>
                        $<?php echo $fila["monto_prestamo"] ?>
                      </td>
                      <td>
                        $<?php echo $fila["cuotaMensual"] ?>
                      </td>
                      <td>
                        <?php echo $fila["porcentajeInteres"] ?>%
                      </td>
                      <td style=" display: flex; align-items: center;">
                        <a onclick="ver('<?php echo $fila['numPrestamo']; ?>')" class="btn btn-info m-3" title="Ver">
                          <i class="fas fa-fw fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Fecha de apertura</th>
                    <th>Monto</th>
                    <th>Cuota mensual</th>
                    <th>Interes</th>
                    <th>Operaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT p.numPrestamo, c.nombre_cliente, p.estado_prestamo, p.fechaApertura,
                  p.monto_prestamo, p.cuotaMensual, p.porcentajeInteres
                  FROM prestamos as p
                  INNER JOIN cliente as c ON p.codigo_cliente = c.codigo_cliente
                  WHERE p.estado_prestamo = 'Rechazado'";

                  $stmt = $con->conectar()->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $con->desconectar();

                  foreach ($result as $fila) {
                  ?>
                    <tr>
                      <td>
                        <?php echo $fila["nombre_cliente"] ?>
                      </td>
                      <td>
                        <?php echo $fila["estado_prestamo"] ?>
                      </td>
                      <td>
                        <?php echo $fila["fechaApertura"] ?>
                      </td>
                      <td>
                        $<?php echo $fila["monto_prestamo"] ?>
                      </td>
                      <td>
                        $<?php echo $fila["cuotaMensual"] ?>
                      </td>
                      <td>
                        <?php echo $fila["porcentajeInteres"] ?>%
                      </td>
                      <td style=" display: flex; align-items: center;">
                        <a onclick="ver('<?php echo $fila['numPrestamo']; ?>')" class="btn btn-info m-3" title="Ver">
                          <i class="fas fa-fw fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>

  <script>
    function consultar(id) {
      location.href = "../../controllers/procesarAccion.php?operacion=consultarPrestamo&id=" + id;
    }

    function ver(id) {
      location.href = "../../controllers/procesarAccion.php?operacion=consultarPrestamo2&id=" + id;
    }
  </script>
</body>

</html>