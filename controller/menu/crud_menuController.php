<?php include_once "../../model/conexion.php";
header("Content-Type: application/json"); //en cualquier lado lo puedes poner, a la final es para que se muestre el json còmo objeto

$Obj = new Conectar();
$pdo = $Obj->Conexion();


if ($_POST) {

    // ahora si quieres editar actualizar etc
    //tambien puedes poner esta validacion, que indica que debe existe el la variable si o si
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == "insertar") {
            $nombres = $_POST['nombres'];
            $icono= $_POST['icono'];
            $rol = $_POST['rol'];
            $estado = $_POST['estado'];
            $borrado = '0';
            $c_registro =  date('Y-m-d');




            $sql = "INSERT INTO tbl_menu (RO_ID,ME_DESCRIPCION,ME_ICONO,ME_ESTADO,ME_F_CREACION,ME_BORRADO) VALUES (:rol,:nombres,:icono,:estado,:c_registro,:borrado)";
            $query = $pdo->prepare($sql);
            //BINDPARAM Vincula un parámetro al nombre de variable especificado
            $query->bindParam(':rol', $rol, PDO::PARAM_INT);
            $query->bindParam(':nombres', $nombres, PDO::PARAM_STR);
            $query->bindParam(':icono', $icono, PDO::PARAM_STR);
            $query->bindParam(':estado', $estado, PDO::PARAM_STR_CHAR);
            $query->bindParam(':c_registro', $c_registro, PDO::PARAM_STMT);
            $query->bindParam(':borrado', $borrado, PDO::PARAM_INT);
            $rs = $query->execute();

            if ($rs) {
                $response["success"] = true;
                $response["mensaje"] = "Se inserto correctamente";
            } else {
                $response["success"] = false;
                $response["mensaje"] = "No se inserto correctamente";
            }
            echo json_encode($response);
            exit;
        } elseif ($_POST['accion'] == "actualizar") {

            $codigo = $_POST['EidMenu'];
            $rol = $_POST['Ed_rol'];
            $nombres = $_POST['Enombres'];
            $icono = $_POST['Eicono'];
            $estado = $_POST['Eestado'];
            if ( $estado = $_POST['Eestado'] == "<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>") {

                $estado = $_POST['Eestado'] = 'A';
            }elseif ($estado = $_POST['Eestado'] == "<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>"){
                $estado = $_POST['Eestado'] = 'I';
            }

            // "UPDATE tbl_medico SET ESP_ID = '$especialidad', MED_NOMBRES = '$nombres', MED_P_APELLIDO = '$P_Apellido', MED_S_APELLIDO = ' $S_Apellido', MED_GENERO = '$genero', MED_FECHA_NAC = '$f_naci', MED_DIRECCION = '$dir',  MED_CORREO = '$correo', MED_TELEFONO = '$telef', MED_TIPO_DNI = ' $t_dni', MED_DNI = ' $dni' WHERE MED_ID = '$codigo'
            $sqlu = "UPDATE tbl_menu SET RO_ID = :rol, ME_DESCRIPCION = :nombres, ME_ICONO = :icono, ME_ESTADO = :estado WHERE ME_ID = '$codigo' ";
            $queryu = $pdo->prepare($sqlu);
            $queryu->bindParam(':rol', $rol, PDO::PARAM_INT);
            $queryu->bindParam(':nombres', $nombres, PDO::PARAM_STR);
            $queryu->bindParam(':icono', $icono, PDO::PARAM_STR);
            $queryu->bindParam(':estado', $estado, PDO::PARAM_STR_CHAR);


            $rsu = $queryu->execute();

            if ($rsu) {
                $response["success"] = true;
                $response["mensaje"] = "Se modifico correctamente";
            } else {
                $response["success"] = false;
                $response["mensaje"] = "No se modifico correctamente";
                $response["consulta"] = $queryu;
                $response["execute"] = $rsu;
            }
            echo json_encode($response);
            exit;
        } elseif ($_POST['accion'] == "eliminar") {

            $codigo = $_POST['idMenuEl'];
            $sqle = "UPDATE tbl_menu SET ME_BORRADO = '1' where ME_ID = '$codigo'";
            $querye = $pdo->prepare($sqle);
            $rse = $querye->execute();

            if ($rse) {
                $response["success"] = true;
                $response["mensaje"] = "Se elimino correctamente";
                $response["co"] = $querye;
                $response["exe"] = $rse;
            } else {
                $response["success"] = false;
                $response["mensaje"] = "No se elimino correctamente";
                $response["co"] = $querye;
                $response["exe"] = $rse;
            }
            echo json_encode($response);
            exit;


        } else {
            //esto tambien es opcional, ya depende de ti còmo controlas el error
            $response["success"] = false;
            $response['mensaje'] = "no existe la accion insertar, actualizar o eliminar"; //es opcional esto

            echo json_encode($response);
            exit;
        }

    }
}
