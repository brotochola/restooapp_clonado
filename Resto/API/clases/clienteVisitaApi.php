<?php
require_once "clienteVisita.php";

class ClienteVisitaApi extends ClienteVisita
{

    //OK
    public function TraerUno($request, $response, $args)
    {
        $id_cliente_visita = $args['id_cliente_visita'];

        $el_cliente_visita = ClienteVisita::TraerUnClienteVisita($id_cliente_visita);

        $rta = [];

        $newResponse = $response;

        if ($el_cliente_visita) {
            $rta = $el_cliente_visita;
        } else {
            $rta["estado"] = "ERROR";
            $rta['mensaje'] = 'No se encontró ese ClienteVisita.';
        }

        return $newResponse->withJson($rta, 200);
    }

    public function TraerMesaPorIDCliente($request, $response, $args)
    {
        $id_cliente = $args['id_cliente'];

        $elcliente = ClienteVisita::TraerPorID_Cliente($id_cliente);

        $rta = [];

        $newResponse = $response;

        if ($elcliente) {
            $rta = $elcliente;
        } else {
            $rta["estado"] = "ERROR";
            $rta['mensaje'] = 'No se encontró ese ClienteVisita.';
        }

        return $newResponse->withJson($rta, 200);
    }

    //OK
    public function TraerTodos($request, $response, $args)
    {
        $ClienteVisitas = ClienteVisita::TraerTodosLosClienteVisitas();
        $newResponse = $response->withJson($ClienteVisitas, 200);
        return $newResponse;
    }

    //OK Falta validar que estén todos los campos
    public function CargarUno($request, $response, $args)
    {
        $una_cliente_visita = new ClienteVisita();

        $arrayDeParametros = $request->getParsedBody();

        var_dump($arrayDeParametros);

        $una_cliente_visita->id_cliente = $arrayDeParametros["id_cliente"];
        $una_cliente_visita->id_mesa = $arrayDeParametros["id_mesa"];
        $una_cliente_visita->fecha = date("Y-m-d H:i:s");
        $una_cliente_visita->comensales = $arrayDeParametros["comensales"];
        $una_cliente_visita->mozo = $arrayDeParametros["mozo"];

        $resultado = $una_cliente_visita->InsertarClienteVisita();

        $rta["cantidad"] = $resultado;
        $rta["itsOk"] = false;

        if ($resultado > 0) {
            $rta["mensaje"] = "Se hizo el alta de la cliente_visita!";
            $rta["itsOk"] = true;
        } elseif ($resultado < 1) {
            $rta["mensaje"] = "No se pudo hacer el alta!";
        }

        return $response->withJson($rta, 200);
    }

    //OK
    public function BorrarUno($request, $response, $args)
    {
        $newResponse = $response;

        $ArrayDeParametros = $request->getParsedBody();
        $id_cliente_visita = $ArrayDeParametros['id_cliente_visita'];

        $rta['estado'] = 'ERROR';

        if (empty(ClienteVisita::TraerUnClienteVisita($id_cliente_visita))) {
            $rta['respuesta'] = 'No se encontró ese cliente_visita';
        } else {

            $cantidadDeBorrados = (ClienteVisita::TraerUnClienteVisita($id_cliente_visita))->BorrarClienteVisita();

            if ($cantidadDeBorrados > 0) {
                $rta['estado'] = 'OK';
                $rta['respuesta'] = "Elementos borrados: " . $cantidadDeBorrados;
            } else {
                $rta['respuesta'] = 'No se pudo borrar el cliente_visita';
            }
        }

        return $newResponse = $newResponse->withJson($rta, 200);
    }

