<?php
class Conectar{
    protected $dbh;
    Public function Conexion(){
        define('servidor','localhost');
        define('nombre_bd','facelect');
        define('usuario','root');
        define('password','');



        try {
            $conectar = $this->dbh = new PDO("mysql:host=".servidor.";dbname=".nombre_bd, usuario, password);

            return $conectar;
        } catch (Exception $e) {
            print "¡Error Mesa de Partes BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names(){
        return $this->dbh->query("SET NAMES 'utf8'");
    }


}

