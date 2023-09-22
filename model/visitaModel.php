<?php
require_once "ConDB.php";
require_once "eventoModel.php";
class ModelVisita{

    static public function postVisita($data){   
        $response = ModelEvento::postEvento($data);
        if ($response >0 ){
            $query = "insert into visitante values('',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $statement  = Connection::conecction()->prepare($query);
            if ($statement->execute([
                $data['vis_nombres'],
                $data['vis_apellidos'],
                $data['tipo_iden'],
                $data['vis_identificacion'],
                $data['vis_vis_empresa_representa'],
                $data['vis_piso'],
                $data['vis_oficina_aparta'],
                $data['vis_torre'],
                $data['vis_motivo_visita'],
                $data['vis_cant_personas'],
                $data['vis_autoriza'],
                $data['tipo_vis_id'], 
                $data['usu_id'],
                $data['vis_foto'],
                $data['vis_lugar_custodia']
                           
            ])){
                $idVisitante = Connection::ultimo();
                $query = "insert into evento_visitante values('',?,?,'','')";
                $statement  = Connection::conecction()->prepare($query);
                if ($statement->execute([$response,$idVisitante])){
                    return "ok";
                }else{
                    return Conecction::conecction()->errorInfo();
                }
            }else{
                return Conecction::conecction()->errorInfo();
            }   
        } 
        
       }
    static public function postSalida($data){
        if(!empty($data)){
            if(self::id($data['eve_id'],$data['vis_id']) > 0){
                $query = "UPDATE evento_visitante set ev_fecha_salida=?,ev_hora_salida=? 
                WHERE eve_id=? AND vis_id=?";
                $statement  = Connection::conecction()->prepare($query);
                if ($statement->execute([                   
                    $data['ev_fecha_salida'],
                    $data['ev_hora_salida'],
                    $data['eve_id'],
                    $data['vis_id']
                ])){
                    return "OK";
                }
            }
        }
    }

