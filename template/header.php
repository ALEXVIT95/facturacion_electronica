    <?php
    include '../../model/conexion.php';
    include '../../core/configuracion.php';

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo SERVERURL ?>resources/img/logo.ico" type="img/ico"/>

        <title>Gentelella Alela! | </title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">


        <!-- Bootstrap -->
        <link href="<?php echo SERVERURL ?>resources/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo SERVERURL ?>resources/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo SERVERURL ?>resources/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo SERVERURL ?>resources/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="<?php echo SERVERURL ?>resources/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="<?php echo SERVERURL ?>resources/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="<?php echo SERVERURL ?>resources/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="<?php echo SERVERURL ?>resources/css/upload.css" rel="stylesheet"/>
        <!-- Custom Theme Style -->
        <link href="<?php echo SERVERURL ?>resources/build/css/custom.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">


    </head>
    <?php

    $ob = new Conectar();
    $co = $ob->Conexion();
    $usuario = $_SESSION['s_usuario'];
    if ($usuario == null) {
        header("Location: ../login/loginviews.php");
    } else {

        $sql = "SELECT * FROM tbl_usuario INNER JOIN tbl_rol  ON  tbl_usuario.RO_ID = tbl_rol.RO_ID  INNER JOIN tbl_empresa ON  tbl_empresa.USU_ID = tbl_usuario.USU_ID WHERE tbl_usuario.USU_USUARIO ='$usuario'";
        $query = $co->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $res) {
            $empresa = $res['EMP_RAZON_SOCIAL'];
            $rol_id = $res['RO_ID'];
            $rol = $res['RO_DESCRIPCION'];
            $nombre = $res['USU_NOMBRES'];
            $apellidoP = $res['USU_APELLIDOS'];
            $imgen = $res['USU_IMAGEN'];


        }


        $sql = "select * from tbl_menu where RO_ID='$rol_id' AND ME_ESTADO='A' AND ME_BORRADO='0'";
        $query = $co->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();


    }
    ?>
    <body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo SERVERURL ?>views/inicio/home.php" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $empresa;  ?></span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?php echo $imgen; ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">

                            <h2><?php echo $rol; ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br/>

                    <!-- sidebar menu -->

                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo SERVERURL ?>views/inicio/home.php"><i class="fa fa-home"></i> Inicio <span
                                                class="fa fa-chevron active"></span></a>
                                    <!-- Aqui obtenemos el menu y el sub menu a travez del modelo -->
                                    <?php
                                    foreach ($result

                                    as $res) {
                                    $me_nombre = $res['ME_DESCRIPCION'];
                                    $me_icon = $res['ME_ICONO'];
                                    $me_id = $res ['ME_ID'];


                                    ?>

                                <li><a><i class="<?php echo $me_icon ?>"></i><?php echo $me_nombre ?><span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">

                                        <?php
                                        $sql = "SELECT * FROM	tbl_sub_menu  WHERE ME_ID = '$me_id' AND SUB_ESTADO='A'AND SUB_BORRADO='0'";
                                        $query = $co->prepare($sql);
                                        $query->execute();
                                        $result2 = $query->fetchAll();
                                        foreach ($result2 as $res2) {
                                            $subme_url = $res2['SUB_URL'];
                                            $subme_nombre = $res2['SUB_DESCRIPCION'];


                                            ?>
                                            <li><a href="<?php echo SERVERURL.''.$subme_url  ?>"><?php echo $subme_nombre ?></a></li>

                                        <?php } ?>
                                    </ul>
                                    <?php } ?>

                        </div>


                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->

                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                   id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo $imgen; ?>" alt=""><?php echo $nombre . ' ' . $apellidoP; ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo SERVERURL ?>views/perfil/cambiar_password.php"><i
                                                class="fa fa-gear pull-right"></i> Ajustes</a>


                                    <a class="dropdown-item" href="<?php echo SERVERURL ?>controller/login/logout.php"><i
                                                class="fa fa-sign-out pull-right"></i>Cerrar Sesion</a>
                                </div>
                            </li>



                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">

                <!-- /top tiles -->

                <!-- /page content -->

                <!-- footer content -->
