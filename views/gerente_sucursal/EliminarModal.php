<div class="modal fade" id="eliminarReg<?php echo $fila["codigo_empleado"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desactivar</h5>
            </div>
            <div class="modal-body">
                ¿Seguro desea desactivar el empleado: 
                <?php echo $fila["nombre_empleado"] ?>?
            </div>
            <div class="modal-footer">
                <form action='../../controllers/procesarAccion.php' method="POST">
                <input type="hidden" name="operacion" id="operacion" value="eliminar">
                <input type="hidden" name="id" id="id" value="<?php echo $fila["codigo_empleado"] ?>">
                <input type="submit" value="Si" class="btn btn-danger">
                </form>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>