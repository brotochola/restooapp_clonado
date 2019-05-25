<?php

require_once 'AccesoDatos.php';
require_once 'mesa.php';

class mesaApi extends mesa
{   


        //=============AGREGADOS APP RESTO2

    public function HabilitarMesa($request,$response,$args)
    {    
        $miMesa = new mesa();

        $ArrayDeParametros = $request->getParsedBody(); 
        
        $vHora = new DateTime(); 
        $laHora = date_format($vHora,"Y/m/d H:i:s"); 

        $vIdMesa = $ArrayDeParametros['id_mesa'];
        $vIdCliente = $ArrayDeParametros['id_cliente'];
        $vComensales = $ArrayDeParametros['comensales'];
        

        mesa::HabilitarLaMesa($vIdMesa, $vIdCliente, $laHora, $vComensales);
        mesa::ModificarEstadoDeLaMesa($vIdMesa, 2);
        
        $respuesta = mesa::TraerLaMesa($vIdMesa);
        
        return $response->withJson($respuesta, 200);            
        
    }

    public function TraerMesas($request, $response, $args) 
    {   
        $Mesas = mesa::TraerTodas();        
        $newResponse = $response->withJson($Mesas, 200);  
        return $newResponse;
    }  


    
    public function TraerUnaMesa($request, $response, $args) {

        $respuestaArray = array();

        $vId = $args['id'];        
        $mesa = mesa::TraerLaMesa($vId);
        $vIdCliente = mesa::TraerClienteVisita($vId);
        $cliente = cliente::TraerUno($vIdCliente[0]['id_cliente']);
        $pedido = pedido::TraerIdPedidoPorCliente($vIdCliente[0]['id_cliente']);
        $pedidoCompleto = pedidoApi::TraerMiPedido($pedido[0]['id']);

        array_push($respuestaArray, $mesa);
        array_push($respuestaArray, $cliente);
        array_push($respuestaArray, $pedidoCompleto);

        $newResponse = $response->withJson($respuestaArray, 200);
        return $newResponse;
    }


    //=============FIN AGREGADOS APP RESTO2
        

    public function CargarMesa($request,$response,$args)
    {    
        $miMesa = new mesa();
        $ArrayDeParametros = $request->getParsedBody();                     
        $miMesa->id_mesa = $ArrayDeParametros['id_mesa'];
        $miMesa->id_sector = $ArrayDeParametros['id_sector'];
        $miMesa->id_estado_mesa = $ArrayDeParametros['id_estado_mesa']; 
        
        try
        {
            $var = mesa::TraerUno($miMesa->id_mesa);             
        }    
        catch(Exception $e)
        {
            return $e->getMessage();
        }        
        if($var == null)
        {
            return $miMesa->Insertar();
        }
        else
        {
            return $response->withJson(false, 200);            
        } 
    }
    
    public function TraerMesa($request, $response, $args) 
    {   
        $vector  = $request->getParams('id_mesa');       
        $vId = $vector['id_mesa'];         
        
        $laMesa = mesa::TraerUno($vId);
        $newResponse = $response->withJson($laMesa, 200);  
        return $newResponse;
    }

    // public function TraerMesas($request, $response, $args) 
    // {   
    //     $Empleados = mesa::TraerTodos();        
    //     $newResponse = $response->withJson($Empleados, 200);  
    //     return $newResponse;
    // }  

    public function ModificarEstadoMesa($request, $response,$args)
    {
        $vMesa = new mesa();
        $vector  = $request->getParams('id_estado_mesa','id_mesa');      
        $vMesa->id_mesa = $vector['id_mesa']; 
        $var = mesa::TraerUno($vMesa->id_mesa);
                
        if($var != null)
        {      
            $vMesa = $var[0];
            $vMesa->id_estado_mesa = $vector['id_estado_mesa'];    
            $resultado =$vMesa->Modificar();
            $responseObj= new stdclass();
            $responseObj->resultado=$resultado;
            $responseObj->tarea="modificar";
            return $response->withJson($responseObj, 200);	
        }
    }

    public function ModificarMesa($request, $response,$args)
    {
        $vMesa = new mesa();
        $responseObj= new stdclass();
        $responseObj->itsOk = False;

        $vector  = $request->getParams('id_estado_mesa','id_mesa');
        $vMesa->id_mesa = $vector['id_mesa'];         
        $var = mesa::TraerUno($vMesa->id_mesa);            
        if($var != null){
                
            $vMesa = $var[0];
            $vMesa->id_estado_mesa = $vector['id_estado_mesa'];                     
            if($vMesa->id_estado_mesa == 4 && $rol != 1)
            {
                $responseObj->respuesta="Para cerrar una mesa hay que se administrador";		
                $nueva=$response->withJson($responseObj, 401); 
                return $nueva;
            }
            else
            {                                
                $resultado =$vMesa->Modificar();
                $responseObj= new stdclass();
                $responseObj->resultado=$resultado;                
                return $response->withJson($responseObj, 200);
            }
        }  	
    }
 
    public function BorraMesa($request, $response, $args) 
    {
        $vMesa = new mesa();
        $vId = $args['id_mesa'];
        $var = mesa::TraerUno($vId);
        
        if($var != null)
        {     
            $vMesa = $var[0];                  
            $cantidadDeBorrados=$vMesa->Borrar(); 
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->cantidad=$cantidadDeBorrados;

            if($cantidadDeBorrados == 1)$objDelaRespuesta->resultado="Se borró un elemento!!!";
            
            elseif($cantidadDeBorrados > 1) $objDelaRespuesta->resultado="Se borró más de un elemento!!!";
            
            elseif($cantidadDeBorrados < 1) $objDelaRespuesta->resultado="No se borró ningún elemento!!!";
            
            $newResponse = $response->withJson($objDelaRespuesta, 200);  
            return $newResponse; 
        }
        else
        {
            return "No existe ninguna mesa con ese código";
        }
    }
}

?>
