<?php

include_once '../../model/conexion.php';

$ob = new Conectar();
$co = $ob->Conexion();

$sql = "SELECT * FROM tbl_menu INNER JOIN tbl_sub_menu INNER JOIN tbl_rol ON tbl_menu.ME_ID = tbl_sub_menu.ME_ID AND tbl_rol.RO_ID = tbl_menu.RO_ID WHERE SUB_BORRADO = '0'";
$query = $co->prepare($sql);

$query->execute();
$result = $query->fetchAll();

$menu = array();
foreach ($result as $row) {
    $id = $row['SUB_ID'];
    $nombres = $row['SUB_DESCRIPCION'];
    $meid = $row['ME_ID'] ;
    $roid = $row['RO_ID'];
    $rodescipcion = $row['RO_DESCRIPCION'];
    $medescipcion = $row['ME_DESCRIPCION'];
    $meurl = $row['SUB_URL'];
    $estado = $row['SUB_ESTADO'];
    if ( $estado = $row['SUB_ESTADO'] == 'A') {

        $estado = $row['SUB_ESTADO'] = "<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>";
    }elseif ($estado = $row['SUB_ESTADO'] == 'I'){
        $estado = $row['SUB_ESTADO'] = "<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>";
    }

    $menu[]=array( 'SUB_ID'=>$id,
        'SUB_DESCRIPCION'=>$nombres,
        'ME_ID'=>$meid,
        'ME_DESCRIPCION'=>$medescipcion,
        'SUB_URL'=>$meurl,
        'RO_DESCRIPCION'=>$rodescipcion,
        'RO_ID'=>$roid,
        'SUB_ESTADO'=>$estado);
}


$data["data"]= $menu;
$resultadoJson=json_encode($data);
echo $resultadoJson;
