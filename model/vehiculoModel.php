<?php
require_once "ConDB.php";
class ModelVehiculo{

    static public function postVehiculo($data){   
            $query = "insert into visitante values('',?,?,?,?,?)";
            $statement  = Connection::conecction()->prepare($query);
            if ($statement->execute([
                $data['veh_tipo'],
                $data['veh_placa'],
                $data['veh_parqueo'],
                $data['veh_foto'],
                $data['vis_id']                          
            ])){                
                    return "ok";
                
            }else{
                return Conecction::conecction()->errorInfo();
            }   
    }

    static public function getVehiculos(){
        return "todo";
    } 
    static public function getVehiculosPlaca($placa){
        $query ="SELECT vehiculo.veh_id, vehiculo.veh_tipo, vehiculo.veh_placa, vehiculo.veh_parqueo, vehiculo.veh_foto,
        vehiculo.vis_id
        FROM vehiculo
        WHERE vehiculo.veh_placa = '$placa';";
          $statement  = Connection::conecction()->prepare($query);
          $statement->execute();
          $result=$statement->fetchAll(PDO::FETCH_ASSOC);         
          return $result;
    } 
    static public function getVehiculosVisitante($idVisitante){
        $query ="SELECT vehiculo.veh_id, vehiculo.veh_tipo, vehiculo.veh_placa, vehiculo.veh_parqueo, vehiculo.veh_foto,
        vehiculo.vis_id
        FROM vehiculo
        WHERE vehiculo.vis_id = '$idVisitante';";
          $statement  = Connection::conecction()->prepare($query);
          $statement->execute();
          $result=$statement->fetchAll(PDO::FETCH_ASSOC);         
          return $result;
        
    } 
    static public function getVehiculosUsuario($idUsuario){
        $query ="SELECT vehiculo.veh_id, vehiculo.veh_tipo, vehiculo.veh_placa, vehiculo.veh_parqueo, vehiculo.veh_foto,
        vehiculo.vis_id
        FROM vehiculo
        WHERE vehiculo.vis_id = '$idUsuario';";
          $statement  = Connection::conecction()->prepare($query);
          $statement->execute();
          $result=$statement->fetchAll(PDO::FETCH_ASSOC);         
          return $result;
        
    } 
     
        
}
?>