<?php

require_once 'AccesoDatos.php';
require_once 'pedido.php';

class pedidoApi extends pedido
{
// appResto2

public function CargarUnPedido($request, $response,$args){
//esta es la func q se usa en el index.php
        $obj = new stdclass();
        $obj->respuesta="";
        $obj->itsOk = false;

        $vPedido = new pedido();
        $vHora = new DateTime();    
        $vector = $request->getParsedBody(); 

      
                     
        $vPedido->id_mesa = $vector['id_mesa'];
        $vPedido->id_cliente = $vector['id_cliente'];  
        $vPedido->id_cliente_visita = $vector['id_cliente_visita'];            
        
     

        $productos = $vector['productos'];
        $cantidades = $vector['cantidades'];    
       
        if(count($productos) != count($cantidades))
        {
            $obj->respuesta="Las cantidades y productos deben coincidir";
        }else{                  
                try{
                    
                    $var = mesa::TraerUno($vPedido->id_mesa); 

                   
                    if($var != null)
                    {

                        try
                        {    

                            $vPedido->fecha_alta = date_format($vHora,"Y/m/d H:i:s");                            
                            $vPedido->hora_estimada = self::TraerMayorTiempo($productos);
                            $vPedido->id_cliente_visita=$vector['id_cliente_visita'];
                         
                            $vPedido->id = $vPedido->InsertarPedidoPrincipal();
                           
                            $vPedido->CargarPedidosDetalle($productos,$cantidades,$vPedido->id);
                            $obj->respuesta = "Se cargo el pedido: ".$vPedido->id;    
                            $obj->itsOk = true;   
                            
                            $estado_de_la_mesa=2; //2 es esperando pedido
                            mesa::ModificarEstadoDeLaMesa($vPedido->id_mesa,$estado_de_la_mesa);

                        }
                        catch(Exception $e) 
                        {
                            return $e->getMessage();        
                        }
                    }                   
                    else
                    {
                        return $obj->respuesta="La mesa con ese id no existe";

                    }//cierra verifica mesa
            } //cierra try mesa         
            catch(Exception $e) 
            {            
                return $e->getMessage();
            }
        }    
        $newResponse = $response->withJson($obj, 200);        
        return $newResponse;
   
}//Cierra cargar comanda

public function EntregarPedido($request, $response, $args) {

    $vHora = new DateTime(); 
    $vId = $args['id']; 

    $laHora = date_format($vHora,"Y/m/d H:i:s");                             
    pedido::EntregarElPedido($vId, $laHora);
    $var=pedido::TraerPedidosPorId($vId);
 
    $id_mesa= $var[0]["id_mesa"]; 

    mesa::ModificarEstadoDeLaMesa($id_mesa,5);

    
    $respuesta = pedido::TraerPedidosPorId($vId);        
    $newResponse = $response->withJson($respuesta, 200);
    return $newResponse;
}


public function CancelarPedido($request, $response, $args) {

    $vId = $args['id']; 
    pedido::CancelarElPedido($vId);
    $respuesta = pedido::TraerPedidosPorId($vId);        
    $newResponse = $response->withJson($respuesta, 200);
    return $newResponse;
}


public function TraerPedido($request, $response, $args) {
    
    $vId = $args['id'];        
    $Pedidos = self::TraerMiPedido($vId);
    $newResponse = $response->withJson($Pedidos, 200);
    return $newResponse;
}


public static function estadoCocinero($request, $response){
    $tk= $request->getHeader('token')[0];
 

    try{
        $payload=AutentificadorJWT::ObtenerData($tk);
        $rta= $payload;
    }catch(exception $e){
        $rta= -1;
    }
    //$user_id=$payload->id;
    $rol=$payload->id_rol;

    //AGARRO EL ROL DEL EMPLEADO PARA VER Q PRODUCTOS DE CADA PEDIDO LE CORRESPONDEN


    $pedidosPendientes=pedido::TraerTodosLosPedidosPendientes();

    for($i=0;$i<count($pedidosPendientes);$i++){
        //ARRPRODS SON LOS IDS DE PRODUCTOS CON LA CANTIDAD
        $arrProds=pedido::TraerPedidosProductosPorPedido( $pedidosPendientes[$i]["id"]);
        $pedidosPendientes[$i]["productos"]=[];
        

        for($j=0;$j<count( $arrProds);$j++){          
            //PROD ES EL PRODUCTO DE LA TABLA PRODUCTOS 
            $prod=producto::TraerUno($arrProds[$j]["id_producto"])[0];
            $cant= $arrProds[$j]["cantidad"];
            if($prod->id_cocina==$rol){               
                $arrProds[$j]=$prod;               
                $arrProds[$j]->cantidad=$cant;
                array_push( $pedidosPendientes[$i]["productos"],$arrProds[$j]);

               
            }
        }
        //DESPUES DE PROCSAR LOS PRODUCTOS DE CADA PEDIDO, SE FIJA SI LE QUEDO UNO
        if(count($pedidosPendientes[$i]["productos"])==0){
            array_splice($pedidosPendientes,$i,1);
        }

      
    }
  

   return  $response->getBody()->write(json_encode($pedidosPendientes));

}

public static function TraerMiPedido($pId) {

  //  $elPedido = pedido::TraerPedidosPorId($pId);
   
    $idsproductos = pedido::TraerPedidosProductosPorPedido($pId);

   
    $elProducto = new producto();

    $arrProductos = array();



        for ($x = 0; $x <= count($idsproductos)-1; $x++) 
        {

            $elProducto = producto::TraerUno($idsproductos[$x]["id_producto"]);
            if(count($elProducto)>0){
                $elProducto=$elProducto[0];
                $elProducto->cantidad=$idsproductos[$x]["cantidad"];
                //return $elProducto;
                 array_push($arrProductos,$elProducto );
            }
 
        }


      
  


    return $arrProductos;

}

public static function TraerMayorTiempo($Pedidos){

    $tiempo = 0;
    $minutosAgregar = null;
      
    foreach($Pedidos as $mydata)
    {
        $resultado = producto::TraerTiempoPorProducto($mydata);

        if($tiempo <= $resultado){
         $tiempo = $resultado;
        }       
    }

    $horaLocal = new DateTime();
    $minutosAgregar = '+'.$tiempo[0]['minutos_preparacion'].' minutes';  
    $horaLocal->modify($minutosAgregar); 
    $horaDevuleta = date_format($horaLocal,"Y/m/d H:i:s");

    return $horaDevuleta;
    
}


// fin appResto2