    //OK
    public function ModificarUno($request, $response, $args)
    {
        $newResponse = $response;

        $ArrayDeParametros = $request->getParsedBody();

        $rta["estado"] = "ERROR";

        if (
            $ArrayDeParametros == null
            or !array_key_exists('id_cliente_visita', $ArrayDeParametros)
        ) {
            $rta["mensaje"] = 'Ingrese debe ingresar al menos la key "id_cliente_visita"';
        } else {
            if ($ArrayDeParametros['id_cliente_visita'] == null) {
                $rta["mensaje"] = 'ERROR!! Complete el campo de la key "id_cliente_visita"';
            } else {

                $mi_cliente_visita = ClienteVisita::TraerUnClienteVisita($ArrayDeParametros['id_cliente_visita']);

                if (empty($mi_cliente_visita)) {
                    $rta["mensaje"] = 'ERROR!! No se encontró el cliente_visita que desea modificar.';
                } else {

                    //Reviso si la key está y si no está vacía
                    $array_id_cliente = self::comprobar_key("id_cliente", $ArrayDeParametros, false);
                    if ($array_id_cliente["esValido"]) {
                        $mi_cliente_visita->id_cliente = $ArrayDeParametros['id_cliente'];
                    } elseif (array_key_exists('msg', $array_id_cliente)) {
                        return $newResponse->getBody()->write($array_id_cliente["msg"]);
                    }

                    $array_id_mesa = self::comprobar_key("id_mesa", $ArrayDeParametros, false);
                    if ($array_id_mesa["esValido"]) {
                        $mi_cliente_visita->id_mesa = $ArrayDeParametros['id_mesa'];
                    } elseif (array_key_exists('msg', $array_id_mesa)) {
                        return $newResponse->getBody()->write($array_id_mesa["msg"]);
                    }

                    $array_fecha = self::comprobar_key("fecha", $ArrayDeParametros, false);
                    if ($array_fecha["esValido"]) {
                        $mi_cliente_visita->fecha = $ArrayDeParametros['fecha'];
                    } elseif (array_key_exists('msg', $array_fecha)) {
                        return $newResponse->getBody()->write($array_fecha["msg"]);
                    }

                    $array_comensales = self::comprobar_key("comensales", $ArrayDeParametros, false);
                    if ($array_comensales["esValido"]) {
                        $mi_cliente_visita->comensales = $ArrayDeParametros['comensales'];
                    } elseif (array_key_exists('msg', $array_comensales)) {
                        return $newResponse->getBody()->write($array_comensales["msg"]);
                    }

                    $array_mozo = self::comprobar_key("mozo", $ArrayDeParametros, false);
                    if ($array_mozo["esValido"]) {
                        $mi_cliente_visita->mozo = $ArrayDeParametros['mozo'];
                    } elseif (array_key_exists('msg', $array_mozo)) {
                        return $newResponse->getBody()->write($array_mozo["msg"]);
                    }

                    $array_date_created = self::comprobar_key("date_created", $ArrayDeParametros, false);
                    if ($array_date_created["esValido"]) {
                        $mi_cliente_visita->date_created = $ArrayDeParametros['date_created'];
                    } elseif (array_key_exists('msg', $array_date_created)) {
                        return $newResponse->getBody()->write($array_date_created["msg"]);
                    }

                    $array_last_modified = self::comprobar_key("last_modified", $ArrayDeParametros, false);
                    if ($array_last_modified["esValido"]) {
                        $mi_cliente_visita->last_modified = $ArrayDeParametros['last_modified'];
                    } elseif (array_key_exists('msg', $array_last_modified)) {
                        return $newResponse->getBody()->write($array_last_modified["msg"]);
                    }

                    if ($mi_cliente_visita->ModificarClienteVisita() > 0) {
                        $rta["mensaje"] = "cliente_visita modificada";
                        $rta["estado"] = "OK";
                    } else {
                        $rta["mensaje"] = "No se modificó el cliente_visita";
                    }
                }
            }
        }

        return $newResponse = $newResponse->withJson($rta, 200);
    }

   

    public static function comprobar_key($tag, $unArray, $required)
    {
        $rta_array = array();
        $rta_array["esValido"] = false;

        if (array_key_exists($tag, $unArray)) {
            if ($required) {
                if ($unArray[$tag] == null) {
                    $rta_array["msg"] = 'ERROR!! Complete el campo de la key "' . $tag;
                }
            } else {
                $rta_array["esValido"] = true;
            }
        }

        return $rta_array;
    }
}
