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
        

        $id_cliente_visita = mesa::CargarClienteVisita($vIdMesa, $vIdCliente, $laHora, $vComensales);

        mesa::ModificarEstadoDeLaMesa($vIdMesa, 2);
        
        $respuesta = mesa::TraerLaMesa($vIdMesa);

        //el dato ya está en $id_cliente_visita
        //select* from clientes_visitar where id_cliente=X order by fecha limit 1
        
        return $response->withJson($respuesta, 200);            
        
    }

    public function TraerMesas($request, $response, $args) 
    {   
        $Mesas = mesa::TraerTodas();        
        $newResponse = $response->withJson($Mesas, 200);  
        return $newResponse;
    }  


    public static function estadoAdmin($request, $response) {
        $rta=new stdClass();
        $rta->mesas = mesa::TraerTodas();    
         
        $newResponse = $response->withJson($rta, 200);  
        return $newResponse;
    }


    public static function estadoMozo($request, $response) {
        $rta=new stdClass();
        $rta->mesas = mesa::TraerTodas();    
         
        $newResponse = $response->withJson($rta, 200);  
        return $newResponse;
    }
    
    
    public function TraerUnaMesa($request, $response, $args) {

        $respuestaArray = new stdClass();

        $vId = $args['id'];        
        $mesa = mesa::TraerLaMesa($vId)[0];
        
        $cliente_visita = mesa::TraerClienteVisita($vId);
        $id_cliente_visita= $cliente_visita[0]["id_cliente_visita"];
        $id_cliente=$cliente_visita[0]["id_cliente"];

        $cliente = cliente::TraerUno($id_cliente);
        $pedidos = pedido::TraerIdPedidoPorIdClienteVisita($id_cliente_visita);
       

        $respuestaArray=json_decode(json_encode( $mesa));
        $respuestaArray->cliente=$cliente[0];
        $respuestaArray->pedidos=$pedidos;
        
        for($i=0;$i<count($pedidos);$i++){
            $respuestaArray->pedidos[$i]["productos"]=[];
            $pedido=  pedidoApi::TraerMiPedido($pedidos[$i]['id']); //con productos
            array_push($respuestaArray->pedidos[$i]["productos"],$pedido);
        }
      
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