    public function CargarPedido($request, $response,$args)
    {
        $vPedido = new pedido();
        $vector = $request->getParsedBody();

        $vPedido->id_comanda = $vector['id_comanda'];
        $vPedido->id_producto = $vector['id_producto'];
        $vPedido->estado_pedido = "1";

        if (isset($_POST['cantidad_producto']) && !empty($_POST['cantidad_producto']))
        {
            $vPedido->cantidad_producto = $vector['cantidad_producto'];
        }else{
            $vPedido->cantidad_producto = 100;
        }
        return $vPedido->Insertar();
    }

    public function TraerPendientes($request, $response, $args) 
    {
        $Pedidos = pedido::TraerTodosLosPedidosPendientes();
        $newResponse = $response->withJson($Pedidos, 200);
        return $newResponse;
    }

    public function TraerPedidos($request, $response, $args) 
    {
        $Pedidos = pedido::TraerTodosLosPedidos();
        $newResponse = $response->withJson($Pedidos, 200);
        return $newResponse;
    }

    public function TraerTiempoFaltante($request, $response, $args) 
    {
        $vector = $request->getParams('id_comanda');
        $pPedido = $vector['id_comanda'];

        $Pedidos = pedido::TraerTiempoPedido($pPedido);

        if( 1 > (sizeof($Pedidos)))
        {
            $tiempo = -1;
            $resp["tiempoFaltante"] = $tiempo;
            return $response->withJson($resp);
        }

        $varHora = $Pedidos[0]['hora_estimada'];
        foreach($Pedidos as $mydata)
        {
            if($mydata['hora_estimada'] > $varHora){
                $varHora = $mydata['hora_estimada'];
            }

        }
        $hora = new DateTime('now',new DateTimeZone('America/Argentina/Buenos_Aires'));
        $horaAux = $hora->format('Y-m-d H:i:s');
        $horaActual = strtotime($horaAux);
        $horaComanda = strtotime($varHora);
        $faltante = $horaComanda - $horaActual;
        $tiempo = date("i:s",$faltante);
        $resp["tiempoFaltante"] = $tiempo;
        return $response->withJson($resp);
    }
/*
    public function AgregarPedidoAComanda($request, $response, $args) 
    {
	$objDelaRespuesta= new stdclass();
        $pPedido = new pedido();
        $existe = false;
        $vector = $request->getParams('id_comanda,id_producto,cantidad_producto');
        $pPedido->id_comanda = $vector['id_comanda'];
        $pPedido->id_producto = $vector['id_producto'];
        $pPedido->cantidad_producto = $vector['cantidad_producto'];
        $pPedido->estado_pedido = 1;

        $pedidos = pedido::TraerPedidosPorComanda($pPedido->id_comanda);

        for ($x = 0; $x <= count($pedidos)-1; $x++)
        {

            $producto = $pedidos[$x]["id_producto"];

            if($producto == $pPedido->id_producto)
            {
                $existe = true;
                $pPedido->cantidad_producto = $pPedido->cantidad_producto  + $pedidos[$x]["cantidad_producto"];
               
                $cantidadModificados = $pPedido->ModificarPedido();

	    
	    	$objDelaRespuesta->cantidad=$cantidadModificados;

	   	if($cantidadModificados == 1){		
			$objDelaRespuesta->resultado="Se modifico un elemento!!!";
                }
	    	elseif($cantidadModificados > 1){
		       $objDelaRespuesta->resultado="Se modifico más de un elemento!!!";
                }
	    	elseif($cantidadModificados < 1){
 		       $objDelaRespuesta->resultado="No se modifico ningún elemento!!!";
                }
	
	    	$newResponse = $response->withJson($objDelaRespuesta, 200);	    
            }

        }


        if($existe == false)
        {
		$objDelaRespuesta = $pPedido->Insertar();
		$newResponse = $response->withJson($objDelaRespuesta, 200);
        }
       // $response->withJson($pPedido);
       // return $response;

	return $newResponse;

}*//*

	public function ModificaCantidad($request, $response, $args) {

        $unPedido = new pedido();

	$vector = $request->getParams('id_comanda,id_producto,cantidad');

        $cant = $vector['cantidad'];       
        $vComanda = $vector['id_comanda'];
        $vPedido = $vector['id_producto'];

        $var = pedido::TraerUnPedido($vComanda,$vPedido);

        if($var != null)
        {
            $unPedido = $var[0];
            $unPedido->cantidad_producto = $cant;
            $cantidadDeBorrados = $unPedido->ModificarPedido();

            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->cantidad=$cantidadDeBorrados;

            if($cantidadDeBorrados == 1)$objDelaRespuesta->resultado="Se modifico un elemento!!!";

            elseif($cantidadDeBorrados > 1) $objDelaRespuesta->resultado="Se modifico más de un elemento!!!";

            elseif($cantidadDeBorrados < 1) $objDelaRespuesta->resultado="No se modifico ningún elemento!!!";

            // $tarea = "Modifica pedido en comanda: ".$vComanda;
            // $id = logueo::ObtenerId($request, $response, $args);
            // logueo::InsertarTransaccion($id,$tarea);
            $newResponse = $response->withJson($objDelaRespuesta, 200);
            return $newResponse;
        }
        else
        {
            return "El no existe ningún pedido con esos valores";
        }        
    }


*/
/*
    public function TraerPedidosDeComanda($request, $response, $args) 
    {
        $vector = $request->getParams('id_mesa');
        $pMesa = $vector['id_mesa'];

        $vPedido = new pedido();
        $pedidosArray=array();
        $cantidadesArray=array();
        $var = comanda::TraerComandaMesa($pMesa);

//	return $response->withJson($var);	
        if($var != null)
        {
            $com = new comanda();
            $com = $var[0];
            $pedidos = pedido::TraerPedidosPorComandaNombres($com->id_comanda);
        }
        return $response->withJson($pedidos);
    }
*/

