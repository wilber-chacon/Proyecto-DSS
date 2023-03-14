<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once '../components/layout/head.php'; ?>
</head>

<body>
  <div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4 p-5 shadow-sm border rounded-3">
      <div class="col-md-12 d-flex justify-content-center">
        <img class="text-center mb-4" src="../components/template/img/logo.png" alt="Logo" width="145">
      </div>
      <form id="form-login">
        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario:</label>
          <input type="text" class="form-control border border-primary" id="usuario" name="usuario" placeholder="Ingrese su usuario" autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="contrasenia" class="form-label">Contraseña:</label>
          <input type="password" class="form-control border border-primary" id="contrasenia" name="contrasenia" placeholder="Ingrese su contraseña" autocomplete="off">
        </div>
        <div class="d-grid">
          <button class="btn btn-primary" type="submit" id="btn-login">Ingresar</button>
        </div>
      </form>
      <div class="mt-3">
        <p class="mb-0  text-center">
          ¿No tienes una cuenta?
          <a href="./register.php" class="text-primary fw-bold">Registrarse</a>
        </p>
      </div>
    </div>
  </div>

  <?php require_once '../components/layout/scripts.php'; ?>
  <script src="../components/js/auth.main.js"></script>
</body>

</html>