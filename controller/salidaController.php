<?php

class ControllerSalida{
    private $_method;
    private $_complement;
    private $_data;
    private $ruta;
    
    function __construct($method,$complement,$data)
	{
        //print_r($complement);
        $this->_method = $method;
        $this->_complement = ($complement==null) || ($complement=='/') ? 0: $complement;
        $this->_data = $data !=0 ? $data : "";
      
    }

    public function index(){
        switch ($this->_method) {
            case 'GET':
                switch (true) {
                    case  $this->_complement==0:                       
                        $visita = ModelVisita::getVisitaByUser(0);
                        $json = $visita;                       
                        echo json_encode($json,true);
                        return;
                    case $this->_complement != 0:    
                        $c1 =explode("/", $this->_complement);                                   
                        if ($c1[0]=='doc'){                            
                            $visita = ModelVisita::getVisitaDoc($c1[1]);
                        }
                        else{ 
                            
                            $visita = ModelVisita::getVisitaByUser(0);
                        }
                        $json = $visita; 
                        echo json_encode($json,true);
                        return;
                   
                }   
            case 'POST':               
                $salida = ModelVisita::postSalida($this->_data);
                $json = array(
                    "response:"=>$salida
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