    public function TraerPedidosComanda($request, $response, $args) 
    {
        $vector = $request->getParams('id_mesa');
        $pMesa = $vector['id_mesa'];
        $vPedido = new pedido();
        $pedidosArray=array();
        $cantidadesArray=array();

        $var = comanda::TraerComandaMesa($pMesa);
        if($var != null)
        {
            $com = new comanda();
            $com = $var[0];
            $pedidos = pedido::TraerPedidosPorComanda($com->id_comanda);

            $total = 0;

            for ($x = 0; $x <= count($pedidos)-1; $x++) 
            {
                $producto = $pedidos[$x]["id_producto"];
                $cantidad = $pedidos[$x]["cantidad_producto"];
                array_push($pedidosArray,$producto);
                array_push($cantidadesArray,$cantidad);
            }
            $total = $vPedido->TraerPrecios($pedidosArray,$cantidadesArray);
        }        
        return $response->withJson($total);
    }

    public function PedidosPorMozo($request, $response, $args) 
    {
        $vector = $request->getParams('id_mozo');
        $vId = $vector['id_mozo'];
        $Pedidos = pedido::TraerTodosLosPedidosPorIdMozo($vId);
        return $response->withJson($Pedidos, 200);
    }

    public function PedidosDemorados($request, $response, $args) 
    {
        $Pedidos = pedido::TraerPedidosDemorados();
        return $response->withJson($Pedidos, 200);
    }

