<?php

require_once "AutentificadorJWT.php";
require_once "logueo.php";

class AutentificadorMW
{
	public function VerificarAccesoUnico($request, $response, $next) {
		
		$obj = new stdclass();
		$hora = date_format(new DateTime(),"Y/m/d H:i:s");
		
		$arrayConToken = $request->getHeader('token');
		$token = $arrayConToken[0];
		$obj->itsok = true;
	
		try{
			AutentificadorJWT::verificarToken($token);				
			$obj->itsok = true;
		}
		catch(Exception $e){
			
			$obj->excepcion = $e->getMessage();
			$obj->itsok = false;
		}
		if($obj->itsok)
		{								
	
			if($request->isPost()){
				
				$response = $next($request, $response);			
			}
			if($request->isGet()){

				$response = $next($request, $response);			
			}		
			if($request->isDelete() || $request->isPut()){
			
				$payload=AutentificadorJWT::ObtenerData($token);

				if($payload->id_rol !="1"){

					$obj->respuesta="Solo administradores";
					$tarea = "Intento de acceso no Admin";
					logueo::InsertarTransaccion($payload->id_empleado,$tarea);
					$obj->itsok = false;
					$nueva=$response->withJson($obj, 401);  
					return $nueva;
				}
				else if($payload->id_rol =="1"){					

					$response = $next($request, $response);	
				}
			}
		}
		else{
		
			$nueva=$response->withJson($obj, 401);  
			return $nueva;
		} 
		return $response;		   
	}


	public function VerificarLogueo($request, $response, $next) {
		
		$obj = new stdclass();
		$obj->respuesta="";
	
		$vector = $request->getParsedBody();

		if ((!isset($_POST['id_empleado']) || empty($_POST['id_empleado'])) || (!isset($_POST['clave']) || empty($_POST['clave']))) 
		{
			
			$obj->respuesta="No están cargados todos los datos";		
			$nueva=$response->withJson($obj, 401); 
			return $nueva;
		
		}
		else{
			$var = empleado::TraerUnoId($_POST['id_empleado']);
			$obj->respuesta="Id incorrecto";

			if($var == null){

				$obj->respuesta="No existe el empleado con ese id";		
				$nueva=$response->withJson($obj, 401); 
				return $nueva;			

			}
			else{
				$fecha = new DateTime();    
				$tarea = "Logueo Usuario";
				$obj->respuesta="Se validan los datos";
				logueo::InsertarTransaccion($vector['id_empleado'],$tarea);
				$response = $next($request, $response);
			}		
		}
		   return $response;
   }
   

public function VerificarAccesoInformes($request, $response, $next) {

	$obj = new stdclass();
	$obj->respuesta="";
	$hora = date_format(new DateTime(),"Y/m/d H:i:s");
	
	$arrayConToken = $request->getHeader('token');
	$token = $arrayConToken[0];
	$obj->itsok = true;

	try
	{
		AutentificadorJWT::verificarToken($token);
	}
	catch(Exception $e){
		$obj->excepcion = $e->getMessage();
		$obj->itsok = false;
	}
	if($obj->itsok)
	{			
		$payload=AutentificadorJWT::ObtenerData($token);
		if($payload->id_rol=="1")
		{		
			$response = $next($request, $response);	
		}           	
		else
		{
			$obj->itsok = false;
			$obj->respuesta="Solo administradores";
			$tarea = "Intento de acceso no Admin";
			logueo::InsertarTransaccion($payload->id_empleado,$tarea);
			$response = $response->withJson($obj, 401);  
			
		}//cierro no administradores	
			
	}//Cierro token válido
	else
	{			
		$obj->respuesta="Solo usuarios registrados";		
		$response = $response->withJson($obj, 401);  
		
	}	
	return $response;	
}//Cierra verificar acceso

	
}
?>