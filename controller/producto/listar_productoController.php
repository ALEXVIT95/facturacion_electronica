<?php

include_once '../../model/conexion.php';

$ob = new Conectar();
$co = $ob->Conexion();

$sql = "SELECT * FROM tbl_productos INNER JOIN tbl_proveedor ON  tbl_productos.PR_ID = tbl_proveedor.PR_ID INNER JOIN tbl_categorias ON tbl_productos.CA_ID = tbl_categorias.CA_ID
WHERE tbl_productos.PRO_ESTADO = 'A' AND tbl_productos.PRO_BORRADO = 0";
$query = $co->prepare($sql);

$query->execute();
$result = $query->fetchAll();



    $productos = array();
    foreach ($result as $row) {
        $id = $row['PRO_ID'];
        $codigo = $row['PRO_CODIGO'];
        $nombres = $row['PRO_NOMBRE'];
        $categoria = $row['CA_DESCRIPCION'];
        $idcategoria = $row ['CA_ID'];
        $descripcion = $row['PRO_DESCRIPCION'];
        $proovedor = $row['PR_EMPRESA'];
        $idproovedor = $row['PR_ID'];
        $precioc = $row['PRO_P_COMPRA'];
        $preciop = $row['PRO_P_VENTA'];
        $stockmin = $row['PRO_STOCK_MIN'];
        $stockmax = $row['PRO_STOCK_MAX'];
        $urlimg = $row['PRO_IMAGEN'];


        $estado = $row['PRO_ESTADO'];
        if ($estado = $row['PRO_ESTADO'] == 'A') {

            $estado = $row['PRO_ESTADO'] = "<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>";
        } elseif ($estado = $row['PRO_ESTADO'] == 'I') {
            $estado = $row['PRO_ESTADO'] = "<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>";
        }

        $productos[] = array('PRO_ID' => $id,
            'PRO_CODIGO' => $codigo,
            'PRO_NOMBRE' => $nombres,
            'CA_DESCRIPCION' => $categoria,
            'CA_ID' => $idcategoria,
            'PRO_DESCRIPCION' => $descripcion,
            'PR_EMPRESA' => $proovedor,
            'PR_ID' => $idproovedor,
            'PRO_P_COMPRA' => $precioc,
            'PRO_P_VENTA' => $preciop,
            'PRO_STOCK_MIN' => $stockmin,
            'PRO_STOCK_MAX' => $stockmax,
            'PRO_IMAGEN' => $urlimg,
            'PRO_ESTADO' => $estado);
    }


    $data["data"] = $productos;
    $resultadoJson = json_encode($data);
    echo $resultadoJson;
