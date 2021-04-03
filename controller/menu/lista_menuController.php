<?php
include_once '../../model/conexion.php';
$ob = new Conectar();
$co = $ob->Conexion();

$sql = "SELECT * FROM tbl_menu INNER JOIN tbl_rol ON tbl_menu.RO_ID = tbl_rol.RO_ID WHERE ME_BORRADO = '0'";
$query = $co->prepare($sql);
$query->execute();
$result = $query->fetchAll();

$menu = array();
foreach ($result as $row) {
    $id = $row['ME_ID'];
    $nombres = $row['ME_DESCRIPCION'];
    $meicono = $row['ME_ICONO'] ;
    $roid = $row['RO_ID'];
    $rodescipcion = $row['RO_DESCRIPCION'];
    $estado = $row['ME_ESTADO'];
    if ( $estado = $row['ME_ESTADO'] == 'A') {

        $estado = $row['ME_ESTADO'] = "<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>";
    }elseif ($estado = $row['ME_ESTADO'] == 'I'){
        $estado = $row['ME_ESTADO'] = "<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>";
    }

    $menu[]=array( 'ME_ID'=>$id,
        'ME_DESCRIPCION'=>$nombres,
        'ME_ICONO'=>$meicono,
        'RO_ID'=>$roid,
        'RO_DESCRIPCION'=>$rodescipcion,
        'ME_ESTADO'=>$estado);
}


$data["data"]= $menu;
$resultadoJson=json_encode($data);
echo $resultadoJson;
