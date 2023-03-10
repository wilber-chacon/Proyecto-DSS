<!-- Agregando la parte superior del contenido -->
<?php require_once("superior.php") ?>

<div class="container mt-4 mb-4 pt-4">

    <h1 class="titulo mb-5">Ver empleado</h1>


    <form action="#" method="post" class="formA p-5" style="margin: auto;">
        <?php

        include 'empleado.php';
        $empleado = new Empleado();
        if ($_GET) {
            if (isset($_GET['empleado'])) {
                $empleado = unserialize($_GET['empleado']); ?>

                <fieldset>

                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nombre" id="nombre"
                                value="<?php print($empleado->getnombre()); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="correo" class="col-sm-3 col-form-label">Correo electronico:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="correo" id="correo"
                                value="<?php print($empleado->getcorreo()); ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dui" class="col-sm-3 col-form-label">DUI:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="dui" id="dui"
                                value="<?php print($empleado->getdui()); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono" class="col-sm-3 col-form-label">Telefono:</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" value="<?php print($empleado->gettelefono()); ?>"
                                name="telefono" id="telefono" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="domicilio" class="col-sm-3 col-form-label">Domicilio:</label>
                        <div class="col-sm-9">
                            <textarea name="domicilio" id="domicilio" cols="15" class="form-control" rows="3"
                                readonly><?php print($empleado->getdireccion()); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fechanacimiento" class="col-sm-3 col-form-label">Fecha de nacimiento:</label>
                        <div class="col-sm-9">
                            <input type="date" name="fechanacimiento" id="fechanacimiento"
                                value="<?php print($empleado->getfechanacimiento()); ?>" class="form-control datepicker"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="acciones" class="col-sm-3 col-form-label">Acciones:</label>
                        <div class="col-sm-9">
                            <textarea name="acciones" id="acciones" cols="15" class="form-control" rows="3"
                                readonly><?php print($empleado->getacciones()); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rol" class="col-sm-3 col-form-label">Rol:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php print($empleado->getnombrerol()); ?>"
                                name="rol" id="rol" readonly />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sucursal" class="col-sm-3 col-form-label">Sucursal:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php print($empleado->getsucursal()); ?>"
                                name="sucursal" id="sucursal" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="estado" class="col-sm-3 col-form-label">Estado:</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php print($empleado->getestado()); ?>"
                                name="estado" id="estado" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass" class="col-sm-3 col-form-label">Contraseña:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="pass" value="<?php print($empleado->getpass()); ?>"
                                id="pass" readonly>
                        </div>
                    </div>

                    <?php
            }
        } ?>
            <a href="administrar_empleados.php" class="btn btn-primary mt-5  btn-sm btn-block"
                style="width: 50%; margin: auto;">Atras</a>

        </fieldset>
    </form><br><br><br>

</div>

<!-- Agregando la parte inferior del contenido -->
<?php require_once("inferior.php") ?>