<!-- Agregando la parte superior del contenido -->
<?php require_once("superior.php") ?>

<div class="container mt-4 mb-4 pt-4">

    <h1 class="titulo mb-5">Ver empleado</h1>


    <form action="procesarAccion.php" method="post" class="formA p-5" style="margin: auto;">
        <?php
        require("../conexion/conexiondb.php");
        //aplicando la interpretacion del español a la conexion de la base de datos
        $conexion->set_charset("utf8");

        if (isset($_GET['codigo'])) {
            $codigoRe = $_GET['codigo'];
        }

        $query = "SELECT e.codigo_empleado, e.nombre_empleado, e.DUI_empleado, e.telefono_empleado, e.Estado_empleado, e.domicilio_empleado, e.acciones, e.fechaNacimiento_empleado, r.codigo_rol, r.nombre_rol, s.codigo_sesion, s.usuario, s.pass, su.codigo_sucursal, su.nombre_sucursal 
        FROM empleados as e
        INNER JOIN sesiones as s
        ON e.codigo_sesion = s.codigo_sesion
        INNER JOIN roles as r
        ON e.codigo_rol = r.codigo_rol
        INNER JOIN sucursal as su
        ON e.codigo_sucursal = su.codigo_sucursal WHERE e.codigo_empleado =" . $codigoRe;

        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <fieldset>

                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nombre" id="nombre"
                                value="<?php echo $row["nombre_empleado"] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="correo" class="col-sm-3 col-form-label">Correo electronico:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="correo" id="correo"
                                value="<?php echo $row["usuario"] ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dui" class="col-sm-3 col-form-label">DUI:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="dui" id="dui"
                                value="<?php echo $row["DUI_empleado"] ?>" pattern="^[0-9]{8}-[0-9]{8}{1}$"
                                placeholder="00000000-0" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono" class="col-sm-3 col-form-label">Telefono:</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" placeholder="0000-0000"
                                value="<?php echo $row["telefono_empleado"] ?>" name="telefono" id="telefono" readonly
                                pattern="^[0-9]{4}-[0-9]{4}$" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="domicilio" class="col-sm-3 col-form-label">Domicilio:</label>
                        <div class="col-sm-9">
                            <textarea name="domicilio" id="domicilio" cols="15" class="form-control" rows="3"
                            readonly><?php echo $row["domicilio_empleado"] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fechanacimiento" class="col-sm-3 col-form-label">Fecha de nacimiento:</label>
                        <div class="col-sm-9">
                            <input type="text" name="fechanacimiento" id="fechanacimiento"
                                value="<?php echo $row["fechaNacimiento_empleado"] ?>" class="form-control datepicker" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="acciones" class="col-sm-3 col-form-label">Acciones:</label>
                        <div class="col-sm-9">
                            <textarea name="acciones" id="acciones" cols="15" class="form-control" rows="3"
                            readonly><?php echo $row["acciones"] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rol" class="col-sm-3 col-form-label">Rol:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="rol" id="rol" value="<?php echo $row["nombre_rol"] ?>"
                            readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sucursal" class="col-sm-3 col-form-label">Sucursal:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="sucursal" id="sucursal"
                                value="<?php echo $row["nombre_sucursal"] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sucursal" class="col-sm-3 col-form-label">Estado:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="estado" id="estado"
                                value="<?php echo $row["Estado_empleado"] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass" class="col-sm-3 col-form-label">Contraseña:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="pass" value="<?php echo $row["pass"] ?>" id="pass"
                                readonly>
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