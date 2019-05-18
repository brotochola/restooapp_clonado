<?php

require_once 'AccesoDatos.php';
require_once 'captcha.php';


class captchaApi extends captcha
{ 
       
	    public function TraerCaptchas($request, $response, $args) {   
        
            $objDelaRespuesta = new stdclass();
            $var = captcha::TraerTodos();

            $objDelaRespuesta->captchas = $var;  
            $newResponse = $response->withJson($objDelaRespuesta, 200);        
            return $newResponse; 
        }



        public function TraerRespuestas($request, $response, $args) {   
        
            $objDelaRespuesta = new stdclass();  
            $objDelaRespuesta->itsOk = false;              
            $vector = $request->getParams('suma','respuesta');
    
            $vSuma = $vector['suma'];             
            $vRespuesta = $vector['respuesta'];             
            $var = captcha::TraerUna($vSuma);            

            if ($vRespuesta == $var[0]['respuesta'])
            {
                $objDelaRespuesta->itsOk = true;              

            }
 
            $newResponse = $response->withJson($objDelaRespuesta, 200);        
            return $newResponse; 
        }

}

?>