    public function TraerTodosLosPendientesSector($request, $response, $args) 
    {
        $vector = $request->getParams('id_cocina');
        $vId = $vector['id_cocina'];

        $Pedidos = pedido::TraerTodosLosPedidosPendientesSector($vId);
        $newResponse = $response->withJson($Pedidos, 200);     
        return $newResponse;
    }

    public function TomarUnPedido($request, $response,$args)
    {
        $unPedido = new pedido();
        $vHora = new DateTime();
        $vector = $request->getParsedBody();

        $vector = $request->getParams('minutos_estimados', 'id_comanda', 'id_producto','id_empleado');
      //  $id = logueo::ObtenerId($request, $response, $args);

        $unPedido->id_comanda = $vector['id_comanda'];
        $unPedido->id_producto = $vector['id_producto'];
        $unPedido->id_empleado = $vector['id_empleado'];
        $unPedido->comienzo_preparacion = date_format($vHora,"Y/m/d H:i:s");

        $minutos = $vector['minutos_estimados'];
        $agregar = $minutos." minutes";

        $vHoraEstipulada = $vHora;
        date_add($vHoraEstipulada, date_interval_create_from_date_string($agregar));
        $unPedido->hora_estimada = date_format($vHoraEstipulada,"Y/m/d H:i:s");

        //return var_dump($unPedido);

        $resultado = $unPedido->TomarPedido();

     //   $tarea = "Se toma pedido en comanda: ".$vComanda;
      //  logueo::InsertarTransaccion($id,$tarea);

        $responseObj= new stdclass();
        $responseObj->resultado=$resultado;
        $responseObj->tarea="modificar";
        return $response->withJson($responseObj, 200);     
    }

    // public function FinalizarUnPedido($request, $response,$args)
    // {
    //     $unPedido = new pedido();
    //     $unPedidoAuxiliar = new pedido();

    //     $vHora = new DateTime();
    //     $responseObj= new stdclass();

    //     if ((!isset($_GET['id_comanda']) || empty($_GET['id_comanda'])) || ((!isset($_GET['id_producto'])) || empty($_GET['id_producto'])))
	// 	{

	// 		$obj->respuesta="Favor ingresar datos obligatorios";
	// 		$nueva=$response->withJson($obj, 401);
	// 		return $nueva;

	// 	}
	// 	else{

    //         $vector = $request->getParams('id_comanda', 'id_producto');
    //       //  $id = logueo::ObtenerId($request, $response, $args);
    //         $unPedido->id_comanda = $vector['id_comanda'];
    //         $unPedido->id_producto = $vector['id_producto'];
    //         //$unId =  $id;
    //         $unPedido->hora_listo = date_format($vHora,"Y/m/d H:i:s");

