<?php require_once("superior.php") ?>

<div class="container mt-4 mb-4 p-5">

    <h1 class="titulo mb-5">Casos de préstamos</h1>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Aperturados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Aprobados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                aria-selected="false">Rechazados</a>
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

                                require("../conexion/conexiondb.php");
                                $conexion->set_charset("utf8");
                                $sql = "SELECT p.numPrestamo, c.nombre_cliente, p.estado_prestamo, p.fechaApertura, p.monto_prestamo, p.cuotaMensual, p.porcentajeInteres
                                FROM prestamos as p
                                INNER JOIN cliente as c
                                ON p.codigo_cliente = c.codigo_cliente
                                WHERE p.estado_prestamo = 'En espera'";
                                $ejecutar = mysqli_query($conexion, $sql);
                                while ($fila = mysqli_fetch_array($ejecutar)) {

                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo $fila[0] ?>
                                        </td>
                                        <td>
                                            <?php echo $fila[1] ?>
                                        </td>
                                        <td>
                                            <?php echo $fila[2] ?>
                                        </td>
                                        <td>
                                            $ <?php echo $fila[3] ?>
                                        </td>
                                        <td>
                                            $ <?php echo $fila[4] ?>
                                        </td>
                                        <td>
                                            <?php echo $fila[5] ?> %
                                        </td>
                                        <td style=" display: flex; align-items: center;">

                                            <a onclick="consultar('<?php echo $fila[0]; ?>')" class="btn btn-info m-3"
                                                title="Ver"><i class="fas fa-fw fa-eye"></i></a>                                            
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

                                require("../conexion/conexiondb.php");
                                $conexion->set_charset("utf8");
                                $sql = "SELECT p.numPrestamo, c.nombre_cliente, p.estado_prestamo, p.fechaApertura, p.monto_prestamo, p.cuotaMensual, p.porcentajeInteres
                                FROM prestamos as p
                                INNER JOIN cliente as c
                                ON p.codigo_cliente = c.codigo_cliente
                                WHERE p.estado_prestamo = 'Aprobado'";
                                $ejecutar = mysqli_query($conexion, $sql);
                                while ($fila = mysqli_fetch_array($ejecutar)) {

                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo $fila[0] ?>
                                        </td>
                                        <td>
                                            <?php echo $fila[1] ?>
                                        </td>
                                        <td>
                                            <?php echo $fila[2] ?>
                                        </td>
                                        <td>
                                            $ <?php echo $fila[3] ?>
                                        </td>
                                        <td>
                                            $ <?php echo $fila[4] ?>
                                        </td>
                                        <td>
                                            <?php echo $fila[5] ?> %
                                        </td>
                                        <td style=" display: flex; align-items: center;">

                                            <a onclick="ver('<?php echo $fila[0]; ?>')" class="btn btn-info m-3"
                                                title="Ver"><i class="fas fa-fw fa-eye"></i></a>                                            
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

                                require("../conexion/conexiondb.php");
                                $conexion->set_charset("utf8");
                                $sql = "SELECT p.numPrestamo, c.nombre_cliente, p.estado_prestamo, p.fechaApertura, p.monto_prestamo, p.cuotaMensual, p.porcentajeInteres
                                FROM prestamos as p
                                INNER JOIN cliente as c
                                ON p.codigo_cliente = c.codigo_cliente
                                WHERE p.estado_prestamo = 'Rechazado'";
                                $ejecutar = mysqli_query($conexion, $sql);
                                while ($fila = mysqli_fetch_array($ejecutar)) {

                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo $fila[0] ?>
                                        </td>
                                        <td>
                                            <?php echo $fila[1] ?>
                                        </td>
                                        <td>
                                            <?php echo $fila[2] ?>
                                        </td>
                                        <td>
                                            $ <?php echo $fila[3] ?>
                                        </td>
                                        <td>
                                            $ <?php echo $fila[4] ?>
                                        </td>
                                        <td>
                                            <?php echo $fila[5] ?> %
                                        </td>
                                        <td style=" display: flex; align-items: center;">

                                            <a onclick="ver('<?php echo $fila[0]; ?>')" class="btn btn-info m-3"
                                                title="Ver"><i class="fas fa-fw fa-eye"></i></a>                                            
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

<script>
    function consultar(id) {

        location.href = "procesarAccion.php?operacion=consultarPrestamo&id=" + id;

    }
    function ver(id) {

location.href = "procesarAccion.php?operacion=consultarPrestamo2&id=" + id;

}
</script>

<?php require_once("inferior.php") ?>