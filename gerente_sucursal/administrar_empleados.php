<?php require_once("superior.php") ?>

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

                        require("../conexion/conexiondb.php");
                        $conexion->set_charset("utf8");
                        $sql = "SELECT e.codigo_empleado, e.nombre_empleado, r.nombre_rol, s.nombre_sucursal, e.DUI_empleado, e.Estado_empleado, e.telefono_empleado FROM empleados as e INNER JOIN roles as r ON e.codigo_rol = r.codigo_rol INNER JOIN sucursal as s ON e.codigo_sucursal = s.codigo_sucursal";
                        $ejecutar = mysqli_query($conexion, $sql);
                        while ($fila = mysqli_fetch_array($ejecutar)) {

                            ?>

                            <tr>
                                <td>
                                    <?php echo $fila[1] ?>
                                </td>
                                <td>
                                    <?php echo $fila[2] ?>
                                </td>
                                <td>
                                    <?php echo $fila[3] ?>
                                </td>
                                <td>
                                    <?php echo $fila[4] ?>
                                </td>
                                <td>
                                    <?php echo $fila[5] ?>
                                </td>
                                <td>
                                    <?php echo $fila[6] ?>
                                </td>

                                <td style=" display: flex; align-items: center;">

                                    <a onclick="consultar('<?php echo $fila[0]; ?>')" class="btn btn-info m-3"
                                        title="Ver"><i class="fas fa-fw fa-eye"></i></a>

                                    <a onclick="obtener('<?php echo $fila[0]; ?>')" class="btn text-white btn-warning m-3"
                                        title="Editar"><i class="fas fa-fw fa-edit"></i></a>

                                    <a class="btn btn-danger m-3" href='EliminarModal.php?codigo="<?php echo $fila[0] ?>"'
                                        data-toggle="modal" data-target="#eliminarReg<?php echo $fila[0] ?>"><i
                                            class="fas fa-fw fa-trash"></i></a>
                                    <?php include 'EliminarModal.php' ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function obtener(id) {

        location.href = "procesarAccion.php?operacion=obtener&id=" + id;

    }

    function consultar(id) {

        location.href = "procesarAccion.php?operacion=consultar&id=" + id;

    }
</script>

<?php require_once("inferior.php") ?>