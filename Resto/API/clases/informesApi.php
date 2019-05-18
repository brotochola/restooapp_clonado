<?php

require_once 'AccesoDatos.php';
require_once 'pedido.php';
require_once 'logueo.php';
require_once 'producto.php';

class informesApi 
{    

    public function InformesLogueos($request, $response, $args) {
        
        $logueos = logueo::TraerTodoLosLogueos();        
        $newResponse = $response->withJson($logueos, 200);  
        return $newResponse;
    }
       
    public function TareasSector($request, $response, $args) {

        $logueos = logueo::TraerCantidadTransacciones();
       
        $cocina = 0;
        $chopera = 0;
        $piso = 0;
        $bar = 0;
        $socios = 0;
        $candybar = 0;      
       
        for ($x = 0; $x <= count($logueos)-1; $x++) {
         
            if(($logueos[$x]["id_rol"]) == 1){
                $socios =  $socios + 1;
            }
            if(($logueos[$x]["id_rol"]) == 2){
                $piso = $piso + 1;
            }
            if(($logueos[$x]["id_rol"]) == 3){
                $bar = $bar + 1;
            }
            if(($logueos[$x]["id_rol"]) == 4){
                $chopera = $chopera + 1;
            }
            if(($logueos[$x]["id_rol"]) == 5){
                $cocina = $cocina + 1;
            }
            if(($logueos[$x]["id_rol"]) == 6){
                $candybar = $candybar + 1;
            }
        
        } 

        $array = ["Cocina " => $cocina, "Piso " =>$piso,"Bar " =>$bar,"Chopera " =>$chopera,"Candy bar "=>$candybar];

        $newResponse = $response->withJson($array, 200);  
        return $newResponse;
       
    }

    public function TransaccionesEmpleado($request, $response, $args) 
    {
        $vector = $request->getParsedBody();
        $id = $vector['id_empleado'];

        $logueos = logueo::TraerTransaccionPorId($id);        
        $newResponse = $response->withJson($logueos, 200);  
        return $newResponse;
    }
    
    public function TransaccionesEmpleadoSector($request, $response, $args) 
    {
        $logueos = logueo::TraerOperaciones();        
        $newResponse = $response->withJson($logueos, 200);  
        return $newResponse;
    }
    
    public function TraerPedidosEliminados($request, $response, $args) 
    {
        $borrados = pedido::TraerEliminados();        
        $newResponse = $response->withJson($borrados, 200);  
        return $newResponse;
    }

    public function MejorNota($request, $response, $args)
    {
        $d = encuesta::TraerTodas();
        $mejor = 0;
        $comanda = "";

        for ($x = 0; $x <= count($d)-1; $x++) {
     
            $total =  $d[$x]["nota_mozo"] + $d[$x]["nota_mesa"] + $d[$x]["nota_restaurante"]+ $d[$x]["nota_cocinero"];
              
            if($x == 0){
                $mejor = $total;
                $comanda = $d[$x]["id_comanda"];
                $mesa = $d[$x]["nota_mesa"];
                $restaurante = $d[$x]["nota_restaurante"];
                $mozo = $d[$x]["nota_mozo"];
                $cocinero = $d[$x]["nota_cocinero"];
                continue;
            }

            if($mejor < $total){
                $mejor = $total;
                $comanda = $d[$x]["id_comanda"];
                $mesa = $d[$x]["nota_mesa"];
                $restaurante = $d[$x]["nota_restaurante"];
                $mozo = $d[$x]["nota_mozo"];
                $cocinero = $d[$x]["nota_cocinero"];
                $comentario = $d[$x]["comentario"];
            }
        }
        $promedio = $mejor / 4;
        $array = ["Comanda: " => $comanda, "Mesa: " =>$mesa,"Mozo: " =>$mozo,"Cocinero: " =>$cocinero,"Restaurante: "=>$restaurante,"Promedio: "=>$promedio,"Comentario: "=> $comentario];

        $newResponse = $response->withJson($array, 200);  
        return $newResponse;
    }

    public function PeorNota($request, $response, $args){

        $d = encuesta::TraerTodas();
        $menor = 0;
        $comanda = "";

        for ($x = 0; $x <= count($d)-1; $x++) {
            // var_dump($logueos[$x]["id_empleado"]);
            $total =  $d[$x]["nota_mozo"] + $d[$x]["nota_mesa"] + $d[$x]["nota_restaurante"]+ $d[$x]["nota_cocinero"];
              
            if($x == 0){
                $menor = $total;
                $comanda = $d[$x]["id_comanda"];
                $mesa = $d[$x]["nota_mesa"];
                $restaurante = $d[$x]["nota_restaurante"];
                $mozo = $d[$x]["nota_mozo"];
                $cocinero = $d[$x]["nota_cocinero"];
                continue;
            }

            if($menor > $total){
                $menor = $total;
                $comanda = $d[$x]["id_comanda"];
                $mesa = $d[$x]["nota_mesa"];
                $restaurante = $d[$x]["nota_restaurante"];
                $mozo = $d[$x]["nota_mozo"];
                $cocinero = $d[$x]["nota_cocinero"];
                $comentario = $d[$x]["comentario"];
            }
        }
        $promedio = $menor / 4;
        $array = ["Comanda: " => $comanda, "Mesa: " =>$mesa,"Mozo: " =>$mozo,"Cocinero: " =>$cocinero,"Restaurante: "=>$restaurante,"Promedio: "=>$promedio,"Comentario: "=> $comentario];

        $newResponse = $response->withJson($array, 200);  
        return $newResponse;
    }


    public function TraerProductosCantidades($request, $response, $args) {
       
        $responseObj= new stdclass();        
        $pedidosX = pedido::TraerPedidosHechos(); 
        $responseObj->losPedidos = array();      
       

        $producto = 0;
        $cantidad = 0;

        $pedidos=array();
        $cantidades = array();
        $resultado = array();
        $miObjeto = array();

        for ($x = 0; $x <= count($pedidosX)-1; $x++) {
           
              $prod = $pedidosX[$x]["id_producto"];                            
              $cant = pedido::TraerCantidadProducto($prod);
                        
              $var = producto::TraerUno($prod);
              $unProducto = new producto();
              $unProducto = $var[0];
              $miObjeto = [($unProducto->nombre_producto)=>(intval($cant[0]['cantidad']))];              
              array_push($pedidos,$miObjeto);
        }     
        $responseObj->losPedidos = $pedidos;        

        $newResponse = $response->withJson($pedidos, 200);  
        return $newResponse;
    }


    public function PedidoMasVendido($request, $response, $args) {
               
        $pedidos = pedido::TraerPedidosHechos();        

        $producto = 0;
        $cantidad = 0;       

        $cant = pedido::TraerCantidadProducto(1);

         for ($x = 0; $x <= count($pedidos)-1; $x++) {
           
              $prod = $pedidos[$x]["id_producto"];                                        
              $cant = pedido::TraerCantidadProducto($prod); 
              $auxCant = $cant[0]['cantidad'];            

              if($x == 0)
              {
                  $producto = $prod;             
                  $cantidad = $cant[0]['cantidad'];             
              }

              if($auxCant > $cantidad)
              {
                  $producto = $prod;
                  $cantidad = $auxCant;                
              }

        }
      
        $var = producto::TraerUno($producto);
        $unProducto = new producto();
        $unProducto = $var[0];

        $resultado =  "El producto más vendido es: ".$unProducto->nombre_producto." con ".$cantidad." unidades vendidas";

        $newResponse = $response->withJson($resultado, 200);  
        return $newResponse;
    }


}



?>