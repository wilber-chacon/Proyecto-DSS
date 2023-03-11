<?php header('Content-Type: text/html; charset=UTF-8'); 

session_start();

if (!isset($_SESSION['usuario'])) {
	header('location:../login.php');
	//finalizacion del proceso
	exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Banco de agricultura</title>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="../css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/alertify.core.css">
    <link rel="stylesheet" href="../css/alertify.default.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="../css/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Banco de Agricultura
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="panelPrincipalGS.php">Inicio</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="administrar_empleados.php">Administrar empleados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="administrar_prestamos.php">Administrar prestamos</a>
                </li>
            </ul>
       

            <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php if (isset($_SESSION['usuario'])) { echo $_SESSION['usuario']; } ?>  <i class="fas fa-user-circle" style="font-size: 2rem;"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesion
                </a>
              </div>
            </li>
          </ul>
        </div>
    </nav>