<?php

class ControllerVehiculo{
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
                        $visita = ModelVehiculo::getVehiculos(0);
                        $json = $visita;                       
                        echo json_encode($json,true);
                        return;
                    case $this->_complement != 0:    
                        $c1 =explode("/", $this->_complement);
                        if (($c1[0]=='placa') && ($c1[1] !="")){
                            $visita = ModelVehiculo::getVehiculosPlaca($c1[1]);
                           
                        }else if (($c1[0]=="visitante") && ($c1[1] !="")){
                            $visita = ModelVehiculo::getVehiculosVisitante($c1[1]);
                           
                        } else if (($c1[0]=='usuario') && ($c1[1] !="")){
                            $visita = ModelVehiculo::getVehiculosUsuario($c1[1]);
                           
                        } else $visita = ModelVehiculo::getVehiculos(0);
                       
                        $json = $visita; 
                        echo json_encode($json,true);
                        return;                   
                }   
            case 'POST':               
                $vehiculo = ModelVehiculo::postVehiculo($this->_data);
                $json = array(
                    "response:"=>$vehiculo
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