<?php

require_once 'AccesoDatos.php';
require_once 'mesa.php';

class mesaApi extends mesa
{


    //=============AGREGADOS APP RESTO2


    public function clienteSolicitaMesa($request, $response, $args)
    {

        // ESTO ES CUANDO UN CLIENTE SE SIENTA EN UNA MESA
        //Y SE GENERA UN CLIENTE_VISITA
        $miMesa = new mesa();

        $ArrayDeParametros = $request->getParsedBody();


        //   print_r($ArrayDeParametros);die();


        $vHora = new DateTime();
        $laHora = date_format($vHora, "Y/m/d H:i:s");

        $vIdMesa = $ArrayDeParametros['id_mesa'];
        $vIdCliente = $ArrayDeParametros['id_cliente'];




        //ME FIJO SI LA MESA ESTA USADA

        $laMesa = mesa::TraerUno($vIdMesa)[0];

        if ($laMesa->estado_mesa != 0) {
            //LE MESA ESTA OCUPADA
            $rta = new stdClass();
            $rta->mensaje = "la mesa esta ocupada";
            $response->getBody()->write(json_encode($rta));
            return $response;
        } else {
            //LA MESA ESTA LIBRE
            $id_cliente_visita = mesa::CargarClienteVisita($vIdMesa, $vIdCliente, $laHora, 2, -1);
            mesa::ModificarEstadoDeLaMesa($vIdMesa, 1);


            //  $arr=self::id2MesaCompleta($vIdMesa);    

            return $response->withJson(ClienteVisita::TraerUnClienteVisita($id_cliente_visita), 200);
        }
    }


    public function HabilitarMesa($request, $response, $args)
    {

        // ESTO ES CUANDO UN CLIENTE SE SIENTA EN UNA MESA
        //Y SE GENERA UN CLIENTE_VISITA
        $miMesa = new mesa();

        $ArrayDeParametros = $request->getParsedBody();




        $vHora = new DateTime();
        $laHora = date_format($vHora, "Y/m/d H:i:s");

        $vIdMesa = $ArrayDeParametros['id_mesa'];
        $nombre = $ArrayDeParametros['nombre'];
        $dni = $ArrayDeParametros['dni'];
        $foto = $ArrayDeParametros['foto'];
        $email = $ArrayDeParametros['email'];
        $vComensales = $ArrayDeParametros['cantComensales'];


        $vIdCliente = cliente::email2Cliente($email);

        if (count($vIdCliente) > 0) {
            //el cliente existe
            $vIdCliente = $vIdCliente[0]->id_cliente;
        } else {

            //el cliente NO existe
            $cliente = new cliente();
            $cliente->nombre_completo = $nombre;
            $cliente->dni = $dni;
            $cliente->habilitado=1;
            $cliente->foto = $foto;
            $cliente->email = $email;
            $vIdCliente = $cliente->insertar();
        }




        $token = $request->getHeader('token')[0];
        $payload = AutentificadorJWT::ObtenerData($token);
        $idmozo = $payload->id_empleado;





        $id_cliente_visita = mesa::CargarClienteVisita($vIdMesa, $vIdCliente, $laHora, $vComensales, $idmozo);




        mesa::ModificarEstadoDeLaMesa($vIdMesa, 1);

        $rta = new stdClass();
        $rta->mesas = mesa::TraerTodas();
        $response->getBody()->write(json_encode($rta));
        //$newResponse = $response->withJson($rta, 200);  
        return $response;
    }

    public function TraerMesas($request, $response, $args)
    {
        $Mesas = mesa::TraerTodas();
        $newResponse = $response->withJson($Mesas, 200);
        return $newResponse;
    }
    public static function cerrarMesa($request, $response)
    {
        $id_mesa = $request->getParsedBody()["id_mesa"];
        $rta = mesa::CambiarEstadoMesa($id_mesa, 6);
        $newResponse = $response->withJson($rta, 200);
        return $newResponse;
    }

