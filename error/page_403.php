<?php
session_start();
include "../core/configuracion.php";



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo SERVERURL ?>resources/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo SERVERURL ?>resources/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo SERVERURL ?>resources/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo SERVERURL ?>resources/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">403</h1>
              <h2>Acceso Denegado</h2>
              <p>
                Se requiere autenticación completa para acceder a este recurso. <a href="<?php echo SERVERURL ?>views/inicio/home.php"> Volver</a>
              </p>

            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo SERVERURL ?>resources/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="<?php echo SERVERURL ?>resources/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo SERVERURL ?>resources/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo SERVERURL ?>resources/vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo SERVERURL ?>resources/build/js/custom.min.js"></script>
  </body>
</html>