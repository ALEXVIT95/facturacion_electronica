<?php
include_once '../../model/conexion.php';

$ob = new Conectar();
$co = $ob->Conexion();
//aqui obtenemos el valor del select
$id_rol = filter_input(INPUT_POST, 'id_rol');
$id_rol = filter_input(INPUT_POST, 'Ed_rol');
if($id_rol = filter_input(INPUT_POST, 'id_rol')) {


//aqui hacemos la consulta usando el valor del select como condicion

    $sql = "SELECT ME_ID,ME_DESCRIPCION FROM tbl_menu WHERE RO_ID = $id_rol";
    $query = $co->prepare($sql);
    $query->execute();
    $datos = $query->fetchAll();


//aqui hacemos la condicion de que si hay registros en la base retorne el resultado

    if (count($datos) == 0) {
        echo '<option value="0">No hay registros </option>';
    } else {

        echo '<option selected  id="menu" value="" >Seleccione una opcion</option>';
        foreach ($datos as $val) {

            echo ' <option value="' . $val['ME_ID'] . '">' . $val['ME_DESCRIPCION'] . '</option>';


        }
    }

}elseif ($id_rol = filter_input(INPUT_POST, 'Ed_rol')){


    $sql = "SELECT ME_ID,ME_DESCRIPCION FROM tbl_menu WHERE RO_ID = $id_rol";
    $query = $co->prepare($sql);
    $query->execute();
    $datos = $query->fetchAll();


//aqui hacemos la condicion de que si hay registros en la base retorne el resultado

    if (count($datos) == 0) {
        echo '<option value="0">No hay registros </option>';
    } else {

        echo '<option selected  id="menu" value="" >Seleccione una opcion</option>';
        foreach ($datos as $val) {

            echo ' <option value="' . $val['ME_ID'] . '">' . $val['ME_DESCRIPCION'] . '</option>';


        }
    }


}