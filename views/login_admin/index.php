<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../components/template/img/logo.png" type="image/x-icon">
  <title>Banco de agricultura</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
  <link rel="stylesheet" href="../components/template/styles/estilos.css">
  <link rel="stylesheet" href="../components/template/styles/style.css">
  <link rel="stylesheet" href="../components/template/fontawesome/all.min.css" type="text/css" />
  <link rel="stylesheet" href="../components/template/bootstrap-4.6.2/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="../components/template/alertify/css/alertify.core.css" />
  <link rel="stylesheet" href="../components/template/alertify/css/alertify.default.css" />
  <link rel="stylesheet" href="../components/template/datatable/datatables.min.css">
</head>

<body>
  <div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4 p-5 shadow-sm border rounded-3">
      <div class="col-md-12 d-flex justify-content-center">
        <img class="text-center mb-4" src="../components/template/img/logo.png" alt="Logo" width="145">
      </div>
      <form action="../../controllers/procesarLogin.php" method="post" id="formlogin">
        <?php
        if ($_GET) {
          /* Comprobamos que ha llegado correctamente el campo 'lstError' */
          if (isset($_GET['lstError'])) { ?>
            <div class="alert alert-danger mb-3">
              <ul style="list-style: none; padding: 0; text-align: center;">
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
        } ?>
        <div class="mb-3">
          <label for="username" class="form-label">Correo:</label>
          <input type="text" class="form-control border border-primary" id="username" name="username" placeholder="Ingrese su Correo" autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="contrasenia" class="form-label">Contraseña:</label>
          <input type="password" class="form-control border border-primary" id="pass" name="pass" placeholder="Ingrese su contraseña" autocomplete="off">
        </div>
        <div class="d-grid">
          <input type="hidden" name="operacion" id="operacion" value="ingresar">
          <button class="btn btn-primary" type="submit" id="enviar">Ingresar</button>
        </div>
      </form>
    </div>
  </div>
  <?php require_once '../components/layout/scripts.php'; ?>
  <script src="../components/js/validarLogin.js"></script>
</body>

</html>