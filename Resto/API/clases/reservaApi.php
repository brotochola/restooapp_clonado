<?php

require_once 'AccesoDatos.php';
require_once 'reserva.php';

class reservaApi extends reserva
{   
    public function CargarReserva($request,$response,$args)
    {         
        
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->itsOk = false;   

        $unaReserva = new reserva();
        $vHora = new DateTime();  

        $ArrayDeParametros = $request->getParsedBody();       
                
        $unaReserva->id_cliente = $ArrayDeParametros['id_cliente'];
        $unaReserva->id_mesa = $ArrayDeParametros['id_mesa'];
        $unaReserva->comensales = $ArrayDeParametros['comensales'];
        $unaReserva->fecha = $ArrayDeParametros['fecha'];
        $unaReserva->fecha_alta = date_format($vHora,"Y/m/d H:i:s");          
        $respuesta = $unaReserva->Insertar();

        try{
            
            $objDelaRespuesta->reserva = reserva::TraerUno($respuesta[0]);       
            $objDelaRespuesta->itsOk = true;

        }
        catch(Exception $e){

            $objDelaRespuesta->respuesta = $e->message;
        }
        return $response->withJson($objDelaRespuesta, 200);  
    }

    public function ConfirmarReserva($request, $response, $args) 
    {
        $vId = $args['id']; 

        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->itsOk = false;    

        try{
            $objDelaRespuesta->respuesta = reserva::Confirmar($vId); 
            $objDelaRespuesta->reserva = reserva::TraerUno($vId);       
            $objDelaRespuesta->itsOk = true;

        }
        catch(Exception $e){

            $objDelaRespuesta->respuesta = $e->message;
        }
        return $response->withJson($objDelaRespuesta, 200);  
    }

    public function TraerReservas($request, $response, $args) 
    {
        $reservas = reserva::TraerTodos();        
        $newResponse = $response->withJson($reservas, 200);  
        return $newResponse;
    }    
    public function TraerReservasDeHoy($request, $response, $args) 
    {
        $reservas = reserva::TraerTodosDeHoy();        
        $newResponse = $response->withJson($reservas, 200);  
        return $newResponse;
    }    
   
    // public function BorrarCliente($request, $response, $args) 
    // {
    //     $vCliente = new cliente();
    //     $vId = $args['id'];        
    //     $var = cliente::TraerUno($vId);
        
    //     if($var != null){
               
    //         $vCliente = $var[0];       
            
    //         $cantidadDeBorrados = $vCliente->BorrarUno(); 

    //         $objDelaRespuesta= new stdclass();
    //         $objDelaRespuesta->cantidad=$cantidadDeBorrados;

    //         if($cantidadDeBorrados == 1)$objDelaRespuesta->resultado="Se borró un elemento!!!";
            
    //         elseif($cantidadDeBorrados > 1) $objDelaRespuesta->resultado="Se borró más de un elemento!!!";
            
    //         elseif($cantidadDeBorrados < 1) $objDelaRespuesta->resultado="No se borró ningún elemento!!!";
            
    //         $newResponse = $response->withJson($objDelaRespuesta, 200);  
    //         return $newResponse; 
    //     }
    //     else{

    //         return "No existe ningún elemento con ese código";
    //     }
    // }
}
?>