<?php
include_once '../../model/conexion.php';
$ob = new Conectar();
$co = $ob->Conexion();


$sql = "SELECT * FROM tbl_usuario INNER JOIN tbl_rol ON tbl_usuario.RO_ID = tbl_rol.RO_ID  WHERE USU_BORRADO = '0'"  ;
$query = $co->prepare($sql);
$query->execute();
$result = $query->fetchAll();



$usuario = array();
foreach ($result as $row) {
    $id = $row['USU_ID'];
    $nombres = $row['USU_NOMBRES'];
    $apellidoP = $row['USU_APELLIDOS'] ;

    $espeid = $row['RO_ID'];
    $espedes = $row['RO_DESCRIPCION'];


    $dir = $row['USU_USUARIO'];
    $clave= $row['USU_CLAVE'];
    $correo = $row['USU_CORREO'];
    $tel = $row['USU_IMAGEN'];
    $estado = $row['USU_ESTADO'];
    if ( $estado = $row['USU_ESTADO'] == 'A') {

        $estado = $row['USU_ESTADO'] = "<span class='badge badge-success'><i class='fa fa-check'></i> Activo</span>";
    }elseif ($estado = $row['USU_ESTADO'] == 'I'){
        $estado = $row['USU_ESTADO'] = "<span class='badge badge-danger'><i class='fa fa-stop-circle'></i> Inactivo</span>";
    }

    $usuario[]=array( 'USU_ID'=>$id,
        'USU_NOMBRES'=>$nombres,
        'USU_APELLIDOS'=>$apellidoP,
        'RO_ID'=>$espeid,
        'RO_DESCRIPCION'=>$espedes,
        'USU_USUARIO'=>$dir,
        'USU_CLAVE'=>$clave,
        'USU_CORREO'=>$correo,
        'USU_IMAGEN'=>$tel,
        'USU_ESTADO'=>$estado);
}


$data["data"]= $usuario;
$resultadoJson=json_encode($data);
echo $resultadoJson;