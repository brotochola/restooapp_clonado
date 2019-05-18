<?php

require_once "AutentificadorJWT.php";

 $checkToken = function($request, $response, $next) {
      	$tk= $request->getHeader('token')[0];
      	try{
			$payload=AutentificadorJWT::ObtenerData($tk);
			
			if(isset($payload)){
				 $response = $next($request, $response);
			}
			
		}catch(exception $e){
			$response->getBody()->write("token invalido");
		}
		return $response;
}; //func checktoken



 $esAdmin = function($request, $response, $next) {
      
		try{
				$tk= $request->getHeader('token')[0];
			$payload=AutentificadorJWT::ObtenerData($tk);
			if(isset($payload)){
				if($payload->rol == "admin"){
					 $response = $next($request, $response);
					}	else{
						$response->getBody()->write("token valido pero no sos admin");

				}
			}
			
		}catch(exception $e){
			$response->getBody()->write("token invalido");
		}
		return $response;
}; //func checktoken
