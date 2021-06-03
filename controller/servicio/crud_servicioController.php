<?php include_once "../../model/conexion.php";
header("Content-Type: application/json"); //en cualquier lado lo puedes poner, a la final es para que se muestre el json còmo objeto

$Obj = new Conectar();
$pdo = $Obj->Conexion();


if ($_POST) {

    // ahora si quieres editar actualizar etc
    //tambien puedes poner esta validacion, que indica que debe existe el la variable si o si
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == "insertar") {
            $nombreservicio = $_POST['nombreservicio'];
            $scodigo= $_POST['scodigo'];
            $sprecio_v = $_POST['sprecio_v'];
            $descservicio = $_POST['descservicio'];
            $sestado = $_POST['sestado'];
            $sborrado = '0';
            $cs_registro =  date('Y-m-d');




            $sql = "INSERT INTO tbl_servicio (SER_NOMBRE,SER_COD_AUX,SER_P_VENTA,SER_DESCRIPCION,SER_ESTADO,SER_BORRADO,SER_F_CREACION) VALUES (:nombreservicio,:scodigo,:sprecio_v,:descservicio,:sestado,:sborrado,:cs_registro)";
            $query = $pdo->prepare($sql);
            //BINDPARAM Vincula un parámetro al nombre de variable especificado
            $query->bindParam(':nombreservicio', $nombreservicio, PDO::PARAM_STMT);
            $query->bindParam(':scodigo', $scodigo, PDO::PARAM_STMT);
            $query->bindParam(':sprecio_v', $sprecio_v, PDO::PARAM_STMT);
            $query->bindParam(':descservicio', $descservicio, PDO::PARAM_STMT);
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
            $id_servicio = $_POST['Eidservicio'];
            $nombreservicio = $_POST['Enombreservicio'];
            $scodigo= $_POST['Escodigo'];
            $sprecio_v = $_POST['Esprecio_v'];
            $descservicio = $_POST['Edescservicio'];

            if (  $sestado = $_POST['Esestado']== "<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>") {

                $sestado = $_POST['Esestado'] = 'A';
            }elseif ( $pestado = $_POST['Esestado'] == "<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>"){
                $sestado = $_POST['Esestado'] = 'I';
            }


            $sqlu = "UPDATE tbl_servicio SET SER_NOMBRE = :nombreservicio, SER_COD_AUX = :scodigo,  SER_P_VENTA= :sprecio_v, SER_DESCRIPCION= :descservicio, SER_ESTADO= :sestado WHERE SER_ID = '$id_servicio' ";
            $queryu = $pdo->prepare($sqlu);
            $queryu->bindParam(':nombreservicio', $nombreservicio, PDO::PARAM_STMT);
            $queryu->bindParam(':scodigo', $scodigo, PDO::PARAM_STMT);
            $queryu->bindParam(':sprecio_v', $sprecio_v, PDO::PARAM_STMT);
            $queryu->bindParam(':descservicio', $descservicio, PDO::PARAM_STMT);
            $queryu->bindParam(':sestado', $sestado, PDO::PARAM_STR_CHAR);



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

            $id_servicio = $_POST['Elidservicio'];

            $sqle = "UPDATE tbl_servicio SET SER_BORRADO = '1' where SER_ID = '$id_servicio'";
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
