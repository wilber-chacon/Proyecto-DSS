<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="./">
    <img src="../components/template/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Banco de Agricultura
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="./">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./administrar_empleados.php">Administrar empleados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./administrar_prestamos.php">Administrar prestamos</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle" style="font-size: 2rem;"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <p class="dropdown-item" style="cursor: default;">
            <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>
            <?php if (isset($_SESSION['usuario'])) {
              echo $_SESSION['usuario'];
            } ?>
          </p>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar sesion
          </a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="Salir" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Seguro que desea cerrar la sesión?
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">
          Cancelar
        </button>
        <a class="btn btn-primary" href="../../controllers/procesarLogin.php?operacion=salir">Aceptar</a>
      </div>
    </div>
  </div>
</div>