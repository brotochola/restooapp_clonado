<?php

//////////////////////////
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);  
header('Access-Control-Allow-Origin: *'); 
date_default_timezone_set('America/Argentina/Buenos_Aires');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require 'composer/vendor/autoload.php';
require 'clases/AccesoDatos.php';
require 'clases/AutentificadorJWT.php';
require 'clases/middlewares_slim.php';
require 'clases/general.php';




use Firebase\JWT\JWT;


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;



$app = new \Slim\App(["settings" => $config]);




$app->group('/admin', function () { 


  $this->get('/empleados/lista[/]', function(){
      return '[{"habilitado":1,"fecha_nac":"07/04/1984","dni":535356356,"id":1,"nombre_completo":"Daro Darioli","id_rol":1,"fecha_ingreso":"2018-07-14","sueldo":"35000","fecha_egreso":null},{"habilitado":1,"fecha_nac":"07/04/1984","dni":45255425,"id":2,"nombre_completo":"Juan Gritz","id_rol":2,"fecha_ingreso":"2018-07-14","sueldo":"25000","fecha_egreso":null},{"habilitado":1,"fecha_nac":"07/04/1984","dni":42525254,"id":3,"nombre_completo":"Emilio J.","id_rol":2,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":4,"nombre_completo":"Natalia Ramirez","id_rol":3,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":3,"nombre_completo":"Marcos R.","id_rol":4,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":6,"nombre_completo":"Nahuel Caceres","id_rol":3,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":7,"nombre_completo":"Carlos Caceres","id_rol":4,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":8,"nombre_completo":"Juan Moreira","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":9,"nombre_completo":"Juan Olivera","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":10,"nombre_completo":"Juan Olivera","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":11,"nombre_completo":"Lucrecia Martinez","id_rol":6,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"}]';
  });


  $this->get('/empleados/modificar[/]', function(){
      return '[{"habilitado":1,"fecha_nac":"07/04/1984","dni":535356356,"id":1,"nombre_completo":"Daro Darioli 2","id_rol":1,"fecha_ingreso":"2018-07-14","sueldo":"35000","fecha_egreso":null},{"habilitado":1,"fecha_nac":"07/04/1984","dni":45255425,"id":2,"nombre_completo":"Juan Gritz2!","id_rol":2,"fecha_ingreso":"2018-07-14","sueldo":"25000","fecha_egreso":null},{"habilitado":1,"fecha_nac":"07/04/1984","dni":42525254,"id":3,"nombre_completo":"Emilio J.2!","id_rol":2,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":4,"nombre_completo":"Natalia Ramirez2!","id_rol":3,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":3,"nombre_completo":"Marcos R.2!","id_rol":4,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":6,"nombre_completo":"Nahuel Caceres2!","id_rol":3,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":7,"nombre_completo":"Carlos Caceres2!","id_rol":4,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":8,"nombre_completo":"Juan Moreira2!","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":9,"nombre_completo":"Juan Olivera2!","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":10,"nombre_completo":"Juan Olivera2!","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":11,"nombre_completo":"Lucrecia Martinez2!","id_rol":6,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"}]';
  });

  $this->get('/empleados/agregar[/]', function(){
    $varRet='[{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":1,"nombre_completo":"Daro Darioli","id_rol":1,"fecha_ingreso":"2018-07-14","sueldo":"35000","fecha_egreso":null},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":2,"nombre_completo":"Juan Gritz","id_rol":2,"fecha_ingreso":"2018-07-14","sueldo":"25000","fecha_egreso":null},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":3,"nombre_completo":"Emilio J.","id_rol":2,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":4,"nombre_completo":"Natalia Ramirez","id_rol":3,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":5,"nombre_completo":"Marcos R.","id_rol":4,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":6,"nombre_completo":"Nahuel Caceres","id_rol":5,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":7,"nombre_completo":"Carlos Caceres","id_rol":5,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":8,"nombre_completo":"Juan Moreira","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":9,"nombre_completo":"Juan Olivera","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":10,"nombre_completo":"Juan Olivera","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":11,"nombre_completo":"Lucrecia Martinez","id_rol":6,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"}';
    $varRet.=',{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":11,"nombre_completo":"MArcelita Martinez","id_rol":2,"fecha_ingreso":"2018-07-30","sueldo":"99999","fecha_egreso":"0000-00-00"}';
    $varRet.="]";
    return $varRet;
  });

   $this->get('/empleados/borrar[/]', function(){
       $varRet='[{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":1,"nombre_completo":"Daro Darioli","id_rol":1,"fecha_ingreso":"2018-07-14","sueldo":"35000","fecha_egreso":null},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":2,"nombre_completo":"Juan Gritz","id_rol":2,"fecha_ingreso":"2018-07-14","sueldo":"25000","fecha_egreso":null},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":3,"nombre_completo":"Emilio J.","id_rol":2,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":4,"nombre_completo":"Natalia Ramirez","id_rol":3,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":5,"nombre_completo":"Marcos R.","id_rol":4,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":6,"nombre_completo":"Nahuel Caceres","id_rol":5,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":7,"nombre_completo":"Carlos Caceres","id_rol":5,"fecha_ingreso":"2018-07-25","sueldo":"20000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":8,"nombre_completo":"Juan Moreira","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":9,"nombre_completo":"Juan Olivera","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"},{"habilitado":1,"fecha_nac":"07/04/1984","dni":492879285,"id":10,"nombre_completo":"Juan Olivera","id_rol":4,"fecha_ingreso":"2018-07-30","sueldo":"25000","fecha_egreso":"0000-00-00"}]';
       return $varRet;
  });

  $this->get('/login[/]', function(){
      return '{"token":"difgsdiufsdfgsydfgf4w8gf7929gf42f92hf942fh24TDYBTUfyufyunyu6745645TGYgybybtybrty5656","nombre":"Apollo Creed"}';
    }); 
 


  $this->get('/productos/lista[/]', function(){
    //rol 1 bartender
    //rol 2 cervecero
    //rol 3 cocina
    //rol 4 mozo
    //rol 5 admin
    //rol 6 candybar

      return '[{"id":1,"nombre_producto":"risotto","descripcion":"plato italiano","id_rol_empleado":3,"precio":"100"},{"id":2,"nombre_producto":"Hamburguesa Completa","descripcion":"Comida Rapida","id_rol_empleado":3,"precio":"100"},{"id":3,"nombre_producto":"Sprite","descripcion":"Bebida sin alcohol","id_rol_empleado":1,"precio":"80"},{"id":4,"nombre_producto":"IPA 54","descripcion":"Gumbrinus","id_rol_empleado":2,"precio":"90"},{"id":5,"nombre_producto":"Dry Martini","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":6,"nombre_producto":"Mojito","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":7,"nombre_producto":"Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":8,"nombre_producto":"Frozen Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":9,"nombre_producto":"Locro","descripcion":"Plato argentino","id_rol_empleado":3,"precio":"130"},{"id":10,"nombre_producto":"Flan","descripcion":"Postre","id_rol_empleado":6,"precio":"100"}]';
    }); 




  $this->get('/productos/modificar[/]', function(){
    //rol 1 bartender
    //rol 2 cervecero
    //rol 3 cocina
    //rol 4 mozo
    //rol 5 admin
    //rol 6 candybar

      return '[{"id":1,"nombre_producto":"-cambiado-risotto","descripcion":"plato italiano","id_rol_empleado":3,"precio":"100"},{"id":2,"nombre_producto":"-cambiado-Hamburguesa Completa","descripcion":"Comida Rapida","id_rol_empleado":3,"precio":"100"},{"id":3,"nombre_producto":"-cambiado-Sprite","descripcion":"Bebida sin alcohol","id_rol_empleado":1,"precio":"80"},{"id":4,"nombre_producto":"-cambiado-IPA 54","descripcion":"Gumbrinus","id_rol_empleado":2,"precio":"90"},{"id":5,"nombre_producto":"-cambiado-Dry Martini","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":6,"nombre_producto":"-cambiado-Mojito","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":7,"nombre_producto":"-cambiado-Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":8,"nombre_producto":"-cambiado-Frozen Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":9,"nombre_producto":"-cambiado-Locro","descripcion":"Plato argentino","id_rol_empleado":3,"precio":"130"},{"id":10,"nombre_producto":"-cambiado-Flan","descripcion":"Postre","id_rol_empleado":6,"precio":"100"}]';
    }); 


  $this->get('/productos/agregar[/]', function(){
    //rol 1 bartender
    //rol 2 cervecero
    //rol 3 cocina
    //rol 4 mozo
    //rol 5 admin
    //rol 6 candybar

      return '[{"id":1,"nombre_producto":"risotto","descripcion":"plato italiano","id_rol_empleado":3,"precio":"100"},{"id":2,"nombre_producto":"Hamburguesa Completa","descripcion":"Comida Rapida","id_rol_empleado":3,"precio":"100"},{"id":3,"nombre_producto":"Sprite","descripcion":"Bebida sin alcohol","id_rol_empleado":1,"precio":"80"},{"id":4,"nombre_producto":"IPA 54","descripcion":"Gumbrinus","id_rol_empleado":2,"precio":"90"},{"id":5,"nombre_producto":"Dry Martini","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":6,"nombre_producto":"Mojito","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":7,"nombre_producto":"Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":8,"nombre_producto":"Frozen Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":9,"nombre_producto":"Locro","descripcion":"Plato argentino","id_rol_empleado":3,"precio":"130"},{"id":10,"nombre_producto":"Flan","descripcion":"Postre","id_rol_empleado":6,"precio":"100"},{"id":11,"nombre_producto":"American Pale Ale","descripcion":"AltaBirra","id_rol_empleado":2,"precio":"105"}]';
    }); 



 $this->get('/productos/borrar[/]', function(){
    //rol 1 bartender
    //rol 2 cervecero
    //rol 3 cocina
    //rol 4 mozo
    //rol 5 admin
    //rol 6 candybar

      return '[{"id":1,"nombre_producto":"risotto","descripcion":"plato italiano","id_rol_empleado":3,"precio":"100"},{"id":2,"nombre_producto":"Hamburguesa Completa","descripcion":"Comida Rapida","id_rol_empleado":3,"precio":"100"},{"id":3,"nombre_producto":"Sprite","descripcion":"Bebida sin alcohol","id_rol_empleado":1,"precio":"80"},{"id":4,"nombre_producto":"IPA 54","descripcion":"Gumbrinus","id_rol_empleado":2,"precio":"90"},{"id":5,"nombre_producto":"Dry Martini","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":6,"nombre_producto":"Mojito","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":7,"nombre_producto":"Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":8,"nombre_producto":"Frozen Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":9,"nombre_producto":"Locro","descripcion":"Plato argentino","id_rol_empleado":3,"precio":"130"}]';
    });


 $this->get('/mesas/modificar[/]', function(){
  return '[{"id":1,"sillas":3, "zona":1},{"id":2,"sillas":3, "zona":2},{"id":3,"sillas":6, "zona":2},{"id":5,"sillas":2, "zona":1},{"id":6,"sillas":2, "zona":1}]';
 });


 $this->get('/mesas/lista[/]', function(){
  return '[{"id":1,"sillas":4, "zona":1},{"id":2,"sillas":3, "zona":2},{"id":3,"sillas":4, "zona":2},{"id":5,"sillas":6, "zona":1},{"id":6,"sillas":4, "zona":1}]';
 });

 $this->get('/mesas/borrar[/]', function(){
  return '[{"id":1,"sillas":4, "zona":1},{"id":2,"sillas":3, "zona":2},{"id":3,"sillas":4, "zona":2},{"id":5,"sillas":6, "zona":1}]';
 });


 $this->get('/mesas/agregar[/]', function(){
  return '[{"id":1,"sillas":4, "zona":1},{"id":2,"sillas":3, "zona":2},{"id":3,"sillas":4, "zona":2},{"id":5,"sillas":6, "zona":1},{"id":6,"sillas":4, "zona":1},{"id":7,"sillas":4, "zona":1},{"id":8,"sillas":4, "zona":2}]';
 });



 $this->get('/mesas/cerrar/id', function(){
  return "1";
 });

 $this->get('/mesas/id/', function(){
   $num=floor(rand(0,2));        
      if($num==0){
  return '{
    "id": 1,
    "estado": 2,
    "cliente": {
      "id_cliente": 2,
        "cantComensales": 2,
      "nombre": "ramiro perez",
      "cantVisitas": 0,
      "ultimaVisita": "null"
    },
    "mozo": 4,
    "nombreMozo": "Mariano Mutti",
    "total": 890,
    "pedidos": [{
      "id": 5,
      "estado": 3,
      "horaPedido": "22:00",
      "horaServido": "22:20",
      "horaEstimada": "22:15"
    }, {
      "id": 8,
      "estado": 3,
      "horaPedido": "22:05",
      "horaServido": null,
      "horaEstimada": "22:25"
    }]
  }';
}else{
  return '{
    "id": 1,
    "estado": 2,
    "cliente": {
      "id_cliente": 2,
        "cantComensales": 2,
      "nombre": "ramiro perez",
      "cantVisitas": 0,
      "ultimaVisita": "null"
    },
    "mozo": 4,
    "nombreMozo": "Mariano Mutti",
    "total": 890,
    "pedidos": [{
      "id": 5,
      "estado": 3,
      "horaPedido": "22:00",
      "horaServido": "22:20",
      "horaEstimada": "22:15"
    }, {
      "id": 8,
      "estado": 3,
      "horaPedido": "22:05",
      "horaServido": null,
      "horaEstimada": " 22:25"
    },
    {
      "id": 32,
      "estado": 1,
      "horaPedido": "22:33",
      "horaServido": "22:44",
      "horaEstimada": "22:38"
    },
    {
      "id": 12,
      "estado": 2,
      "horaPedido": "21:00",
      "horaServido": "22:20",
      "horaEstimada": "22:15"
    }]
  }';
}
 });


 $this->get('/estado[/]', function(){

  // el estado deberia ser solo arrays de numeritos, bien liviano
  //cuando entra a cada mesa q traiga el resto de la data de cada mesa, pedidos, productos, etc

   $num=floor(rand(0,2));        
      if($num==0){
  return '{
  "facturacionDia": 8420,
  "cubiertosDelDia": 25,
  "mesas": [{
    "id": 1,
    "estado": 2,
    "cliente": {
      "id_cliente": 2,
      "nombre": "ramiro perez",
      "cantVisitas": 0,
      "ultimaVisita": "null"
    },
    "mozo": 4,
    "nombreMozo": "Mariano Mutti",
    "total": 890,
    "pedidos": [{
      "id_pedido": 5,
      "estado": 3,
      "horaPedido": "25/07/18 22:00",
      "horaServido": "25/07/18 22:20",
      "horaEstimada": "25/07/18 22:15"
    }, {
      "id_pedido": 8,
      "estado": 3,
      "horaPedido": "25/07/18 22:05",
      "horaServido": null,
      "horaEstimada": "25/07/18 22:25"
    }]
  },
  {
    "id": 2,
    "estado": 5,
    "cliente": {
      "id_cliente": 5,
      "nombre": "raymond lopez",
      "cantVisitas": 42,
      "ultimaVisita": "25/12/2001"
    },
    "mozo": 4,
    "nombreMozo": "Mariano Mutti",
    "total": 424,
    "pedidos": [{
      "id_pedido": 5,
      "estado": 4,
      "horaPedido": "25/07/18 22:00",
      "horaServido": "25/07/18 22:20",
      "horaEstimada": "25/07/18 22:15"
    }, {
      "id_pedido": 8,
      "estado": 4,
      "horaPedido": "25/07/18 22:05",
      "horaServido": "25/07/18 22:25",
      "horaEstimada": "25/07/18 22:25"
    }]
  }

  ]
}';
}else{
   return '{
  "facturacionDia": 8720,
  "cubiertosDelDia": 27,
  "mesas": [{
    "id": 1,
    "estado": 3,
    "cliente": {
      "id_cliente": 2,
      "nombre": "ramiro perez",
      "cantVisitas": 0,
      "ultimaVisita": "null"
    },
    "mozo": 4,
    "nombreMozo": "Mariano Mutti",
    "total": 890,
    "pedidos": [{
      "id_pedido": 5,
      "estado": 3,
      "horaPedido": "25/07/18 22:00",
      "horaServido": "25/07/18 22:20",
      "horaEstimada": "25/07/18 22:15"
    }, {
      "id_pedido": 8,
      "estado": 3,
      "horaPedido": "25/07/18 22:05",
      "horaServido": null,
      "horaEstimada": "25/07/18 22:25"
    }]
  },
  {
    "id": 2,
    "estado": 6,
    "cliente": {
      "id_cliente": 5,
      "nombre": "raymond lopez",
      "cantVisitas": 42,
      "ultimaVisita": "25/12/2001"
    },
    "mozo": 4,
    "nombreMozo": "Mariano Mutti",
    "total": 424,
    "pedidos": [{
      "id_pedido": 5,
      "estado": 4,
      "horaPedido": "25/07/18 22:00",
      "horaServido": "25/07/18 22:20",
      "horaEstimada": "25/07/18 22:15"
    }, {
      "id_pedido": 8,
      "estado": 4,
      "horaPedido": "25/07/18 22:05",
      "horaServido": "25/07/18 22:25",
      "horaEstimada": "25/07/18 22:25"
    }]
  }

  ]
}';
}//else
 }); // estado



