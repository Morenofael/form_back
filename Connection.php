<?php
class Connection{
    private static $conn = null;
    public static function getConnection(){
        if(self::$conn == null){
            $opcoes = array(
                //Define o charset da conexão
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                //Define o tipo do erro como exceção
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            self::$conn = new PDO("mysql:host=localhost;dbname=dblivros","root","bancodedados",$opcoes);
        print_r(self::$conn);
        }

        return self::$conn;
    } 
}
?>