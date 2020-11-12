    <?php
    include '../../model/conexion.php';

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/ico"/>

        <title>Gentelella Alela! | </title>

        <!-- Bootstrap -->
        <link href="../../resources/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../../resources/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../../resources/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../../resources/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="../../resources/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="../../resources/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="../../resources/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../../resources/build/css/custom.min.css" rel="stylesheet">
    </head>
    <?php

    $ob = new Conectar();
    $co = $ob->Conexion();
    $usuario = $_SESSION['s_usuario'];
    if ($usuario == null) {
        header("Location: ../login/index.php");
    } else {

        $sql = "SELECT * FROM tbl_usuario INNER JOIN tbl_rol ON  tbl_usuario.RO_ID = tbl_rol.RO_ID WHERE tbl_usuario.USU_USUARIO ='$usuario'";
        $query = $co->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $res) {
            $rol_id = $res['RO_ID'];
            $rol = $res['RO_DESCRIPCION'];
            $nombre = $res['USU_NOMBRES'];
            $apellidoP = $res['USU_APELLIDOS'];
            $imgen = $res['USU_IMAGEN'];


        }


        $sql = "select * from tbl_menu where RO_ID='$rol_id' AND ME_ESTADO='1'";
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
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?php echo $imgen; ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">

                            <h2><?php echo $rol ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br/>

                    <!-- sidebar menu -->

                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="../inicio/home.php"><i class="fa fa-home"></i> Inicio <span
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
                                        $sql = "SELECT * FROM	tbl_sub_menu  WHERE ME_ID = '$me_id' AND SUB_ESTADO='1'";
                                        $query = $co->prepare($sql);
                                        $query->execute();
                                        $result2 = $query->fetchAll();
                                        foreach ($result2 as $res2) {
                                            $subme_url = $res2['SUB_URL'];
                                            $subme_nombre = $res2['SUB_DESCRIPCION'];


                                            ?>
                                            <li><a href="<?php echo $subme_url ?>"><?php echo $subme_nombre ?></a></li>

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
                                    <a class="dropdown-item" href="../../views/perfil/cambiar_password.php"><i
                                                class="fa fa-gear pull-right"></i> Ajustes</a>

                                    </a>
                                    <a class="dropdown-item" href="../../controller/logout.php"><i
                                                class="fa fa-sign-out pull-right"></i>Cerrar Sesion</a>
                                </div>
                            </li>
                            <!-- /idea para chat -->
                            <!--<li role="presentation" class="nav-item dropdown open">
                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                                   data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                    aria-labelledby="navbarDropdown1">
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                            <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                            <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                            <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                            <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                            <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                            <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                            <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                            <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="text-center">
                                            <a class="dropdown-item">
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>-->
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->

                <!-- /top tiles -->

                <!-- /page content -->

                <!-- footer content -->
