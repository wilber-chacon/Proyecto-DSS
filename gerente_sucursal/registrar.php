<!-- Agregando la parte superior del contenido -->
<?php require_once("superior.php") ?>

<div class="container mt-4 mb-4 pt-4">

    <h1 class="titulo mb-5">Agregar empleado</h1>


    <form action="procesarAccion.php" method="post" class="formA p-5" style="margin: auto;">
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
        ?>
        <fieldset>

            <div class="form-group row">
                <label for="nombre" class="col-sm-3 col-form-label">Nombre:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="correo" class="col-sm-3 col-form-label">Correo electronico:</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="correo" id="correo" required />
                </div>
            </div>
            <div class="form-group row">
                <label for="dui" class="col-sm-3 col-form-label">DUI:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="dui" id="dui" pattern="^[0-9]{8}-[0-9]{8}{1}$"
                        placeholder="00000000-0" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="telefono" class="col-sm-3 col-form-label">Telefono:</label>
                <div class="col-sm-9">
                    <input type="tel" class="form-control" placeholder="0000-0000" name="telefono" id="telefono"
                        required pattern="^[0-9]{4}-[0-9]{4}$" />
                </div>
            </div>
            <div class="form-group row">
                <label for="domicilio" class="col-sm-3 col-form-label">Domicilio:</label>
                <div class="col-sm-9">
                    <textarea name="domicilio" id="domicilio" cols="15" class="form-control" rows="3"
                        required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="fechanacimiento" class="col-sm-3 col-form-label">Fecha de nacimiento:</label>
                <div class="col-sm-9">
                    <input type="date" name="fechanacimiento" id="fechanacimiento" class="form-control datepicker"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="acciones" class="col-sm-3 col-form-label">Acciones:</label>
                <div class="col-sm-9">
                    <textarea name="acciones" id="acciones" cols="15" class="form-control" rows="3" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="rol" class="col-sm-3 col-form-label">Rol:</label>
                <div class="col-sm-9">
                    <select name="rol" id="rol" class="form-control">
                        <?php require("../conexion/conexiondb.php");
                        $conexion->set_charset("utf8");
                        $sql = "SELECT codigo_rol, nombre_rol FROM roles WHERE codigo_rol < 5";
                        $ejecutar = mysqli_query($conexion, $sql);
                        while ($fila = mysqli_fetch_array($ejecutar)) { ?>

                            <option value="<?php echo $fila[0] ?>"><?php echo $fila[1] ?></option>

                        <?php }  $conexion->close(); ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="sucursal" class="col-sm-3 col-form-label">Sucursal:</label>
                <div class="col-sm-9">
                    <select name="sucursal" id="sucursal" class="form-control">
                        <?php require("../conexion/conexiondb.php");
                        $conexion->set_charset("utf8");
                        $sql = "SELECT codigo_sucursal, nombre_sucursal FROM sucursal";
                        $ejecutar = mysqli_query($conexion, $sql);
                        while ($fila = mysqli_fetch_array($ejecutar)) { ?>

                            <option value="<?php echo $fila[0] ?>"><?php echo $fila[1] ?></option>

                        <?php }  $conexion->close(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="pass" class="col-sm-3 col-form-label">Contraseña:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="pass" id="pass" required>
                </div>
            </div>
            <input type="hidden" name="operacion" id="operacion" value="insertar">
            <input type="submit" value="Guardar" class="btn btn-success btn-sm mt-5 mb-4 btn-block"
                style="width: 50%; margin: auto;">

        </fieldset>
    </form><br><br><br>

</div>

<!-- Agregando la parte inferior del contenido -->
<?php require_once("inferior.php") ?>