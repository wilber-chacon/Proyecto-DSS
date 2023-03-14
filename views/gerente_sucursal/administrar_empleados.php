<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head.php'; ?>
</head>

<body>
  <?php require_once '../components/layout/nav.php'; ?>
  <div class="container mt-4 mb-4 p-5">
    <h1 class="titulo mb-5">Empleados</h1>
    <div class="card shadow mb-4">
      <div class="card-body">
        <a href="registrar.php" class="btn btn-primary mb-5"><i class="fas fa-user-plus"></i> Registrar empleado</a>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Sucursal</th>
                <th>DUI</th>
                <th>Estado</th>
                <th>Telefono</th>
                <th>Operaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once '../../connection/conexion.class.php';
              $con = new Conexion();
              $sql = "SELECT e.codigo_empleado, e.nombre_empleado, r.nombre_rol, s.nombre_sucursal, e.DUI_empleado,
              e.Estado_empleado, e.telefono_empleado
              FROM empleados as e
              INNER JOIN roles as r ON e.codigo_rol = r.codigo_rol
              INNER JOIN sucursal as s ON e.codigo_sucursal = s.codigo_sucursal
              WHERE e.codigo_rol != 5;";

              $stmt = $con->conectar()->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              $con->desconectar();

              foreach ($result as $fila) {
              ?>
                <tr>
                  <td>
                    <?php echo $fila["nombre_empleado"] ?>
                  </td>
                  <td>
                    <?php echo $fila["nombre_rol"] ?>
                  </td>
                  <td>
                    <?php echo $fila["nombre_sucursal"] ?>
                  </td>
                  <td>
                    <?php echo $fila["DUI_empleado"] ?>
                  </td>
                  <td>
                    <?php echo $fila["Estado_empleado"] ?>
                  </td>
                  <td>
                    <?php echo $fila["telefono_empleado"] ?>
                  </td>
                  <td style=" display: flex; align-items: center;">
                    <a onclick="consultar('<?php echo $fila['codigo_empleado']; ?>')" class="btn btn-info m-3" title="Ver">
                      <i class="fas fa-fw fa-eye"></i>
                    </a>
                    <a onclick="obtener('<?php echo $fila['codigo_empleado']; ?>')" class="btn text-white btn-warning m-3" title="Editar">
                      <i class="fas fa-fw fa-edit"></i>
                    </a>
                    <a class="btn btn-danger m-3" href='./EliminarModal.php?codigo="<?php echo $fila['codigo_empleado'] ?>"' data-toggle="modal" data-target="#eliminarReg<?php echo $fila['codigo_empleado'] ?>">
                      <i class="fas fa-fw fa-trash"></i>
                    </a>
                    <?php include './EliminarModal.php' ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once '../components/layout/footer.php';
  require_once '../components/layout/scripts.php';
  ?>

  <script>
    function obtener(id) {
      location.href = "../../controllers/procesarAccion.php?operacion=obtener&id=" + id;
    }

    function consultar(id) {
      location.href = "../../controllers/procesarAccion.php?operacion=consultar&id=" + id;
    }
  </script>
</body>

</html>