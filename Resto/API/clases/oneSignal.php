<?php

 class oneSignal{

    public static function guardarEnDBIDPush($id_usuario, $id_push){

    }

    public static function mandarPushARolDeUsuario($id_rol){

    }

	public static function mandarPushAUsuario($id_usuario, $texto){
	//	$url=htmlentities($_REQUEST['url']) ;
		//$img=htmlentities($_REQUEST['img']) ;
	//	$msg=htmlentities($_REQUEST['msg']) ;
		$icon="";


		$content = array(
			"en" => $texto
			);
		
		$fields = array(
			'app_id' => "549189c2-0a0f-4ee6-8053-e5063d08f206",
			'included_segments' => array('All'),
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