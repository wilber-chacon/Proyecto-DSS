<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Banco de agricultura</title>
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />
  <link href="css/all.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="css/estilos.css" />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/alertify.core.css" />
  <link rel="stylesheet" href="css/alertify.default.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body style="background-color: #21304e">
  <section>
    <div class="p-5 bg-image login-top"></div>

    <div class="card shadow-5-strong pb-4 login-content">

      <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
        <form action="controller/procesarLogin.php" method="post" class="formlogin">
          <div class="logouser"><i class="far fa-user-circle"></i></div>

          <?php

          if ($_GET) {
            /* Comprobamos que ha llegado correctamente el campo 'lstError' */
            if (isset($_GET['lstError'])) { ?>

              <div class="alert alert-danger">
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

          <div class="input-group mb-5 mt-4">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Correo" name="username" id="username"
              aria-label="username" aria-describedby="basic-addon1" required />
          </div>
          <div class="input-group mb-5 mt-5">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Contraseña"
              aria-label="Contraseña" aria-describedby="basic-addon1" required />
          </div>
          <input type="hidden" name="operacion" id="operacion" value="ingresar">
          <button type="submit" class="btn btn-primary btn-block mb-4">
            Ingresar
          </button>
        </form>
      </div>

    </div>
  </section>
  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/jquery-3.2.1.slim.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/bootstrap.js"></script>
</body>

</html>