//informes:

   $this->get('/informes/empleados/logueos', function(){
   echo file_get_contents("jsons/empleados_logueos.json");

  });

  $this->get('/informes/empleados/operaciones', function(){
   echo file_get_contents("jsons/empleados_tareas.json");
   
  });

    $this->get('/informes/productos/cancelaciones', function(){
   echo file_get_contents("jsons/productos_cancelaciones.json");
   
  });

   $this->get('/informes/productos/tiempoEspera', function(){
   echo file_get_contents("jsons/productos_tiempo_espera.json");
   
  });

    $this->get('/informes/productos/cantVentas', function(){
   echo file_get_contents("jsons/productos_cant_ventas.json");
   
  });

       $this->get('/informes/mesas/cantUsos', function(){
   echo file_get_contents("jsons/mesas_cant_usos.json");
   
  });

          $this->get('/informes/mesas/facturacion', function(){
   echo file_get_contents("jsons/mesas_facturacion.json");
   
  });

   $this->get('/informes/mesas/facturaMayor', function(){
   echo file_get_contents("jsons/mesa_factura_mayor.json");
   
  });
  $this->get('/informes/facturacion', function(){
   echo file_get_contents("jsons/facturacion.json");
   
  });

   $this->get('/informes/empleados/cantOperacPorSector', function(){
     return ' {
      "Cocinerxs: ": 120,
      "Meserxs: ": 130,
      "Bar: ": 10,
      "cervecerxs: ": 48,
      "Candybar: ": 22
  }';
  });
  


}); //fin admin

