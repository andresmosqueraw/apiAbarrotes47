<?php

$rutasArray = explode("/", $_SERVER['REQUEST_URI']);//Detecta nuestra url
$inputs = array();
//Raw input for requests
$inputs['raw_input'] = @file_get_contents('php://input');
$_POST = json_decode($inputs['raw_input'], true);
if(count(array_filter($rutasArray))<2) { //array_filter quita los indices vacíos
    $json = array(
        "ruta:"=>"not found:)"
    );
    echo json_encode($json,true);
    return;
}else{    
    /**
     * Endpoint correctos
     */       
        $endPoint = (array_filter($rutasArray)[2]);      
        $complement =  (array_key_exists (3,$rutasArray)) ? ($rutasArray)[3] : 0;
        $adicion = (array_key_exists (4,$rutasArray)) ? ($rutasArray)[4] : "";
        if ($adicion != "") $complement .= "/".$adicion;      
        $method= $_SERVER['REQUEST_METHOD']; 
               
    switch ($endPoint){       
        case 'users':
            if (isset($_POST))
                $user = new ControllerUsers($method,$complement,$_POST);
            else{
                $user = new ControllerUsers($method,$complement,0);               
            }
            $user->index();
            break;
        case 'login':
                if (isset($_POST) && $method=='POST'){                                     
                    $user = new ControllerLogin($method,$_POST);                
                    $user->index(); 
                }else{
                    $json = array(
                        "ruta:"=>"not found"
                    );
                    echo json_encode($json,true);
                    return;
                }              
            break;
        case 'visita':            
            if (isset($_POST))            
                $visita = new ControllerVisita($method,$complement,$_POST);
            else
                $visita = new ControllerVisita($method,$complement,0);   
           $visita->index();
            break;
        case 'salida':
            if (isset($_POST))            
                $salida = new ControllerSalida($method,$complement,$_POST);
            else
                $salida = new ControllerSalida($method,$complement,0);   
           $salida->index();
            break;
        case 'vehiculo':            
            if (isset($_POST))            
                $vehiculo = new ControllerVehiculo($method,$complement,$_POST);
            else
                $vehiculo = new ControllerVehiculo($method,$complement,0);   
           $vehiculo->index();
            break;
        default :
            $json = array(
                "ruta:"=>"not found"
            );
            echo json_encode($json,true);
            return;
    }
  


}


