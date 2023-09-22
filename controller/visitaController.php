<?php

class ControllerVisita{
    private $_method;
    private $_complement;
    private $_data;
    private $ruta;
    private $c1;
    
    function __construct($method,$complement,$data)
	{
        
        $this->_method = $method;
        $this->_complement = ($complement==null) || ($complement=='/') ? 0: $complement;
        $this->_data = $data !=0 ? $data : "";
     
    }

    public function index(){
        switch ($this->_method) {
            case 'GET':
                switch (true) {                                    
                    case $this->_complement != 0:                        
                        $this->c1 =explode("/", $this->_complement);                       
                        if ($this->c1[0] === "doc"){                            
                            $visita = ModelVisita::getVisitaDoc($this->c1[1]);
                        }else if($this->c1[0]=='use'){
                            $visita = ModelVisita::getVisitaByUser($this->c1[1]);
                        }else if($this->c1[0]=='all'){
                            $visita = ModelVisita::getVisitaByUser(0);
                        }else{                             
                            $visita =array(
                                "ruta:"=>"not found --<v"
                            );
                        }
                        //var_dump($visita);
                        $result=[];
                        if (!empty($visita)){ 
                            $result["visita"] = $visita;
                            $result["mensaje"] = "OK";
                          }else{                    
                            $result["visita"] = null;
                            $result["mensaje"] = "ERROR EN USUARIO..ok";
                            $header = "HTTP/1.1 400 FAIL ";
                            }       
                        
                        echo json_encode($result,JSON_UNESCAPED_UNICODE);
                        return;
                    default: 
                        $json = array(
                            "ruta:"=>"not found"
                        );
                        echo json_encode($json,true);
                        return;
                   
                }   
            case 'POST':               
                $visita = ModelVisita::postVisita($this->_data);
                $json = array(
                    "response:"=>$visita
                );
                echo json_encode($json,true);
                return;
            default :
                $json = array(
                    "ruta:"=>"not found"
                );
                echo json_encode($json,true);
                return;
        }        
    }
}

?>