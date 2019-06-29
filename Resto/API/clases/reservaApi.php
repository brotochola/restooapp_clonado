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

        if ($ArrayDeParametros['fecha'] == "HOY") {
            $unaReserva->fecha = date("Y-m-d H:i:s");  
        } else {
            $unaReserva->fecha = $ArrayDeParametros['fecha'];
        }
        
        $unaReserva->fecha_alta = date("Y-m-d H:i:s");          
        $respuesta = $unaReserva->Insertar();

        try{
            $objDelaRespuesta->reserva = reserva::TraerUno($respuesta);       
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
   
    public function metreAsignaMesaAReserva($request, $response, $args){
        $newResponse = $response;

        $ArrayDeParametros = $request->getParsedBody();
        
     

        $id_reserva = $ArrayDeParametros["id_reserva"];
        $reserva = reserva::TraerUno($id_reserva)[0];

        $comensales = $reserva->comensales;
        $id_cliente = $reserva->id_cliente;
        
      
      


        $mesasLibres=reserva::TraerIDsMesasLibresConXComensales($comensales);
    

        $cantReservas=reserva::TraerCantidadDeReservasPara1HrConXComensales($comensales);
      
        $arrCortado=array_splice($mesasLibres,-$cantReservas[0]->cantidad);

        if(count($arrCortado)==0){
            //NO HAY MESAS DISPONIBLES
            $rta=new stdClass();
            $rta->mensaje="No hay mesas disponibles. O están ocupadas, o tienen reservas dentro de la próxima hora";
            return $response->withJson($rta, 200);  

        }


        $id_mesa_random=$arrCortado[array_rand($arrCortado)]->id_mesa;
       

        //asignar cliente vista
        //cambiar mesa de estado
        $vHora = new DateTime();
        $laHora = date_format($vHora, "Y/m/d H:i:s");

        //aca hay q traer un mozo random..              
        $todosLosEmpleados=empleado::TraerTodoLosEmpleados();
       
        $mozos=[];
        for($i=0;$i<count($todosLosEmpleados);$i++){
            $em=$todosLosEmpleados[$i];
          
            if($em["id_rol"]==2){
                //mozo
                array_push($mozos,$em);
            }
        }
        $mozoRandom=$mozos[array_rand($mozos)]["id_empleado"];

        

        $id_cliente_visita = mesa::CargarClienteVisita($id_mesa_random, $id_cliente, $laHora, $comensales, $mozoRandom);

        mesa::ModificarEstadoDeLaMesa($id_mesa_random, 1);    

        reserva::Confirmar($id_reserva);

            
        return $response->withJson(reserva::TraerTodosDeHoy(), 200);  




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