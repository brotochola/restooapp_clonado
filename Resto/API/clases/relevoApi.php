<?php

require_once 'AccesoDatos.php';
require_once 'relevo.php';

class relevoApi extends relevo
{

    public function CargarRelevo($request, $response, $args)
    {
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->itsOk = false;
        $miRelevo = new relevo();
        $ArrayDeParametros = $request->getParsedBody();

        $miRelevo->id_empleado = $ArrayDeParametros['id_empleado'];
        //$miRelevo->id_sector = $ArrayDeParametros['id_sector'];
        
        $miRelevo->limpieza = $ArrayDeParametros['limpieza'];
        $miRelevo->orden = $ArrayDeParametros['orden'];
        $miRelevo->stock = $ArrayDeParametros['stock'];
        $miRelevo->residuos = $ArrayDeParametros['residuos'];
        $miRelevo->puntualidad = $ArrayDeParametros['puntualidad'];
      
     

        


        if (isset($_POST["foto"]) && !empty($_POST["foto"])) {

            //FOTOS		
            $carpeta = "img/" . $miRelevo->id_empleado . "/" . $miRelevo->id_sector . "/";

            if (!is_dir($carpeta)) mkdir($carpeta);
            $foto_relevo = $carpeta . "-foto_relevo-" . date('Y-m-d--H.i.s') . ".png";
            file_put_contents($foto_relevo, base64_decode($ArrayDeParametros['foto']));
            $miRelevo->foto = $foto_relevo;
        } else {
            //IMAGEN PLACEHOLDER        
            $miRelevo->foto = "img/sinImagen.png";
        }

        try {
          //  return var_dump($miRelevo);
            $objDelaRespuesta->respuesta = $miRelevo->Insertar();
            $objDelaRespuesta->itsOk = true;
        } catch (Exception $e) {
            $objDelaRespuesta->respuesta = $e->getMessage();
            $objDelaRespuesta->itsOk = false;
        }

        return $response->withJson($objDelaRespuesta, 200);
    }

    public function TraerRelevos($request, $response, $args)
    {
        $Relevos = relevo::TraerTodos();
        $newResponse = $response->withJson($Relevos, 200);
        return $newResponse;
    }
}