//MOZO!

$app->group('/mozo', function () { 
  $this->get('/login[/]', function(){
      return '{"token":"difgsdiufsdfgsyd5f456g56g456g456g45hf942fh24TDYBTUfyufyunyu6745645TGYgybybtybrty5656", "nombre":"Charles Manson"}';
  });

  $this->get('/cliente/agregar[/]', function(){
      return "{'cliente_id':8,'nombre':'juanelo godines', 'comensales':3,'usuario':'juanelo28', 'mesa':8,'hora_llegada':'25/072018 21:00'}";
  });

    $this->get('/cliente/pedirCuenta[/]', function(){
      return "{'cliente_id':8,'usuario':'juanelo28', 'mesa':8, 'total':842}";
  });


   $this->get('/pedidos/agregar[/]', function(){
    //devuelve el estado de la mesa
    //con el estado de la mesa cambiado
    //y obviamente el nuevo pedido 
 return '{
    "id": 1,
    "estado": 3,
    "cliente": {   
      "nombre": "ramiro perez" 
    },
      "pedidos": [{
      "id": 5,
      "estado": 3,
      "horaPedido": "22:00",
      "horaServido": "22:20",
      "horaEstimada": "22:15",
      "productos":[{"id":1,"nombre_producto":"Omelette", "cantidad":2},{"id":2,"nombre_producto":"Hamburguesa Completa", "cantidad":1}]
    }, {
      "id": 8,
      "estado": 3,
      "horaPedido": "21:05",
      "horaServido": null,
      "horaEstimada": "22:25",
       "productos":[{"id":4,"nombre_producto":"Ensalada Mixta Grande", "cantidad":2},{"id":12,"nombre_producto":"Hamburguesa Simple", "cantidad":1},{"id":43,"nombre_producto":"Birri", "cantidad":30}]
    },
  {
      "id": 81,
      "estado": 1,
      "horaPedido": "22:05",
      "horaServido": null,
      "horaEstimada": "null",
       "productos":[{"id":4,"nombre_producto":"xxxxx xxxxx","cantidad":2},{"id":12,"nombre_producto":"xxx xxxxx", "cantidad":1},{"id":43,"nombre_producto":"Birri", "cantidad":30}]
    }]
  }';
  });

    $this->get('/pedidos/cancelar[/]', function(){
      return '{"id_pedido":32, "estado":5, "horaPedido":"25/07/18 22:00", "horaServido":null, "horaEstimada":null}';
    });

    $this->get('/pedidos/entregar[/]', function(){
      return '{"id_pedido":32, "estado":4, "mesa":8, "horaPedido":"25/07/18 22:00", "horaServido":"25/07/18 23:00", "horaEstimada":"25/07/18 22:50"}';
    });

      $this->get('/pedidos/id/{id}', function(){
      return '{"id_pedido":32, "estado":4, "mesa":8, "horaPedido":"25/07/18 22:00", "horaServido":"25/07/18 23:00", "horaEstimada":"25/07/18 22:50", "productos":[{"id":1,"nombre_producto":"risotto","descripcion":"plato italiano","id_rol_empleado":3,"precio":"100"},{"id":2,"nombre_producto":"Hamburguesa Completa","descripcion":"Comida Rapida","id_rol_empleado":3,"precio":"100"},{"id":3,"nombre_producto":"Sprite","descripcion":"Bebida sin alcohol","id_rol_empleado":1,"precio":"80"},{"id":4,"nombre_producto":"IPA 54","descripcion":"Gumbrinus","id_rol_empleado":2,"precio":"90"},{"id":5,"nombre_producto":"Dry Martini","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":6,"nombre_producto":"Mojito","descripcion":"Trago","id_rol_empleado":1,"precio":"120"}]}}';
    });

        $this->get('/mesas/habilitar[/]', function(){
          //siempre devuelve la mesa entera
        return '{
    "id": 1,
    "estado": 2,
    "cliente": {   
      "nombre": "juanelo godines",
      "usuario":"j_god666"
    },
      "pedidos": []
  }';
 });



   $this->get('/mesas/lista[/]', function(){
    return '[{"id":1,"sillas":4, "zona":1},
    {"id":2,"sillas":3, "zona":2},
    {"id":3,"sillas":4, "zona":2},
    {"id":5,"sillas":6, "zona":1},
    {"id":6,"sillas":4, "zona":1},
    {"id":7,"sillas":2, "zona":1},
    {"id":8,"sillas":4, "zona":1},
    {"id":9,"sillas":2, "zona":2},
    {"id":10,"sillas":2, "zona":1},
    {"id":11,"sillas":6, "zona":1},
    {"id":12,"sillas":6, "zona":2},
    {"id":13,"sillas":5, "zona":2}
  ]';
   });



  $this->get('/mesas/id[/]', function(){
  // $num=floor(rand(0,2));        
    //  if($num==0){
      
// lo tengo q reemplazar con un super pedido que traiga, 
//id mesa
//id cliente
//pedidos


  return '{
    "id": 1,
    "estado": 2,
    "cliente": {   
      "nombre": "ramiro perez" 
    },
      "pedidos": [{
      "id": 5,
      "estado": 3,
      "horaPedido": "22:00",
      "horaServido": "22:20",
      "horaEstimada": "22:15",
      "productos":[{"id":1,"nombre_producto":"Omelette", "cantidad":2},{"id":2,"nombre_producto":"Hamburguesa Completa", "cantidad":1}]
    }]}';
    //  {
    //   "id": 8,
    //   "estado": 3,
    //   "horaPedido": "22:05",
    //   "horaServido": null,
    //   "horaEstimada": "22:25",
    //    "productos":[{"id":4,"nombre_producto":"Ensalada Mixta Grande", "cantidad":2},{"id":12,"nombre_producto":"Hamburguesa Simple", "cantidad":1},{"id":43,"nombre_producto":"Birri", "cantidad":30}]
    // }]
  

 });


    $this->get('/estado[/]', function(){      


      $num=floor(rand(0,4));        
      if($num!=0){
          $rta= '{"estados":{"1":1,"2":2,"3":0,"5":0,"6":2},"notif":[]}';            
      }else {
            $rta= '{"estados":{"1":2,"2":3,"3":2,"5":0,"6":0},"notif":[{"mesa":2, "pedido":44, "donde":"cocina"},{"mesa":1, "pedido":77, "donde":"Bar"},{"mesa":12, "pedido":22, "donde":"CandyBar"},{"mesa":11, "pedido":31, "donde":"Cervezas"}]}';     
      }
          return $rta;
 
  });




  $this->get('/productos/lista[/]', function(){
   //solo deberia mostrar los productos q el admin dejo habilitados

      return '[{"id":1,"nombre_producto":"risotto","descripcion":"plato italiano","id_rol_empleado":3,"precio":"100"},{"id":2,"nombre_producto":"Hamburguesa Completa","descripcion":"Comida Rapida","id_rol_empleado":3,"precio":"100"},{"id":3,"nombre_producto":"Sprite","descripcion":"Bebida sin alcohol","id_rol_empleado":1,"precio":"80"},{"id":4,"nombre_producto":"IPA 54","descripcion":"Gumbrinus","id_rol_empleado":2,"precio":"90"},{"id":5,"nombre_producto":"Dry Martini","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":6,"nombre_producto":"Mojito","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":7,"nombre_producto":"Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":8,"nombre_producto":"Frozen Margarita","descripcion":"Trago","id_rol_empleado":1,"precio":"120"},{"id":9,"nombre_producto":"Locro","descripcion":"Plato argentino","id_rol_empleado":3,"precio":"130"},{"id":10,"nombre_producto":"Flan","descripcion":"Postre","id_rol_empleado":6,"precio":"100"}]';
    }); 



}); //mozo


