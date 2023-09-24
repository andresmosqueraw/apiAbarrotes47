<?php
require_once "ConDB.php";
class ModelEvento{

    
    
    static public function getEvento($table,$param){
        $param =  is_numeric($param) ? $param : 0;
        $query="";
        $query= $param==0 ? "SELECT * FROM $table" : "SELECT * FROM $table WHERE eve_id = $param";
        $statement  = Connection::conecction()->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);         
        return $result;
    }
    
    static public function postEvento($data){   
        if (!empty($data)) {
            date_default_timezone_set('America/Bogota');        
            $horaActual= date('h:i:s');
            $fechaActual = date('Y-m-d');  
            $query = "insert into evento values('',?,?,?,?,?,?,?)";
            $statement  = Connection::conecction()->prepare($query);
            if ($statement->execute([
                $data['eve_ubicacion'],           
                $fechaActual,
                $horaActual,
                $data['eve_fecha_evento'],
                $data['eve_hora_evento'],
                $data['eve_observaciones'],
                $data['tipo_evento_id']
            ])){
                $idEvento = Connection::ultimo();
                return  $idEvento;
            }else{
                return Conecction::conecction()->errorInfo();
            }
       }else{
        return "Error en postEvento";
       }
    }
       
    
    static public function putCourses(array $data){
        return $result=200;
    }
    static public function searchCourses($course){
        if (($course!=null) || (!empty($course))){
            $query = "SELECT * FROM courses WHERE cur_name = '$course'";
            $statement  = Connection::conecction()->prepare($query);
            $statement->execute();    
            $count = $statement=$statement->rowCount();                    
            return $count;
        }

}
}
?>