<?php
require_once("config.php");


class Connection{
    public static $conne = null;
    static public function conecction(){        
        try{        
            $data = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=UTF8";  
            self::$conne = new PDO($data,DB_USERNAME,DB_PASSWORD);  
                      
        } catch (PDOException $e) {
            $mensaje = array(
                "COD" => "000",
                "MENSAJE" => (ERROR_CON . $e)
            );
            echo ($e->getMessage());
        }
        return self::$conne;
    }

    static public function  ultimo(){
        return self::$conne->lastInsertId(); 
    }
}

?>