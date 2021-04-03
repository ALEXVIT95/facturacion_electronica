<?php include_once "../../model/conexion.php";
header("Content-Type: application/json"); //en cualquier lado lo puedes poner, a la final es para que se muestre el json còmo objeto

$Obj = new Conectar();
$pdo = $Obj->Conexion();


if ($_POST) {

    // ahora si quieres editar actualizar etc
    //tambien puedes poner esta validacion, que indica que debe existe el la variable si o si
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == "insertar") {
            $nombreproducto = $_POST['nombreproducto'];
            $codigo= $_POST['codigo'];
            $id_categoria = $_POST['id_categoria'];
            $proveedor = $_POST['proveedor'];
            $precio_c = $_POST['precio_c'];
            $precio_v = $_POST['precio_v'];
            $stockmin = $_POST['stockmin'];
            $stockmax = $_POST['stockmax'];
            $imgproducto = $_POST['imgproducto'];
            $descproducto = $_POST['descproducto'];
            $pestado = $_POST['pestado'];
            $pborrado = '0';
            $cs_registro =  date('Y-m-d');




            $sql = "INSERT INTO tbl_productos (PRO_NOMBRE,PRO_CODIGO,CA_ID,PR_ID,PRO_P_COMPRA,PRO_P_VENTA,PRO_STOCK_MIN,PRO_STOCK_MAX,PRO_IMAGEN,PRO_DESCRIPCION,PRO_ESTADO,PRO_BORRADO,PRO_F_CREACION) VALUES (:nombreproducto,:codigo,:id_categoria,:proveedor,:precio_c,:precio_v,:stockmin,:stockmax,:imgproducto,:descproducto,:pestado,:pborrado,:cs_registro)";
            $query = $pdo->prepare($sql);
            //BINDPARAM Vincula un parámetro al nombre de variable especificado
            $query->bindParam(':nombreproducto', $nombreproducto, PDO::PARAM_STMT);
            $query->bindParam(':codigo', $codigo, PDO::PARAM_STMT);
            $query->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $query->bindParam(':proveedor', $proveedor, PDO::PARAM_INT);
            $query->bindParam(':precio_c', $precio_c, PDO::PARAM_STMT);
            $query->bindParam(':precio_v', $precio_v, PDO::PARAM_STMT);
            $query->bindParam(':stockmin', $stockmin, PDO::PARAM_INT);
            $query->bindParam(':stockmax', $stockmax, PDO::PARAM_INT);
            $query->bindParam(':imgproducto', $imgproducto, PDO::PARAM_STMT);
            $query->bindParam(':descproducto', $descproducto, PDO::PARAM_STMT);
            $query->bindParam(':pestado', $pestado, PDO::PARAM_STR_CHAR);
            $query->bindParam(':pborrado', $pborrado, PDO::PARAM_INT);
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
            $id_producto = $_POST['Eidproducto'];
            $nombreproducto = $_POST['Enombreproducto'];
            $codigo= $_POST['Ecodigo'];
            $id_categoria = $_POST['Eid_categoria'];
            $proveedor = $_POST['Eproveedor'];
            $precio_c = $_POST['Eprecio_c'];
            $precio_v = $_POST['Eprecio_v'];
            $stockmin = $_POST['Estockmin'];
            $stockmax = $_POST['Estockmax'];
            $imgproducto = $_POST['Eimgproducto'];
            $descproducto = $_POST['Edescproducto'];

            if (  $pestado = $_POST['Epestado']== "<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>") {

                $pestado = $_POST['Epestado'] = 'A';
            }elseif ( $pestado = $_POST['Epestado'] == "<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>"){
                $pestado = $_POST['Epestado'] = 'I';
            }


            $sqlu = "UPDATE tbl_productos SET PRO_NOMBRE = :nombreproducto, PRO_CODIGO = :codigo, CA_ID = :id_categoria, PR_ID= :proveedor, PRO_P_COMPRA= :precio_c, PRO_P_VENTA= :precio_v, PRO_STOCK_MIN= :stockmin, PRO_STOCK_MAX= :stockmax, PRO_IMAGEN= :imgproducto, PRO_DESCRIPCION= :descproducto, PRO_ESTADO= :pestado WHERE PRO_ID = '$id_producto' ";
            $queryu = $pdo->prepare($sqlu);
            $queryu->bindParam(':nombreproducto', $nombreproducto, PDO::PARAM_STMT);
            $queryu->bindParam(':codigo', $codigo, PDO::PARAM_STMT);
            $queryu->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $queryu->bindParam(':proveedor', $proveedor, PDO::PARAM_INT);
            $queryu->bindParam(':precio_c', $precio_c, PDO::PARAM_STMT);
            $queryu->bindParam(':precio_v', $precio_v, PDO::PARAM_STMT);
            $queryu->bindParam(':stockmin', $stockmin, PDO::PARAM_INT);
            $queryu->bindParam(':stockmax', $stockmax, PDO::PARAM_INT);
            $queryu->bindParam(':imgproducto', $imgproducto, PDO::PARAM_STMT);
            $queryu->bindParam(':descproducto', $descproducto, PDO::PARAM_STMT);
            $queryu->bindParam(':pestado', $pestado, PDO::PARAM_STR_CHAR);



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

            $id_producto = $_POST['Elidproducto'];
            $sqle = "UPDATE tbl_productos SET PRO_BORRADO = '1' where PRO_ID = '$id_producto'";
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
