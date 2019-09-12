<?php
class Conexao{

    private static $host = "localhost";
    private static $db = "agenda";
    private static $user = "root";
    private static $pass = "";

    public function __construct(){}

    public function __clone(){}

    public function getHost(){return self::$host;}
    public function getDB(){return self::$db;}
    public function getUser(){return self::$user;}
    public function getPass(){return self::$pass;}

    public function connect(){
        try {
            $this->conexao = new PDO("mysql:host=".$this->getHost().";dbname=".$this->getDB()."",$this->getUser(),$this->getPass(),array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $this->conexao;
        }
        catch (PDOException $i)
        {
            die("Erro: <h4>" . $i->getMessage() . "</h4>");
        }
    }
}


?>