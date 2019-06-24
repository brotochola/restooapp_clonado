<?php

 class oneSignal{

    public static function guardarEnDBIDPush($request,$response){

        $id_empleado=$request->getParsedBody()["id_empleado"];
        $player_id=$request->getParsedBody()["player_id"];
        $push_token="";
        if(isset($request->getParsedBody()["push_token"])){
            $push_token=$request->getParsedBody()["push_token"];
        }


        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $sql="INSERT INTO `empleados_onesignal` (`id_empleado`, `player_id`, `push_token`) VALUES ('$id_empleado','$player_id', '$push_token')";
         $consulta =$objetoAccesoDato->RetornarConsulta($sql);   
        $consulta->execute();

        
        //prueba
      //  self::mandarPushAUsuario($id_empleado, "hola");
    //  self::mandarPushARolDeUsuario(4,"hollaaa meseros");
        return $response->withJson( self::idEmpleado2playerId($id_empleado), 200);

    }
    public static function idEmpleado2playerId($id_empleado){
        //CADA VEZ Q SE ABRE LA APP, GUARDA Q ID DE EMPLEADO CORRESPONDE CON ESE DISPOSITIVO
        //Y ACA AGARRO EL ULTIMO ID DE DISPOSITIVO PARA MANDARLE A ESE
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $sql="select player_id from empleados_onesignal where id_empleado='$id_empleado' order by date_created desc limit 1";
        
         $consulta =$objetoAccesoDato->RetornarConsulta($sql);
         $consulta->execute();
         $rta = $consulta->fetchAll(PDO::FETCH_CLASS, "stdClass");
      
         return $rta[0]->player_id;

    }
    public static function mandarPushARolDeUsuario($id_rol, $texto){  
              

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $sql="select empleados.id_empleado from empleados where empleados.id_rol=$id_rol";
         $consulta =$objetoAccesoDato->RetornarConsulta($sql);   
        $consulta->execute();
        $ids_empleados = $consulta->fetchAll(PDO::FETCH_CLASS, "stdClass");
     
        for($i=0;$i<count($ids_empleados);$i++){
           // $player_id=self::idEmpleado2playerId($ids_empleados[$i]->id_empleado);
            self::mandarPushAUsuario($ids_empleados[$i]->id_empleado, $texto);
        }

    }

	public static function mandarPushAUsuario($id_usuario, $texto){
	//	$url=htmlentities($_REQUEST['url']) ;
		//$img=htmlentities($_REQUEST['img']) ;
    //	$msg=htmlentities($_REQUEST['msg']) ;
    
        $player_id=self::idEmpleado2playerId($id_usuario);

		$icon="";
        $player_id="4d0dc654-a722-4dc9-a9c6-471c71c2d2a6";

		$content = array(
			"en" => $texto
			);
		
		$fields = array(
			'app_id' => "549189c2-0a0f-4ee6-8053-e5063d08f206",
            //'included_segments' => array('All'),
            'include_player_ids'=>[$player_id],
    //   'data' => array("url" => $url),
      // 'big_picture' => $img,
         'small_icon' => $icon,
          'big_icon' => $icon,
			'contents' => $content
		);

		$fields = json_encode($fields);
  //  print("\nJSON sent:\n");
   // print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic NDBkYTU1YjktNjQ5Yi00ODZjLWIwNWYtNDFlYzc5NDZkNjUy'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	

}



?>