<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head.php'; ?>
</head>

<body>
  <div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-10 p-5 shadow-sm border rounded-3">
      <div class="col-md-12 d-flex justify-content-center">
        <img class="text-center mb-4" src="../components/template/img/logo.png" alt="Logo" width="145">
      </div>
      <form class="row" id="form-register">
        <div class="col-md-4 mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" class="form-control border border-primary" id="nombre" name="nombre" placeholder="Ingrese su nombre" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="dui" class="form-label">DUI:</label>
          <input type="text" class="form-control border border-primary" id="dui" name="dui" placeholder="Ingrese su DUI" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input type="text" class="form-control border border-primary" id="correo" name="correo" placeholder="Ingrese su correo" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="tel" class="form-label">Teléfono:</label>
          <input type="text" class="form-control border border-primary" id="tel" name="tel" placeholder="Ingrese su teléfono" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="domicilio" class="form-label">Domicilio:</label>
          <input type="text" class="form-control border border-primary" id="domicilio" name="domicilio" placeholder="Ingrese su domicilio" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="fecha_naci" class="form-label">Fecha Nacimiento:</label>
          <input type="date" class="form-control border border-primary" id="fecha_naci" name="fecha_naci" placeholder="Ingrese su fecha de nacimiento" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="sueldo" class="form-label">Sueldo:</label>
          <input type="text" class="form-control border border-primary" id="sueldo" name="sueldo" placeholder="Ingrese su sueldo" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="usuario" class="form-label">Usuario:</label>
          <input type="text" class="form-control border border-primary" id="usuario" name="usuario" placeholder="Ingrese su usuario" autocomplete="off">
        </div>
        <div class="col-md-4 mb-3">
          <label for="contrasenia" class="form-label">Contraseña:</label>
          <input type="password" class="form-control border border-primary" id="contrasenia" name="contrasenia" placeholder="Ingrese su contraseña" autocomplete="off">
        </div>
        <div class="col-md-12">
          <button class="btn btn-primary" type="submit" id="btn-register">Registrar</button>
        </div>
      </form>
      <div class="mt-3">
        <p class="mb-0  text-center">
          ¿Tienes una cuenta?
          <a href="./" class="text-primary fw-bold">Ingresar</a>
        </p>
      </div>
    </div>
  </div>

  <?php require_once '../components/layout/scripts.php'; ?>
  <script src="../components/js/auth.main.js"></script>
</body>

</html>