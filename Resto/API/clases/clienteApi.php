<?php

require_once 'AccesoDatos.php';
require_once 'cliente.php';

class clienteApi extends cliente
{   
    public function CargarCliente($request,$response,$args)
    {         
        $miCliente = new cliente();
        $ArrayDeParametros = $request->getParsedBody();                     
        $miCliente->id_cliente = $ArrayDeParametros['id_cliente'];
        $miCliente->nombre_completo = $ArrayDeParametros['nombre_completo'];
        $miCliente->dni = $ArrayDeParametros['dni'];
                
        $var = cliente::TraerUno($miCliente->id_cliente);             
        
        if($var == null)
        {                                  
            return $miCliente->Insertar();
        }
        else
        {
            return $response->withJson(false, 200);            
        }    
    }

    public function TraerUnCliente($request, $response, $args) 
    {
        $id = $args['id'];

		$elcliente = Cliente::TraerUno($id);

		$rta = [];

		$newResponse = $response;

		if ($elcliente) {
			$rta = $elcliente;
		} else {
			$rta["estado"] = "ERROR";
			$rta['mensaje'] = 'No se encontró ese Cliente.';
		}

		return $newResponse->withJson($rta, 200);
    }

    public function TraerUnClientePorMail($request, $response, $args) 
    {
        $email = $args['email'];

		$elcliente = Cliente::email2Cliente($email);

		$rta = [];

		$newResponse = $response;

		if ($elcliente) {
			$rta = $elcliente;
		} else {
			$rta["estado"] = "ERROR";
			$rta['mensaje'] = 'No se encontró ese Cliente.';
		}

		return $newResponse->withJson($rta, 200);
    }

    public function TraerClientes($request, $response, $args) 
    {
        $Clientes = cliente::TraerTodos();        
        $newResponse = $response->withJson($Clientes, 200);  
        return $newResponse;
    }    
   
    public function ModificarCliente($request, $response,$args)
    {           
        $vCliente = new cliente();
        $vector  = $request->getParams('id_cliente', 'nombre_completo');       
        $vCliente->id_cliente = $vector['id_cliente'];
        $vCliente->nombre_completo = $vector['nombre_completo'];       
                    
	   	$resultado = $vCliente->Modificar();
	  	$responseObj= new stdclass();
	    $responseObj->resultado=$resultado;
        $responseObj->tarea="modificar";
	    return $response->withJson($responseObj, 200);	
    }

    public function BorrarCliente($request, $response, $args) 
    {
        $vCliente = new cliente();
        $vId = $args['id'];        
        $var = cliente::TraerUno($vId);
        
        if($var != null){
               
            $vCliente = $var[0];       
            
            $cantidadDeBorrados = $vCliente->BorrarUno(); 

            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->cantidad=$cantidadDeBorrados;

            if($cantidadDeBorrados == 1)$objDelaRespuesta->resultado="Se borró un elemento!!!";
            
            elseif($cantidadDeBorrados > 1) $objDelaRespuesta->resultado="Se borró más de un elemento!!!";
            
            elseif($cantidadDeBorrados < 1) $objDelaRespuesta->resultado="No se borró ningún elemento!!!";
            
            $newResponse = $response->withJson($objDelaRespuesta, 200);  
            return $newResponse; 
        }
        else{

            return "No existe ningún elemento con ese código";
        }
    }

    public function LoginCliente($request,$response,$args)
    {         
        $objDelaRespuesta = new stdclass();  
        $objDelaRespuesta->itsOK = false;  
        $objDelaRespuesta->mensaje = "El cliente no existe";            
        $vector = $request->getParsedBody();
        //print_r($vector);die();
    
        //$vUsuario = $vector['usuario'];  
        $vEmail = $vector['email'];  
        $vDNI = $vector['dni'];

        $var = cliente::email2Cliente($vEmail);
        
        if($var != null)
        {       
            if($vDNI == $var->dni)
            {  
                $objDelaRespuesta->el_cliente = new cliente();
                $objDelaRespuesta->itsOK = true;
                $objDelaRespuesta->el_cliente = $var; 
                $objDelaRespuesta->token = AutentificadorJWT::CrearToken($var);
                $objDelaRespuesta->mensaje = "Login correcto";  
                $newResponse = $response->withJson($objDelaRespuesta, 200);        
                return $newResponse;        
            }
            else
            {
                $objDelaRespuesta->mensaje = "Datos incorrectos";
            }

        }       
        $newResponse = $response->withJson($objDelaRespuesta, 200);        
        return $newResponse;       
    }

    public function LoginAnonimo($request,$response,$args)
    {         
        $objDelaRespuesta = new stdclass();  
        $objDelaRespuesta->itsOK = false;  
        $objDelaRespuesta->mensaje = "El cliente no existe";            
        $vector = $request->getParsedBody();
        //print_r($vector);die();
    
        //$vUsuario = $vector['usuario'];  
        $vId_cliente = $vector['id_cliente'];  
        $vNombre_cliente = $vector['nombre_cliente'];

        $var = cliente::TraerUno($vId_cliente);
        
        if($var != null)
        {       
            if($vNombre_cliente == $var->nombre_cliente)
            {  
                $objDelaRespuesta->el_cliente = new cliente();
                $objDelaRespuesta->itsOK = true;
                $objDelaRespuesta->el_cliente = $var; 
                $objDelaRespuesta->token = AutentificadorJWT::CrearToken($var);
                $objDelaRespuesta->mensaje = "Login correcto";  
                $newResponse = $response->withJson($objDelaRespuesta, 200);        
                return $newResponse;        
            }
            else
            {
                $objDelaRespuesta->mensaje = "Datos incorrectos";
            }

        }       
        $newResponse = $response->withJson($objDelaRespuesta, 200);        
        return $newResponse;       
    }
}
?>