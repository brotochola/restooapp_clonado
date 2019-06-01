<?php




 class General{

	public static function guardarDatosSitio($request, $response){
		try{
			return file_put_contents("datosSitio.json",$request->getParsedBody()["datosSitio"]);	
		}catch(Exception $e){
			print_r($e);
			die();
		}
	}






public static function guardarMailParaNewsletter($request, $response){
	$fp = fopen("mails_para_newsletter.txt","a");//opens file in append mode  
	fwrite($fp,$request->getParsedBody()["mail"]."\n");  
	fclose($fp);  
	//return $a;
}

	public static function guardarJSONOfertasEspeciales($request, $response){
			$obj=json_decode(file_get_contents("dataHome.json"));
		//	var_dump($obj);die();
			$obj->ofertasEspeciales= json_decode($request->getParsedBody()["arr"]);

			for($i=0;$i<count($obj->ofertasEspeciales);$i++){
				$url="img/ofertasEspeciales/".$i.".png";
				$img=base64_decode($obj->ofertasEspeciales[$i]->img, true);
				if($img!=false){
					file_put_contents($url,$img);					
				}
				$obj->ofertasEspeciales[$i]->img=$url;
				
			}
			$response->getBody()->write(file_put_contents("dataHome.json", json_encode($obj))); 
			return $response;


	}

	public static function imagenesHeader($request, $response){
		$imgs=glob("img/fotos_productos/header/*.{jpg,jpeg,png,gif,JPG,JPEG,JPE}", GLOB_BRACE);
	//	var_dump($imgs);die();
		$response->getBody()->write( $imgs[array_rand($imgs)]);
		 return $response; 

	}

	public static function categoriasDestacadas($request, $response){
		
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$home=new stdClass();
		$home->categoriasDestacadas=[];


		//agarro el json de las categorias destacadas
		$jsonCategoriasDestacadas=json_decode(file_get_contents("dataHome.json"));
		


		foreach (json_decode($jsonCategoriasDestacadas->categoriasDestacadas) as $catDestacada){
			array_push($home->categoriasDestacadas, new StdClass());
			$home->categoriasDestacadas[count($home->categoriasDestacadas)-1]->id_categoria=$catDestacada;


			//busco cada id de categoria y le pongo el nombre
			$consulta =$objetoAccesoDato->RetornarConsulta("select nombre from tipos_de_productos where id=$catDestacada");
			$consulta->execute();	
			$rta=$consulta->fetchAll(PDO::FETCH_CLASS, "stdClass");
			$home->categoriasDestacadas[count($home->categoriasDestacadas)-1]->nombre_categoria=$rta[0]->nombre;


			$consulta =$objetoAccesoDato->RetornarConsulta("select productos.*, tipos_de_productos.nombre as categoria, valores_filtros.nombre as marca from productos, tipos_de_productos, filtros, valores_filtros, productos_valores_filtros where valores_filtros.id=productos_valores_filtros.id_valor  and tipo=".$catDestacada."  and productos.destacado=0  and productos.activo=1 and productos_valores_filtros.id_producto=productos.id and productos_valores_filtros.id_filtro=filtros.id and filtros.nombre='marca' and productos.tipo=tipos_de_productos.id order by date_created desc limit 0,4");



			$consulta->execute();			
			$rta=$consulta->fetchAll(PDO::FETCH_CLASS, "stdClass");
			$rta=Productos::descripcionYMeterFotos($rta);
			$home->categoriasDestacadas[count($home->categoriasDestacadas)-1]->productos=$rta;

		}

		$response->getBody()->write(json_encode($home));
		 return $response;
	}



	public static function indexPublico($request, $response){
		//$habilitado=$request->getParsedBody()["habilitado"];
		//$user_id=$request->getParsedBody()["user_id"];

		


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

		$home=new StdClass();

		$home->sliderPrincipal=glob('img/fotos_productos/slider/*.{jpg,jpeg,png,gif,JPG,JPEG,JPE}', GLOB_BRACE); 
		$home->filtros=filtros_valores::devolverFiltrosYValores($request, $response);
		
	

		//agarro el json de las categorias destacadas
		//tmb tiene las ofertas especiales
		$jsonCategoriasDestacadas=json_decode(file_get_contents("dataHome.json"));
		

		$home->ofertasEspeciales=$jsonCategoriasDestacadas->ofertasEspeciales;



		//productos destacados:

		$consulta =$objetoAccesoDato->RetornarConsulta("select productos.*, tipos_de_productos.nombre as categoria, valores_filtros.nombre as marca from productos, tipos_de_productos, filtros, valores_filtros, productos_valores_filtros where valores_filtros.id=productos_valores_filtros.id_valor and productos.activo=1 and productos.destacado=1 and productos_valores_filtros.id_producto=productos.id and productos_valores_filtros.id_filtro=filtros.id and filtros.nombre='marca' and productos.tipo=tipos_de_productos.id order by date_created desc limit 0,4");
		$consulta->execute();			
		$prodsDest=$consulta->fetchAll(PDO::FETCH_CLASS, "stdClass");	
		
		$home->productosDestacados=Productos::descripcionYMeterFotos($prodsDest);

		//marcas
		$home->marcas=glob("img/fotos_productos/marcas/*.{jpg,jpeg,png,gif,JPG,JPEG,JPE}", GLOB_BRACE); 

		//datos sitio
		$home->datosSitio=json_decode(file_get_contents("datosSitio.json"));

		////////////////////// ACA FALTAN LOS ARTICULOS DEL BLOG

		$response->getBody()->write(json_encode($home));
		 return $response;
	}



}



?>