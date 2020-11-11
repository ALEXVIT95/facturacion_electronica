<?php
class subMenu extends Conectar {

    public function get_submenu(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM tbl_sub-menu WHERE ME_ESTADO= 1;";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function insert_menu($sub_ruta,$sub_icon,$sub_nom,$men_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO tbl_sub-menu  VALUES(null,?,?,?,?,1)";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $sub_ruta);
        $sql->bindValue(2, $sub_icon);
        $sql->bindValue(3, $sub_nom);
        $sql->bindValue(4, $men_id);
        $sql->execute();
    }

    public function update_menu($men_id,$sub_ruta,$sub_icon,$sub_nom,$sub_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE tbl_sub-menu  SET
                SUB_URL=?,
                SUB_ICONO=?,
                SUB_DESCRIPCION=?,
                ME_ID=?
                WHERE
                SUB_ID=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $sub_ruta);
        $sql->bindValue(2, $sub_icon);
        $sql->bindValue(3, $sub_nom);
        $sql->bindValue(4, $men_id);
        $sql->bindValue(5, $sub_id);
        $sql->execute();
    }

    public function delete_menu($sub_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE tbl_sub-menu  SET SUB_ESTADO= 0 WHERE ME_ID=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $sub_id);
        $sql->execute();
    }

    public function get_submenu_x_id($sub_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM tbl_sub-menu WHERE ME_ID=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $sub_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

}