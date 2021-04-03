<?php
class Conectar{
    protected $dbh;
    public $conexion;

    Public function Conexion(): PDO
    {
        define('servidor','localhost');
        define('nombre_bd','facelect');
        define('usuario','root');
        define('password','');



        try {
            return $this->dbh = new PDO("mysql:host=".servidor.";dbname=".nombre_bd, usuario, password);
        } catch (Exception $e) {
            print "¡Error de conexion BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names(){
        return $this->dbh->query("SET NAMES 'utf8'");
    }

}