    public static function indicarQueLaMesaEstaLibre($request, $response)
    {
        $id_mesa = $request->getParsedBody()["id_mesa"];
        $rta = mesa::CambiarEstadoMesa($id_mesa, 0);
        $newResponse = $response->withJson($rta, 200);
        return $newResponse;
    }


    public static function pedirCuenta($request, $response)
    {
        $id_mesa = $request->getParsedBody()["id_mesa"];
        mesa::CambiarEstadoMesa($id_mesa, 5);

        $rta = self::id2MesaCompleta($id_mesa);

        $newResponse = $response->withJson($rta, 200);
        return $newResponse;
    }

    public function ModificarEstadoMesa_($request, $response, $args)
    {
        $newResponse = $response;

        $ArrayDeParametros = $request->getParsedBody();

        $rta["estado"] = "ERROR";


        $id_mesa = $ArrayDeParametros['id_mesa'];
        $estado_mesa = $ArrayDeParametros['estado_mesa'];

        $rta["params"] = $ArrayDeParametros;

        if (mesa::CambiarEstadoMesa($id_mesa, $estado_mesa) > 0) {
            $rta["mensaje"] = "Estado de la mesa modificado";
            $rta["estado"] = "OK";
        } else {
            $rta["mensaje"] = "No se modificó el estado de la mesa";
        }

        return $newResponse = $newResponse->withJson($rta, 200);
    }
    public static function estadoAdmin($request, $response)
    {
        $rta = new stdClass();
        $rta->mesas = mesa::TraerTodas();

        $newResponse = $response->withJson($rta, 200);
        return $newResponse;
    }


    public static function estadoMozo($request, $response)
    {
        //  echo 1;die();
        $rta = new stdClass();
        $rta->mesas = mesa::TraerTodas();
        $rta->pedidos = pedido::traerMisPedidos($request, $response);

        $response->getBody()->write(json_encode($rta));

        return $response;
    }

    public static function id2MesaCompleta($id)
    {

        $respuestaArray = new stdClass();
        $vId = $id;
        $mesa = mesa::TraerLaMesa($vId)[0];

        $cliente_visita = mesa::TraerClienteVisita($vId);




        $respuestaArray = json_decode(json_encode($mesa)); //copia, por las dudas




        if (count($cliente_visita) > 0) {
            $id_cliente_visita = $cliente_visita[0]["id_cliente_visita"];
            $id_cliente = $cliente_visita[0]["id_cliente"];
            $cliente = cliente::TraerUno($id_cliente);
            $pedidos = pedido::traerPedidosDeClienteVisita($id_cliente_visita);

            $respuestaArray->cliente = $cliente[0];

            $respuestaArray->cliente->cant_visitas = cliente::cantVisitasCliente($id_cliente);


            $respuestaArray->pedidos = $pedidos;
            $respuestaArray->clienteVisita = $cliente_visita[0];
            $id_mozo=$cliente_visita[0]["mozo"];
            if($id_mozo>-1){
                $respuestaArray->mozo = empleado::TraerUnoId($cliente_visita[0]["mozo"])[0];

            }else{
                $respuestaArray->mozo=-1;
            }
            $respuestaArray->total_mesa = 0;


            for ($i = 0; $i < count($pedidos); $i++) {
                $respuestaArray->pedidos[$i]["total_pedido"] = 0;
                $respuestaArray->pedidos[$i]["productos"] = pedidoApi::TraerMiPedido($pedidos[$i]['id']); //con productos
                $cantProds = count($respuestaArray->pedidos[$i]["productos"]);
                for ($k = 0; $k < $cantProds; $k++) {
                    $respuestaArray->pedidos[$i]["total_pedido"] += floatval($respuestaArray->pedidos[$i]["productos"][$k]->precio) * $respuestaArray->pedidos[$i]["productos"][$k]->cantidad;
                }
                $respuestaArray->total_mesa += $respuestaArray->pedidos[$i]["total_pedido"];
            } //for
        } else {
            //SI LA MESA NO ESTA OCUPADA POR NADIE
            $respuestaArray->pedidos = [];
            $respuestaArray->clienteVisita = new stdClass();
            $respuestaArray->cliente = new stdClass();
            $respuestaArray->mozo = new stdClass();
            $respuestaArray->total_mesa = 0;
        }









        return $respuestaArray;
    }