    //         // $var = pedido::TraerPedidoPendiente($unPedido->id_comanda,$unPedido->id_producto);
    //         // $unPedidoAuxiliar = $var[0];

    //         // return var_dump($unPedidoAuxiliar);

    //         $resultado = $unPedido->FinalizarPedido();
    //         $responseObj= new stdclass();
    //         $responseObj->resultado=$resultado;

    //         return $response->withJson($responseObj, 200);

    //         if($var != null)
    //         {
    //             if($unPedidoAuxiliar->id_empleado == $unId)
    //             {
    //                 $resultado = $unPedido->FinalizarPedido();
    //                 $responseObj= new stdclass();
    //                 $responseObj->resultado=$resultado;
    //                 $responseObj->tarea="Finaliza pedido en comanda: ".$unPedido->id_comanda;
    //                 logueo::InsertarTransaccion($id,$responseObj->tarea);
    //             }
    //             else
    //             {
    //                 $responseObj->resultado = False ;
    //                 $responseObj->MensajeError= "Id de empleado no corresponde con responsable del pedido";
    //             }

    //         }
    //         else
    //         {
    //             $responseObj->resultado = False ;
    //             $responseObj->MensajeError= "no existe dicho pedido como pendiente";


    //         }
    //         return $response->withJson($responseObj, 200);
    //     }
    // }

	 

    public function ModificaCantidadPedido($request, $response, $args) {

        $unPedido = new pedido();

        $cant = $args['cantidad'];
        $vector = $request->getParams('id_comanda','id_producto');
        $vComanda = $vector['id_comanda'];
        $vPedido = $vector['id_producto'];
        $var = pedido::TraerUnPedido($vComanda,$vPedido);

        if($var != null)
        {
            $unPedido = $var[0];
            $unPedido->cantidad_producto = $cant;
            $cantidadDeBorrados = $unPedido->ModificarPedido();

            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->cantidad=$cantidadDeBorrados;

            if($cantidadDeBorrados == 1)$objDelaRespuesta->resultado="Se modifico un elemento!!!";

            elseif($cantidadDeBorrados > 1) $objDelaRespuesta->resultado="Se modifico más de un elemento!!!";

            elseif($cantidadDeBorrados < 1) $objDelaRespuesta->resultado="No se modifico ningún elemento!!!";

            // $tarea = "Modifica pedido en comanda: ".$vComanda;
            // $id = logueo::ObtenerId($request, $response, $args);
            // logueo::InsertarTransaccion($id,$tarea);
            $newResponse = $response->withJson($objDelaRespuesta, 200);
            return $newResponse;
        }
        else
        {
            return "El no existe ningún pedido con esos valores";
        }        
    }

    public function BorrarUnPedido($request, $response, $args)
    {
        $unPedido = new pedido();
        $vector = $request->getParams('id_comanda','id_producto');
        $vComanda = $vector['id_comanda'];
        $vPedido = $vector['id_producto'];
        $var = pedido::TraerUnPedido($vComanda,$vPedido);

        if($var != null)
        {
            $cantidadDeBorrados = $unPedido->BorrarPedido($vComanda,$vPedido);
            $auxiliar = $var[0];
            $auxiliar->InsertarBorrado();
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
            return "El no existe ningún pedido con esos valores";
        }
    }


    public static function cocineroInformaPedidoListo($request, $response){
        //AL CAMBIAR EL ESTDO DEL PEDIDO TMB TIENE Q CAMBIARSE EL DE LA MESA.
        //EL TEMA ACA ES QUE CADA TIPO DE EMPLEADO SOLO INTERACTUA CON LA PARTE DEL PEDIDO, LOS PRODUCTOS,
        //Q COINCIDEN CON SU ROL (BARTENDER, COCINERO, CANDYBAR)
        //ENTONCES EL PEDIDO NO ESTARA LISTO EN SU TOTALIDAD HASTA Q TODAS LAS PARTES NO ESTEN LISTAS
        $vector = $request->getParsedBody(); 
       
       $pedido= pedido::cambiarEstadoPedido( $vector["id_pedido"],3);
      // print_r($pedido);die();
       mesa::ModificarEstadoDeLaMesa($pedido[0]->id_mesa,3);
       self::estadoCocinero($request, $response);



    }




}
