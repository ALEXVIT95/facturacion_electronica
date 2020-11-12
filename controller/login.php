    <?php


    include_once '../model/conexion.php';

    session_start();
    $objeto = new Conectar();
    $conexion = $objeto->Conexion();

    //recepción de datos enviados mediante POST desde ajax
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
    $password = (isset($_POST['password'])) ? $_POST['password'] : '';

    $pass = md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD

    $consulta = "SELECT * FROM tbl_usuario WHERE USU_USUARIO='$usuario' AND USU_CLAVE='$pass' AND USU_ESTADO='A' ";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

    if ($resultado->rowCount() >= 1) {
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION["s_usuario"] = $usuario;
    } else {
        $_SESSION["s_usuario"] = null;
        $data = null;
    }

    print json_encode($data);
    $conexion = null;
