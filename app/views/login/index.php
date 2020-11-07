<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../resources/css/estilos.css">
    <link rel="stylesheet" href="../../resources/css/fonts.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Montez|Pathway+Gothic+One" rel="stylesheet">
</head>
<body>
<div class="contenedor">

    <header>
        <h1 class="title">Odisea</h1>
        <a href="">Registrate</a>
    </header>
    <div class="login">
        <article class="fondo">
            <img src="../../resources/img/dragon-logo-png-5-Transparent-Images.png" alt="User">
            <h3>Inicio de Sesion</h3>
            <form class="login-form validate-form" id="formLogin" action="" method="post">
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                <span class="icon-user"></span><input class="inp" type="text" id="usuario" name="usuario" value=""><br>
                </div>

                <div class="wrap-input100" data-validate="Password incorrecto">
                <span class="icon-key"></span><input class="inp" type="password" id="password" name="password" value=""><br>
                </div>
                <a href="" class="he">He olvidado mi contraseña</a>
                <input class="boton" type="submit" name="inicio" value="Iniciar Sesion">
            </form>
        </article>
    </div>

</div>
<script src="../../resources/jquery/jquery-3.3.1.min.js"></script>
<script src="../../resources/bootstrap/js/bootstrap.min.js"></script>
<script src="../../resources/popper/popper.min.js"></script>

<script src="../../plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="codigo.js"></script>
</body>
</html>
