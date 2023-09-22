<?php
require_once "ConDB.php";
class ModelUsers{

    static public function createUser($data){   
       
        $cantMail=self::getMail($data["usu_mail"]);
        $cantUsu=self::getMail($data["usu_usuario"]);
        if ($cantMail==0){
            if ($cantUsu == 0){               
                $query= "INSERT INTO usuario (usu_id,usu_usuario, usu_contra, usu_mail, rol_id,usu_dateUpdate,usu_identifier,usu_key,usu_status) VALUES (NULL,:usu_usuario, :usu_contra,:usu_mail, :rol_id, :usu_dateUpdate,:usu_identifier,:usu_key,:usu_status);";            
                $status="0";
                $statement  = Connection::conecction()->prepare($query);
                $statement-> bindParam(":usu_usuario", ($data["usu_usuario"]),PDO::PARAM_STR);
                $statement-> bindParam(":usu_contra",  ($data["usu_contra"]),PDO::PARAM_STR);
                $statement-> bindParam(":usu_mail", $data["usu_mail"],PDO::PARAM_STR);
                $statement-> bindParam(":rol_id", $data["rol_id"],PDO::PARAM_STR);
                $statement-> bindParam(":usu_dateUpdate", $data["usu_dateUpdate"],PDO::PARAM_STR);
                $statement-> bindParam(":usu_identifier", $data["usu_identifier"],PDO::PARAM_STR);
                $statement-> bindParam(":usu_key", $data["usu_key"],PDO::PARAM_STR);       
                $statement-> bindParam(":usu_status",$status,PDO::PARAM_STR); 
                $mesage = $statement-> execute() ? "ok" : Connection::conecction()->errorInfo();
                $statement-> closeCursor();
                $statement= null;
                $query = "";
               
            }else{
                $mesage ="Usuario ya existe";
            }    
        }else{
            $mesage ="Correo ya existe";
        }
        return $mesage; 
    }

    static private function getMail($correo){
        $query="SELECT usu_mail FROM usuario WHERE usu_mail='$correo'";        
        $statement  = Connection::conecction()->prepare($query);
          $statement->execute();
          $result=$statement->rowCount();               
          return $result;
    }
    static private function getUsuario($usu){
        $query="SELECT usu_usuario FROM usuario WHERE usu_usuario='$usu'";        
        $statement  = Connection::conecction()->prepare($query);
          $statement->execute();
          $result=$statement->rowCount();               
          return $result;
    }

    static public function getUsers($param){
        $param =  is_numeric($param) ? $param : 0;
        $query ="SELECT usuario.usu_id, usuario.usu_usuario, usuario.usu_mail, usuario.rol_id, usu_dateUpdate,
        rol.rol_id, rol.rol_descripcion
        FROM usuario
        INNER JOIN rol ON usuario.rol_id = rol.rol_id";
         $query .= ($param > 0) ? " WHERE usuario.usu_id ='$param' AND " : "";
         $query .= ($param > 0) ? " usu_status ='1';" : " and usu_status ='1';";
         //echo $query;
          $statement  = Connection::conecction()->prepare($query);
           $statement->execute();
           $result=$statement->fetchAll(PDO::FETCH_ASSOC);         
           return $result;
    }

    static public function login($data){
       //print_r($data);
        $user = $data['usu_mail'];
        $pss = ($data['usu_contra']);
        //echo $pss;

        if(!empty($user) && !empty($pss)){
            $query="SELECT usu_identifier, usu_key, usu_id  FROM usuario WHERE usu_mail='$user' and usu_contra='$pss'";
           // echo $query;
            $statement  = Connection::conecction()->prepare($query);
            $statement->execute();
            $result=$statement->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }else{
            throw new Exception(LOGIN_FIELDS_MISSING);
        }

    }

    static public function getUsersAuth(){        
        $query="";
        $query= "SELECT usu_identifier, usu_key, usu_id FROM usuario WHERE usu_status ='1';" ;
        $statement  = Connection::conecction()->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);         
        return $result;
    }

}
?>