    public function TraerUnaMesa($request, $response, $args)
    {
        $arr = self::id2MesaCompleta($args['id']);


        return $response->withJson($arr, 200);
    }


    //=============FIN AGREGADOS APP RESTO2

    //admin agrega una mesa
    public function CargarMesa($request, $response, $args)
    {
        $miMesa = new mesa();
        $ArrayDeParametros = $request->getParsedBody();
        $mesaQViene = json_decode($ArrayDeParametros["mesa"]);

        $miMesa->sillas =  $mesaQViene->sillas;
        $miMesa->zona =  $mesaQViene->zona;
        $miMesa->id_estado_mesa =  1;




        $miMesa->Insertar();

        return $response->withJson(mesa::TraerTodas(), 200);
    }

    public function TraerMesa($request, $response, $args)
    {
        $vector  = $request->getParams('id_mesa');
        $vId = $vector['id_mesa'];

        $laMesa = mesa::TraerUno($vId);
        $newResponse = $response->withJson($laMesa, 200);
        return $newResponse;
    }

    // public function TraerMesas($request, $response, $args) 
    // {   
    //     $Empleados = mesa::TraerTodos();        
    //     $newResponse = $response->withJson($Empleados, 200);  
    //     return $newResponse;
    // }  

    public function ModificarEstadoMesa($request, $response, $args)
    {
        $vMesa = new mesa();
        $vector  = $request->getParams('id_estado_mesa', 'id_mesa');
        $vMesa->id_mesa = $vector['id_mesa'];
        $var = mesa::TraerUno($vMesa->id_mesa);

        if ($var != null) {
            $vMesa = $var[0];
            $vMesa->id_estado_mesa = $vector['id_estado_mesa'];
            $resultado = $vMesa->Modificar();
            $responseObj = new stdclass();
            $responseObj->resultado = $resultado;
            $responseObj->tarea = "modificar";
            return $response->withJson($responseObj, 200);
        }
    }

    public function ModificarMesa($request, $response, $args)
    {
        $vMesa = new mesa();
        $responseObj = new stdclass();
        $responseObj->itsOk = False;

        $vector  = $request->getParams('id_estado_mesa', 'id_mesa');
        $vMesa->id_mesa = $vector['id_mesa'];
        $var = mesa::TraerUno($vMesa->id_mesa);
        if ($var != null) {

            $vMesa = $var[0];
            $vMesa->id_estado_mesa = $vector['id_estado_mesa'];
            if ($vMesa->id_estado_mesa == 4 && $rol != 1) {
                $responseObj->respuesta = "Para cerrar una mesa hay que se administrador";
                $nueva = $response->withJson($responseObj, 401);
                return $nueva;
            } else {
                $resultado = $vMesa->Modificar();
                $responseObj = new stdclass();
                $responseObj->resultado = $resultado;
                return $response->withJson($responseObj, 200);
            }
        }
    }

    public function BorraMesa($request, $response, $args)
    {
        $vMesa = new mesa();
        $vId = $args['id_mesa'];
        $var = mesa::TraerUno($vId);

        if ($var != null) {
            $vMesa = $var[0];
            $cantidadDeBorrados = $vMesa->Borrar();
            $objDelaRespuesta = new stdclass();
            $objDelaRespuesta->cantidad = $cantidadDeBorrados;

            if ($cantidadDeBorrados == 1) $objDelaRespuesta->resultado = "Se borró un elemento!!!";

            elseif ($cantidadDeBorrados > 1) $objDelaRespuesta->resultado = "Se borró más de un elemento!!!";

            elseif ($cantidadDeBorrados < 1) $objDelaRespuesta->resultado = "No se borró ningún elemento!!!";

            $newResponse = $response->withJson($objDelaRespuesta, 200);
            return $newResponse;
        } else {
            return "No existe ninguna mesa con ese código";
        }
    }
}
