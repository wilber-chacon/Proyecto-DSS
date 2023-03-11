<!-- Agregando la parte superior del contenido -->
<?php require_once("superior.php") ?>

<div class="container mt-4 mb-4 pt-4">

    <h1 class="titulo mb-5">Ver prestamo</h1>


    <form action="#" method="post" class="formA p-5" style="margin: auto;">
        <?php

        include 'prestamo.php';
        $prestamo = new Prestamo();
        if ($_GET) {
            if (isset($_GET['prestamo'])) {
                $prestamo = unserialize($_GET['prestamo']); ?>

                <fieldset>

                    <div class="form-group row">
                        <label for="cliente" class="col-sm-3 col-form-label">Cliente:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="cliente" id="cliente"
                                value="<?php print($prestamo->getnombreCliente()); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="estado" class="col-sm-3 col-form-label">Estado:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="estado" id="estado"
                                value="<?php print($prestamo->getestadoprestamo()); ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fechaApertura" class="col-sm-3 col-form-label">Fecha de apertura:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="fechaApertura" id="fechaApertura"
                                value="<?php print($prestamo->getfechaApertura()); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="monto" class="col-sm-3 col-form-label">Monto de prestamo:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"
                                value="<?php print('$ ' . $prestamo->getmontoprestamo()); ?>" name="monto" id="monto"
                                readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="porcentajeInteres" class="col-sm-3 col-form-label">Porcentaje de interes:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"
                                value="<?php print($prestamo->getporcentajeInteres() . ' %'); ?>" name="porcentajeInteres"
                                id="porcentajeInteres" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cuota" class="col-sm-3 col-form-label">Cuota mensual:</label>
                        <div class="col-sm-9">
                            <input type="text" name="cuota" id="cuota"
                                value="<?php print('$ ' . $prestamo->getcuotaMensual()); ?>" class="form-control datepicker"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cantYear" class="col-sm-3 col-form-label">Cantidad de años por pagar:</label>
                        <div class="col-sm-9">
                            <input type="text" name="cantYear" id="cantYear"
                                value="<?php print($prestamo->getcantYearAPagar()); ?>" class="form-control datepicker"
                                readonly>
                        </div>
                    </div>

                    <?php
            }
        } ?>

            <a href="administrar_prestamos.php" class="btn btn-primary mt-5  btn-sm btn-block"
                style="width: 50%; margin: auto;">Atras</a>
        </fieldset>
    </form><br><br><br>

</div>



<!-- Agregando la parte inferior del contenido -->
<?php require_once("inferior.php") ?>