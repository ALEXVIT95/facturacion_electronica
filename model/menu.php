<?php
    require_once("../model/conexion.php");
    require_once("../model/Menu.php");
    $menu = new Menu();

    switch($_GET["op"]){

        case "listar":
            $datos=$menu->get_menu();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["ME_URL"];
                $sub_array[] = $row["ME_ICONO"];
                $sub_array[] = $row["ME_DESCRIPCION"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["ME_ID"].');"  id="'.$row["ME_ID"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["ME_ID"].');"  id="'.$row["ME_ID"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[] = $sub_array;
            }
        
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "activarydesactivar":
            $datos=$menu->get_menu_x_id($_POST["ME_ID"]);
            if(is_array($datos)==true and count($datos)>0){
                $menu->delete_menu($_POST["ME_ID"]);
            } 
        break;

        case 'mostrar':
            $datos=$menu->get_menu_x_id($_POST["ME_ID"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["ME_ID"] = $row["ME_ID"];
                    $output["ME_URL"] = $row["ME_URL"];
                    $output["ME_ICONO"] = $row["ME_ICONO"];
                    $output["ME_DESCRIPCION"] = $row["ME_DESCRIPCION"];
                }
                echo json_encode($output);
            }
        break;

        case "guardaryeditar":
            if(empty($_POST["ME_ID"])){
                $menu->insert_menu($_POST["ME_URL"],$_POST["ME_ICONO"],$_POST["ME_DESCRIPCION"]);
            }
            else {
                $menu->update_menu($_POST["ME_ID"],$_POST["ME_URL"],$_POST["ME_ICONO"],$_POST["ME_DESCRIPCION"]);
            }
        break;

    }
