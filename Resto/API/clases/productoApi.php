<?php

require_once 'AccesoDatos.php';
require_once 'producto.php';
require_once 'pedido.php';

class productoApi extends producto
{   
    
    public function CargarProducto($request,$response,$args)
    {  
        $miProducto = new producto();
        $ArrayDeParametros = $request->getParsedBody(); 

        $miProducto->nombre_producto = $ArrayDeParametros['nombre_producto'];
        $miProducto->descripcion = $ArrayDeParametros['descripcion']; 
        $miProducto->id_cocina = $ArrayDeParametros['id_cocina']; 
        $miProducto->precio = $ArrayDeParametros['precio']; 
        //$miProducto->imagen = $ArrayDeParametros['imagen']; 

   
        $var = producto::TraerUno($miProducto->nombre_producto);             
        
        if($var == null)
        {               
            return $miProducto->Insertar();
        }
        else
        {
            return $response->withJson(false, 200);            
        } 
    }
    
    public function TraerProductos($request, $response, $args) 
    {
        $Productos=producto::TraerTodos();        
        return $response->withJson($Productos, 200);         
    }
    
    public function TraerUnProducto($request, $response, $args) 
    {
        $vector  = $request->getParams('id_producto');       
        $vId = $vector['id_producto'];         
        $elProducto = producto::TraerUno($vId);
        return $response->withJson($elProducto, 200);  
    }

    public function ModificarProducto($request, $response, $args)
    {
        $vProducto = new producto();

        $vector  = $request->getParams('id_producto','nombre_producto','descripcion','id_cocina','precio');
        
        $vProducto->id_producto = $vector['id_producto'];
        $vProducto->nombre_producto = $vector['nombre_producto'];
        $vProducto->descripcion = $vector['descripcion'];
        $vProducto->id_cocina = $vector['id_cocina'];
        $vProducto->precio = $vector['precio'];

    	$resultado =$vProducto->Modificar();
	    $responseObj= new stdclass();
	    $responseObj->resultado=$resultado;
        $responseObj->tarea="modificar";
	    return $response->withJson($responseObj, 200);	
    }
   
    public function BorrarProducto($request, $response, $args) 
    {    
        $vProducto = new producto();
        $objDelaRespuesta= new stdclass();
        $vector  = $request->getParams('id_producto');
        $vId = $vector['id_producto'];

        $var = producto::TraerUno($vId);

        $pedidos = pedido::TraerTodosLosPedidos();

        for ($x = 0; $x <= count($pedidos)-1; $x++) {
            $aux = $pedidos[$x]["id_producto"];
            if($aux == $vId){
                $objDelaRespuesta->resultado = "No se puede eliminar porque existe en comanda";                    
                return $response->withJson($objDelaRespuesta, 200);                  
            }
        }
        
        if($var != null)
        {               
            $vProducto = $var[0];       
           
            $cantidadDeBorrados=$vProducto->BorrarUno(); 

            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->cantidad=$cantidadDeBorrados;

            if($cantidadDeBorrados == 1)$objDelaRespuesta->resultado="Se borró un elemento!!!";
            
            elseif($cantidadDeBorrados > 1) $objDelaRespuesta->resultado="Se borró más de un elemento!!!";
            
            elseif($cantidadDeBorrados < 1) $objDelaRespuesta->resultado="No se borró ningún elemento!!!";
            
            return $response->withJson($objDelaRespuesta, 200);  
            
        }
        else
        {
            return "No existe ningún producto con ese código de identificación";
        }
    }
}

?>