/// servicios cocinero/bartender/cervecero/candybar




$app->group('/cocinero', function () { 
  $this->get('/login[/]', function(){
      return '{"token":"dty94g5yn9t54f9t.htfFVTY53f8656UYTUf598.yXCV3d59nb78h56", "nombre":"Willie Colón", "rol":"3"}';
  });

  $this->get('/estado[/]', function(){
      return  '{"pedidos":[{"id":1,"mesa":4,"prods":{"1":"Kai Pad","43":"Pad Thai"}},{"id":10,"mesa":3,"prods":{"3":"Puré de papas","8":"Huevos fritos x2"}}],"notif":[{"hora_pedido":"22:02","pedido":164,"mesa":12,"prods":{"1":"Kai Pad","44":"Curry Rojo de Cerdo"}}]}';
  });
  $this->get("/listarPedidos", function(){
   return ' [{"id":1,"mesa":4,"prods":{"1":"Kai Pad","43":"Pad Thai"}},{"id":10,"mesa":3,"prods":{"3":"Puré de papas","8":"Huevos fritos x2"}}]';
  });

  $this->get("/aceptarPedido", function(){
   return '{"notif":[], "pedidos": [{"id":1,"mesa":4,"prods":{"1":"Kai Pad","43":"Pad Thai"}},{"id":10,"mesa":3,"prods":{"3":"Puré de papas","8":"Huevos fritos x2"}},{"id":164,"mesa":12,"prods":{"1":"Kai Pad","44":"Curry Rojo de Cerdo"}}]}';
  });


});


$app->get("[/]", function(){
  return "nada por aqui";
});


$app->run();