    static public function id($idEvento,$idVisitante){
        //echo ($idEvento." ".$idVisitante);
        if(is_numeric($idEvento) && is_numeric($idVisitante)){
            $query = "SELECT eve_vis_id FROM evento_visitante WHERE eve_id= '$idEvento' AND vis_id ='$idVisitante'";
            $statement  = Connection::conecction()->prepare($query);
            $statement->execute();
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);   
               
            return $result;
        }
    }

    static public function buscarVisitante($documento){
        if(!empty($documento) && is_numeric($documento)){
            $query = "SELECT vis_identificacion FROM visitante WHERE vis_identificacion= '$documento'";
            $statement  = Connection::conecction()->prepare($query);
            $statement->execute();
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);         
            return $result;
        }
    }
    
    static public function getVisitaDoc($documento){        
        $documento =  is_numeric($documento) ? $documento : 0;
        $query = "SELECT evento.eve_id, evento.eve_ubicacion, evento.eve_fecha_sist, evento.eve_hora_sist,evento.eve_observaciones, evento.tipo_evento_id, tipo_evento.tipo_evento_id,tipo_evento.tipo_evento_descripcion, visitante.vis_id, visitante.vis_nombres, visitante.vis_apellidos,visitante.vis_identificacion,visitante.tipo_iden, tipo_identificacion.tipo_iden, tipo_identificacion.tipo_iden_descripcion,
        visitante.vis_vis_empresa_representa, visitante.vis_piso, visitante.vis_oficina_aparta, visitante.vis_torre, visitante.vis_motivo_visita,visitante.vis_cant_personas, visitante.vis_autoriza,
        visitante.tipo_vis_id, tipo_visitante.tipo_vis_id, tipo_visitante.tipo_vis_descr,
        visitante.usu_id, usuario.usu_id, usuario.usu_usuario,usuario.usu_mail,
        mensajeria_entrega.men_id as menid, mensajeria_entrega.men_nombre_recibe as menrecibe, 
        mensajeria_entrega.men_firma as menfirma, mensajeria_entrega.tipo_iden as miden, mensajeria_entrega.men_documento_recibe as mendoc, mensajeria_entrega.vis_id as menvisid,
        td.tipo_iden, td.tipo_iden_descripcion
        FROM evento INNER JOIN tipo_evento ON tipo_evento.tipo_evento_id = evento.tipo_evento_id 
        LEFT OUTER JOIN evento_visitante ON evento_visitante.eve_id = evento.eve_id 
        INNER JOIN visitante ON evento_visitante.vis_id = visitante.vis_id
        INNER JOIN tipo_identificacion ON visitante.tipo_iden = tipo_identificacion.tipo_iden
        INNER JOIN tipo_visitante ON visitante.tipo_vis_id = tipo_visitante.tipo_vis_id
        INNER JOIN usuario ON visitante.usu_id=usuario.usu_id
        LEFT OUTER JOIN mensajeria_entrega ON visitante.vis_id= mensajeria_entrega.vis_id
        LEFT OUTER JOIN tipo_identificacion td ON td.tipo_iden = mensajeria_entrega.tipo_iden ";
        $query .= ($documento > 0) ? " WHERE visitante.vis_identificacion='$documento' " : "";
        //echo $query;
        $statement  = Connection::conecction()->prepare($query);
         $statement->execute();
         $result=$statement->fetchAll(PDO::FETCH_ASSOC);         
         return $result;
    }
    

    static public function getVisitaByUser($usuario){        
        $usuario =  is_numeric($usuario) ? $usuario : 0;
        $query = "SELECT evento.eve_id, evento.eve_ubicacion, evento.eve_fecha_sist, evento.eve_hora_sist,evento.eve_observaciones, evento.tipo_evento_id, tipo_evento.tipo_evento_id,tipo_evento.tipo_evento_descripcion, visitante.vis_id, visitante.vis_nombres, visitante.vis_apellidos,visitante.vis_identificacion,visitante.tipo_iden, tipo_identificacion.tipo_iden, tipo_identificacion.tipo_iden_descripcion,
        visitante.vis_vis_empresa_representa, visitante.vis_piso, visitante.vis_oficina_aparta, visitante.vis_torre, visitante.vis_motivo_visita,visitante.vis_cant_personas, visitante.vis_autoriza,
        visitante.tipo_vis_id, tipo_visitante.tipo_vis_id, tipo_visitante.tipo_vis_descr,
        visitante.usu_id, usuario.usu_id, usuario.usu_usuario,usuario.usu_mail,
        mensajeria_entrega.men_id as menid, mensajeria_entrega.men_nombre_recibe as menrecibe, 
        mensajeria_entrega.men_firma as menfirma, mensajeria_entrega.tipo_iden as miden, mensajeria_entrega.men_documento_recibe as mendoc, mensajeria_entrega.vis_id as menvisid,
        td.tipo_iden, td.tipo_iden_descripcion
        
        FROM evento INNER JOIN tipo_evento ON tipo_evento.tipo_evento_id = evento.tipo_evento_id 
        LEFT OUTER JOIN evento_visitante ON evento_visitante.eve_id = evento.eve_id 
        INNER JOIN visitante ON evento_visitante.vis_id = visitante.vis_id
        INNER JOIN tipo_identificacion ON visitante.tipo_iden = tipo_identificacion.tipo_iden
        INNER JOIN tipo_visitante ON visitante.tipo_vis_id = tipo_visitante.tipo_vis_id
        INNER JOIN usuario ON visitante.usu_id=usuario.usu_id 
        LEFT OUTER JOIN mensajeria_entrega ON visitante.vis_id= mensajeria_entrega.vis_id
        LEFT OUTER JOIN tipo_identificacion td ON td.tipo_iden = mensajeria_entrega.tipo_iden ";
        $query .= ($usuario > 0) ? " WHERE usuario.usu_id='$usuario' " : "";
       //echo $query;
        $statement  = Connection::conecction()->prepare($query);
         $statement->execute();
         $result=$statement->fetchAll(PDO::FETCH_ASSOC);         
         return $result;
    }

    static public function getSalidaDoc($documento){   

    }

}
?>