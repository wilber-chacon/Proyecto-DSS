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
      <form id="form-verificacion">
        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario:</label>
          <input type="text" class="form-control border border-primary" id="usuario" name="usuario" value="<?= isset($_GET['usuario']) ? $_GET['usuario'] : ''; ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="cod" class="form-label">Código:</label>
          <input type="text" class="form-control border border-primary" id="cod" name="cod" placeholder="Ingrese su código de verificacón" autocomplete="off">
        </div>
        <div class="d-grid">
          <button class="btn btn-primary" type="submit" id="btn-verificar">Verificar</button>
        </div>
      </form>
    </div>
  </div>

  <?php require_once '../components/layout/scripts.php'; ?>
  <script src="../components/js/auth.main.js"></script>
</body>

</html>