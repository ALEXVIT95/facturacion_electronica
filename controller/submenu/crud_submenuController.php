<?php include_once "../../model/conexion.php";
header("Content-Type: application/json"); //en cualquier lado lo puedes poner, a la final es para que se muestre el json còmo objeto

$Obj = new Conectar();
$pdo = $Obj->Conexion();


if ($_POST) {

    // ahora si quieres editar actualizar etc
    //tambien puedes poner esta validacion, que indica que debe existe el la variable si o si
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == "insertar") {
            $snombres = $_POST['snombres'];
            $surl= $_POST['surl'];
            $menu = $_POST['menu'];
            $sestado = $_POST['sestado'];
            $sborrado = '0';
            $cs_registro =  date('Y-m-d');




            $sql = "INSERT INTO tbl_sub_menu (ME_ID,SUB_DESCRIPCION,SUB_URL,SUB_ESTADO,SUB_F_CREACION,SUB_BORRADO) VALUES (:menu,:snombres,:surl,:sestado,:cs_registro,:sborrado)";
            $query = $pdo->prepare($sql);
            //BINDPARAM Vincula un parámetro al nombre de variable especificado
            $query->bindParam(':menu', $menu, PDO::PARAM_INT);
            $query->bindParam(':snombres', $snombres, PDO::PARAM_STR);
            $query->bindParam(':surl', $surl, PDO::PARAM_STR);
            $query->bindParam(':sestado', $sestado, PDO::PARAM_STR_CHAR);
            $query->bindParam(':sborrado', $sborrado, PDO::PARAM_INT);
            $query->bindParam(':cs_registro', $cs_registro, PDO::PARAM_STMT);
            $rsu = $query->execute();

            if ($rsu) {
                $response["success"] = true;
                $response["mensaje"] = "Se inserto correctamente";
            } else {
                $response["success"] = false;
                $response["mensaje"] = "No se inserto correctamente";
            }
            echo json_encode($response);
            exit;
        } elseif ($_POST['accion'] == "actualizar") {

            $codigo = $_POST['EidsubMenu'];
            $menu = $_POST['Ed_menu'];
            $snombres = $_POST['Esnombres'];
            $sestado = $_POST['Edsestado'];
            $surl = $_POST['Esurl'];
            if ( $sestado = $_POST['Edsestado'] == "<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>") {

                $sestado = $_POST['Edsestado'] = 'A';
            }elseif ($sestado = $_POST['Edsestado'] == "<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>"){
                $sestado = $_POST['Edsestado'] = 'I';
            }

            // "UPDATE tbl_medico SET ESP_ID = '$especialidad', MED_NOMBRES = '$nombres', MED_P_APELLIDO = '$P_Apellido', MED_S_APELLIDO = ' $S_Apellido', MED_GENERO = '$genero', MED_FECHA_NAC = '$f_naci', MED_DIRECCION = '$dir',  MED_CORREO = '$correo', MED_TELEFONO = '$telef', MED_TIPO_DNI = ' $t_dni', MED_DNI = ' $dni' WHERE MED_ID = '$codigo'
            $sqlu = "UPDATE tbl_sub_menu SET ME_ID = :menu, SUB_DESCRIPCION = :snombres, SUB_URL = :surl, SUB_ESTADO= :sestado WHERE SUB_ID = '$codigo' ";
            $queryu = $pdo->prepare($sqlu);
            $queryu->bindParam(':menu', $menu, PDO::PARAM_INT);
            $queryu->bindParam(':snombres', $snombres, PDO::PARAM_STR);
            $queryu->bindParam(':sestado', $sestado, PDO::PARAM_STR_CHAR);
            $queryu->bindParam(':surl', $surl, PDO::PARAM_STR);



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

            $codigo = $_POST['idsubMenuEl'];
            $sqle = "UPDATE tbl_sub_menu SET SUB_BORRADO = '1' where SUB_ID = '$codigo'";
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
