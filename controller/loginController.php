<?php

class ControllerLogin{
    private $_method; 
    private $_data;

    function __construct($method,$data)
	{
        $this->_method = $method;
        $this->_data = $data !=0 ? $data : "";       
        
    }
    public function index(){                    
        switch ($this->_method) {           
            case 'POST':                
                $credencials = ModelUsers::login($this->_data); 
                $result=[];
                if (!empty($credencials)){ 
                    $result["credentials"] = $credencials;
                    $result["mensaje"] = "OK";
                  }else{                    
                    $result["credential"] = null;
                    $result["mensaje"] = "ERROR EN CREDENCIALES..ok";
                    $header = "HTTP/1.1 400 FAIL ";
                    }       
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
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