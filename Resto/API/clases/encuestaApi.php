<?php

require_once 'AccesoDatos.php';
require_once 'encuesta.php';

class encuestaApi extends encuesta
{ 
       
    public function CargarEncuesta($request, $response,$args)
    {
        $enc = new encuesta();
        $vector = $request->getParsedBody();
        $enc->id_comanda = $vector['id_comanda'];
        $enc->nota_restaurante = $vector['nota_restaurante'];
        $enc->nota_mesa = $vector['nota_mesa'];
        $enc->nota_mozo = $vector['nota_mozo'];
        $enc->nota_cocinero = $vector['nota_cocinero'];  
        $enc->comentario = $vector['comentario'];      
                    
        return $enc->Insertar();         
    }

    public function TraerEncuestas($request, $response, $args) 
    {
        $Empleados = encuesta::TraerTodas();        
        $newResponse = $response->withJson($Empleados, 200);  
        return $newResponse;
    }
        
}

?>