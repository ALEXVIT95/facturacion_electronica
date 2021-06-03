<?php

include_once '../../model/conexion.php';

$ob = new Conectar();
$co = $ob->Conexion();

$sql = "SELECT SER_NOMBRE, SER_DESCRIPCION, SER_P_VENTA, SER_ID, SER_ESTADO, SER_COD_AUX FROM tbl_servicio WHERE SER_BORRADO = 0";
$query = $co->prepare($sql);

$query->execute();
$result = $query->fetchAll();



    $productos = array();
    foreach ($result as $row) {
        $id = $row['SER_ID'];
        $codigo = $row['SER_COD_AUX'];
        $nombres = $row['SER_NOMBRE'];
        $descripcion = $row['SER_DESCRIPCION'];
        $preciop = $row['SER_P_VENTA'];



        $estado = $row['SER_ESTADO'];
        if ($estado = $row['SER_ESTADO'] == 'A') {

            $estado = $row['SER_ESTADO'] = "<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>";
        } elseif ($estado = $row['SER_ESTADO'] == 'I') {
            $estado = $row['SER_ESTADO'] = "<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>";
        }

        $productos[] = array('SER_ID' => $id,
            'SER_COD_AUX' => $codigo,
            'SER_NOMBRE' => $nombres,
            'SER_DESCRIPCION' => $descripcion,
            'SER_P_VENTA' => $preciop,
            'SER_ESTADO' => $estado);
    }


    $data["data"] = $productos;
    $resultadoJson = json_encode($data);
    echo $resultadoJson;
