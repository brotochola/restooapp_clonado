<?php

require_once 'AccesoDatos.php';
require_once 'facturacion.php';


class facturacionApi extends facturacion
{   
    
    public function CargarFacturacion($request,$response,$args)
    {  
        $miFactura = new facturacion();
        $ArrayDeParametros = $request->getParsedBody(); 
        
        $miFactura->id_mesa = $ArrayDeParametros['id_mesa'];
        $miFactura->total_mesa = $ArrayDeParametros['total_mesa'];
        $miFactura->porcentaje_propina = $ArrayDeParametros['porcentaje_propina'];
        $miFactura->id_mozo = $ArrayDeParametros['id_mozo'];
        $miFactura->satisfaccion = $ArrayDeParametros['satisfaccion'];

        $rta = $miFactura->Insertar();
        return $response->withJson($rta, 200);                    
    }
    
    public function TraerFacturaciones($request, $response, $args) 
    {
        $Facturacion=facturacion::TraerTodos();        
        return $response->withJson($Facturacion, 200);         
    }
}

?>
