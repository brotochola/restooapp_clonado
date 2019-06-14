<?php
require_once "cliente.php";

class ClienteApi extends Cliente
{

    //OK
    public function TraerUno($request, $response, $args)
    {
        $id_cliente = $args['id_cliente'];

        $elcliente = Cliente::TraerUnCliente($id_cliente);

        $rta = [];

        $newResponse = $response;

        if ($elcliente) {
            $rta = $elcliente;
        } else {
            $rta["estado"] = "ERROR";
            $rta['mensaje'] = 'No se encontró ese Cliente.';
        }

        return $newResponse->withJson($rta, 200);
    }

    //OK
    public function TraerTodos($request, $response, $args)
    {
        $Clientes = Cliente::TraerTodosLosClientes();
        $newResponse = $response->withJson($Clientes, 200);
        return $newResponse;
    }

    //OK
    public function CargarUno($request, $response, $args)
    {
        $Hora = new DateTime();
        $aux = date_format($Hora, "Y/m/d H:i:s");

        $el_cliente = new Cliente();

        $vector = $request->getParsedBody();

        if (array_key_exists("nombre_completo", $vector)) {
            $el_cliente->nombre_completo = $vector['nombre_completo'];
        }
        if (array_key_exists("dni", $vector)) {
            $el_cliente->dni = $vector['dni'];
        }
        if (array_key_exists("email", $vector)) {
            $el_cliente->email = $vector['email'];
        }
        if (array_key_exists("clave", $vector)) {
            $el_cliente->clave = $vector['clave'];
        }
        if (array_key_exists("foto", $vector)) {
            $el_cliente->foto = $vector['foto'];
        }

        $resultado = $el_cliente->InsertarCliente();

        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->cantidad = $resultado;
        $objDelaRespuesta->itsOk = false;

        if ($resultado > 0) {
            $objDelaRespuesta->mensaje = "Se hizo el alta del cliente!";
            $objDelaRespuesta->itsOk = true;
        } elseif ($resultado < 1) $objDelaRespuesta->mensaje = "No se pudo hacer el alta!";

        return $response->withJson(Cliente::TraerTodosLosClientes(), 200);
    }

    //OK
    public function BorrarUno($request, $response, $args)
    {
        $newResponse = $response;

        $ArrayDeParametros = $request->getParsedBody();
        $id_cliente = $ArrayDeParametros['id_cliente'];

        if (empty(Cliente::TraerUnCliente($id_cliente))) {
            $rta['estado'] = 'ERROR';
            $rta['respuesta'] = 'No se encontró ese cliente';
            return $newResponse = $newResponse->withJson($rta, 200);
        } else {

            $cantidadDeBorrados = (Cliente::TraerUnCliente($id_cliente))->BorrarCliente();

            if ($cantidadDeBorrados > 0) {
                $rta['estado'] = 'OK';
                $rta['respuesta'] = "Elementos borrados: " . $cantidadDeBorrados;
            } else {
                $rta['estado'] = 'ERROR';
                $rta['respuesta'] = 'No se pudo borrar el cliente';
                return $newResponse = $newResponse->withJson($rta, 200);
            }
        }

        return $newResponse = $newResponse->withJson(Cliente::TraerTodosLosClientes(), 200);
    }

    //OK
    public function ModificarUno($request, $response, $args)
    {
        $el_cliente = new Cliente();

        $vector = $request->getParsedBody(); //ahora viene por post
    
        if (array_key_exists("id_cliente", $vector)) {
            $el_cliente->id_cliente = $vector['id_cliente'];
        }
        if (array_key_exists("nombre_completo", $vector)) {
            $el_cliente->nombre_completo = $vector['nombre_completo'];
        }
        if (array_key_exists("dni", $vector)) {
            $el_cliente->dni = $vector['dni'];
        }
        if (array_key_exists("email", $vector)) {
            $el_cliente->email = $vector['email'];
        }
        if (array_key_exists("clave", $vector)) {
            $el_cliente->clave = $vector['clave'];
        }
        if (array_key_exists("foto", $vector)) {
            $el_cliente->foto = $vector['foto'];
        }

        //return $response->withJson($el_cliente, 200);	

        $resultado = $el_cliente->ModificarUno();

        return $response->withJson(Cliente::TraerTodosLosClientes(), 200);
    }

    public function Login($request, $response, $args)
    {
        return $response->withJson("Sin Implementar", 200);
    }

    public function LoginAnon($request, $response, $args)
    {
        return $response->withJson("Sin Implementar", 200);
    }
}
