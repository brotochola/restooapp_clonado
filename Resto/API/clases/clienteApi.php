<?php

require_once 'AccesoDatos.php';
require_once 'cliente.php';

class clienteApi extends cliente
{
    public static function estadoCliente($request, $response)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $id_cliente = $ArrayDeParametros["id_cliente"];
        $rta = self::idCliente2idClienteVisita($id_cliente);
        return $response->withJson($rta, 200);
    }

    public static function idCliente2idClienteVisita($id)
    {

        $sql = "SELECT cliente_visita.* from cliente_visita where cliente_visita.id_cliente=" . $id . "
        and cliente_visita.date_created < DATE_SUB(now(), INTERVAL 3 HOUR)
        order by cliente_visita.date_created desc
        limit 1";

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->execute();
        $cliente_visita = $consulta->fetchAll(PDO::FETCH_CLASS, "stdClass")[0];
        $arr = mesaApi::id2MesaCompleta($cliente_visita["id_mesa"]);
        return $arr;
    }

    public function CargarCliente($request, $response, $args)
    {
        $newResponse = $response;

        $miCliente = new cliente();
        $ArrayDeParametros = $request->getParsedBody();
        //$miCliente->id_cliente = $ArrayDeParametros['id_cliente'];
        $miCliente->nombre_completo = $ArrayDeParametros['nombre_completo'];
        $miCliente->dni = $ArrayDeParametros['dni'];
        $miCliente->email = $ArrayDeParametros['email'];

        $var = cliente::email2Cliente($miCliente->email);
        $rta["estado"] = "ERROR";

        if ($var == null) {

            $var = cliente::dni2Cliente($miCliente->dni);

            if ($var == null) {

                $id_cliente = $miCliente->Insertar();

                $mailEnviado = self::mandarleMailConfirmacionAlCliente($id_cliente);
                //$mailEnviado = true;

                $rta["estado"] = "OK";
                $rta["id_cliente"] = $id_cliente;
                $rta["envio_mail"] = $mailEnviado;

                return $newResponse->withJson($rta, 200);
            } else {
                $rta["mensaje"] = "El DNI " . $ArrayDeParametros['dni'] . " ya está registrado.";
                return $response->withJson($rta, 200);
            }
        } else {
            $rta["mensaje"] = "El mail " . $ArrayDeParametros['email'] . " ya está registrado.";
            return $response->withJson($rta, 200);
        }
    }

    public function TraerUnCliente($request, $response, $args)
    {
        $id = $args['id'];

        $elcliente = Cliente::TraerUno($id);

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

    public function TraerUnClientePorMail($request, $response, $args)
    {
        $email = $args['email'];

        $elcliente = Cliente::email2Cliente($email);

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

    public function TraerClientes($request, $response, $args)
    {
        $Clientes = cliente::TraerTodos();
        $newResponse = $response->withJson($Clientes, 200);
        return $newResponse;
    }

    public function ModificarCliente($request, $response, $args)
    {
        $vCliente = new cliente();
        $vector  = $request->getParams('id_cliente', 'nombre_completo');
        $vCliente->id_cliente = $vector['id_cliente'];
        $vCliente->nombre_completo = $vector['nombre_completo'];

        $resultado = $vCliente->Modificar();
        $responseObj = new stdclass();
        $responseObj->resultado = $resultado;
        $responseObj->tarea = "modificar";
        return $response->withJson($responseObj, 200);
    }

    public static function mandarleMailConfirmacionAlCliente_v2($email)
    {
        $rta = cliente::email2Cliente($email)[0];
        if ($rta != null) {
            $dni = $rta->dni;

            $str = "<html><body>Estimadx " . $rta->nombre_completo . ".<br>Para habilitar su usuario de restoApp haga click en el siguiente link:\r\n\r\n\r\n";
            $str .= '<a href="pixeloide.com/restoApp/API/cliente/habilitar/' . $email . '/' . $dni . '">Habilitar Usuario</a>';
            $str .= "</body></html>";

            //   echo $str;
            $headers = "From: no-reply@restoApp.com.ar"  . "\r\n" .    "Reply-To:  no-reply@restoApp.com.ar" . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $mando = mail($email, "confirmación restoApp", $str, $headers);
            // echo "<br>mando?= ".$mando;
            return $mando;
        } else {
            return false;
        }
    }

    public static function mandarleMailConfirmacionAlCliente($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $sql = "select * from clientes where id_cliente=$id";
        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->execute();
        //  echo $sql;
        $rta = $consulta->fetchAll(PDO::FETCH_CLASS, "stdClass");
        $email = $rta[0]->email;
        $dni = $rta[0]->dni;

        $str = "<html><body>Estimadx " . $rta[0]->nombre_completo . ".<br>Para habilitar su usuario de restoApp haga click en el siguiente link:\r\n\r\n\r\n";
        $str .= '<a href="pixeloide.com/restoApp/API/cliente/habilitar/' . $email . '/' . $dni . '">Habilitar Usuario</a>';
        $str .= "</body></html>";

        //   echo $str;
        $headers = "From: no-reply@restoApp.com.ar"  . "\r\n" .    "Reply-To:  no-reply@restoApp.com.ar" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $mando = mail($email, "confirmación restoApp", $str, $headers);
        // echo "<br>mando?= ".$mando;
        return $mando;
    }

    public static function habilitarUsuario($request, $response, $args)
    {
        //LOS CLIENTES QUEDAN REGISTRADOS PERO CON EL CAMPO HABILITADO=0
        //ESTO LOS PONE EN 1
        $dni = $args["dni"];
        $email = $args["email"];

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $sql = "select * from clientes where email ='" . $email . "' and dni='" . $dni . "'";

        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->execute();
        //  echo $sql;
        $rta = $consulta->fetchAll(PDO::FETCH_CLASS, "stdClass");
        $id_cliente = $rta[0]->id_cliente;

        $consulta = $objetoAccesoDato->RetornarConsulta("update clientes set habilitado=1 where id_cliente='$id_cliente'");
        $consulta->execute();

        echo "El cliente se dio de alta exitosamente.";
    }

    public function BorrarCliente($request, $response, $args)
    {
        $vCliente = new cliente();
        $vId = $args['id'];
        $var = cliente::TraerUno($vId);

        if ($var != null) {

            $vCliente = $var[0];

            $cantidadDeBorrados = $vCliente->BorrarUno();

            $objDelaRespuesta = new stdclass();
            $objDelaRespuesta->cantidad = $cantidadDeBorrados;

            if ($cantidadDeBorrados == 1) $objDelaRespuesta->resultado = "Se borró un elemento!!!";

            elseif ($cantidadDeBorrados > 1) $objDelaRespuesta->resultado = "Se borró más de un elemento!!!";

            elseif ($cantidadDeBorrados < 1) $objDelaRespuesta->resultado = "No se borró ningún elemento!!!";

            $newResponse = $response->withJson($objDelaRespuesta, 200);
            return $newResponse;
        } else {

            return "No existe ningún elemento con ese código";
        }
    }

    public function LoginCliente($request, $response, $args)
    {
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->itsOK = false;
        $objDelaRespuesta->mensaje = "El cliente no existe";
        $vector = $request->getParsedBody();
        //print_r($vector);die();

        $vEmail = $vector['email'];
        $vDNI = $vector['dni'];

        $var = cliente::email2Cliente($vEmail)[0];

        if ($var != null) {
            if ($vDNI == $var->dni) {
                $objDelaRespuesta->el_cliente = new cliente();
                $objDelaRespuesta->itsOK = true;
                $objDelaRespuesta->el_cliente = $var;
                $objDelaRespuesta->token = AutentificadorJWT::CrearToken($var);
                $objDelaRespuesta->mensaje = "Login correcto";
                $newResponse = $response->withJson($objDelaRespuesta, 200);
                return $newResponse;
            } else {
                $objDelaRespuesta->mensaje = "Datos incorrectos";
            }
        }
        $newResponse = $response->withJson($objDelaRespuesta, 200);
        return $newResponse;
    }

    public function CargarClienteAnonimo($request, $response, $args)
    {
        $newResponse = $response;

        $miCliente = new cliente();
        $ArrayDeParametros = $request->getParsedBody();
        //$miCliente->id_cliente = $ArrayDeParametros['id_cliente'];
        $miCliente->nombre_completo = $ArrayDeParametros['nombre_completo'];
        $miCliente->habilitado = 1;

        $id_cliente = $miCliente->Insertar();

        if ($id_cliente != null) {

            $var = cliente::TraerUno($id_cliente)[0];

            $rta["itsOK"] = true;
            $rta["el_cliente"] = $var;
            $rta["token"] = AutentificadorJWT::CrearToken($var);
            $rta["mensaje"] = "Login correcto";
        } else {
            $rta["mensaje"] = "Hubo un error al registrarse, inténtelo de nuevo.";
        }

        return $newResponse->withJson($rta, 200);
    }

    public function LoginAnonimo($request, $response, $args)
    {
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->itsOK = false;
        $objDelaRespuesta->mensaje = "El cliente no existe";
        $vector = $request->getParsedBody();
        //print_r($vector);die();

        //$vUsuario = $vector['usuario'];  
        $vId_cliente = $vector['id_cliente'];
        $vNombre_completo = $vector['nombre_completo'];

        $var = cliente::TraerUno($vId_cliente)[0];

        if ($var != null) {
            if ($vNombre_completo == $var->nombre_completo) {
                $objDelaRespuesta->el_cliente = new cliente();
                $objDelaRespuesta->itsOK = true;
                $objDelaRespuesta->el_cliente = $var;
                $objDelaRespuesta->token = AutentificadorJWT::CrearToken($var);
                $objDelaRespuesta->mensaje = "Login correcto";
                $newResponse = $response->withJson($objDelaRespuesta, 200);
                return $newResponse;
            } else {
                $objDelaRespuesta->mensaje = "Datos incorrectos";
            }
        }
        $newResponse = $response->withJson($objDelaRespuesta, 200);
        return $newResponse;
    }
}
