<?php

require_once 'AccesoDatos.php';
require_once 'comanda.php';
require_once 'logueo.php';
require_once 'pedido.php';

class comandaApi extends comanda
{    

    public function CargarComanda($request, $response,$args){

        $obj = new stdclass();
        $obj->respuesta="";
        $obj->itsOk = FALSE;

        $vPedido = new pedido();
        $vHora = new DateTime();
        $com = new comanda();
        $vector = $request->getParsedBody(); 
        
        if ((!isset($_POST['cantidades']) || empty($_POST['cantidades'])) || (!isset($_POST['pedidos']) || empty($_POST['pedidos'])) || (!isset($_POST['id_mesa']) || empty($_POST['id_mesa'])) || (!isset($_POST['id_cliente']) || empty($_POST['id_cliente']))) 
		{
			
			$obj->respuesta="Favor ingresar datos obligatorios";		
			$nueva=$response->withJson($obj, 401); 
			return $nueva;
		
		}
		else{
                     
            $com->id_mesa = $vector['id_mesa'];
            $com->id_cliente = $vector['id_cliente'];             
            $pedidos = explode(',',$vector['pedidos']);  
            $cantidades = explode(',', $vector['cantidades']);        
			$com->id_mozo = $vector['id_mozo'];

            if(count($pedidos) != count($cantidades))
            {
                $obj->respuesta="Las cantidades y pedidos deben coincidir";
            }
            else
            {                  

                    try{
                        
                        $var = mesa::TraerUno($com->id_mesa); 
                        if($var != null)
                        {

                            $mesa = new mesa();
                            $mesa = $var[0];                    
                            if($mesa->id_estado_mesa == 4)
                            {

                                try
                                {    
                                    //$arrayConToken = $request->getHeader('token');
                                   /// $token = $arrayConToken[0];
                                    ///$payload=AutentificadorJWT::ObtenerData($token);
                                   /// $com->id_mozo = $payload->id_empleado;    

                                    $com->id_estado_pedido = 1;      
                                    $com->fecha_alta = date_format($vHora,"Y/m/d H:i:s");
                                    $vHoraEstipulada = $vHora;
                                    date_add($vHoraEstipulada, date_interval_create_from_date_string('30 minutes'));
                                    $com->fecha_estipulada = date_format($vHoraEstipulada,"Y/m/d H:i:s");
                                    $com->id_comanda = comanda::AsignaId();
                                    
                                    if($vector['fecha_entrega'] = ""){
                                        $com->fecha_entrega = '0000-00-00';
                                    }            
                                    else{
                                        $com->fecha_entrega = $vector['fecha_entrega'];
                                    }  
                                    
                                    if(isset($_POST["foto"])  && !empty($_POST['foto']))
                                    {
                                        $destino= './Fotos/';
                                        $archivos = $request->getUploadedFiles();
                                        $nombreAnterior=$archivos['foto']->getClientFilename();
                                        $nombre = $com->id_comanda.$com->id_mesa;
                                        $extension = explode(".",$nombreAnterior);
                                        $extension = array_reverse($extension);
                                        $archivos['foto']->moveTo($destino.$nombre.".".$extension[0]);
                                        $camino = $destino.$nombre.".".$extension[0];
                                        $com->foto_mesa = $camino;

                                    }
                                    else
                                    {
                                        $com->foto_mesa = "sin foto";
                                    }  
                                    $vTotal = $vPedido->TraerPrecios($pedidos,$cantidades);                                  
                                    $com->total = $vTotal;
                                    $obj->itsOk = True; 
                                                        
                                    $com->Insertar();
                                    $vPedido = new pedido();
                                    $vPedido->CargarPedidoComanda($pedidos,$cantidades,$com->id_comanda,$com->fecha_alta);
                                    $mesa->id_estado_mesa = 1;
                                    $mesa->Modificar();
                                    logueo::InsertarTransaccion($com->id_mozo,"Alta comanda");
                                    $obj->respuesta = "Se cargo la comanda: ".$com->id_comanda;
                                    

                            }
                            catch(Exception $e) 
                            {
                                return $e->getMessage();        
                            }
                        }
                        else{

                            return $obj->respuesta="La mesa no se encuentra disponible";
                        }  //cierra try empleado
                    }//cierra mesa disponible
                    else
                    {
                        return $obj->respuesta="La mesa con ese id no existe";

                    }//cierra verifica mesa
                } //cierra try mesa         
                catch(Exception $e) 
                {            
                    return $e->getMessage();
                }
            }    
            $newResponse = $response->withJson($obj, 200);        
            return $newResponse;
        }
    }//Cierra cargar comanda

    //debe devolver el incremento de la ùltima comanda 
   


    #used
    public function TraerUnaComanda($request, $response, $args) {   
        
        $objDelaRespuesta = new stdclass();          
        $objDelaRespuesta->itsOK = false;              
       
        $vector = $request->getParsedBody();

        $vId = $vector['id_comanda'];  
        
        $var = comanda::TraerUna($vId);    
            
        if($var != null)
        {       
            $objDelaRespuesta->laComanda = new comanda();
            $objDelaRespuesta->itsOK = true;
            $objDelaRespuesta->laComanda = $var[0];
            // $id = logueo::ObtenerId($request, $response, $args);    
            // logueo::InsertarTransaccion($id,"Consulta comanda");        
        }
        else
        {
            $objDelaRespuesta->respuesta = "La comanda no existe";
        }
        return $response->withJson($objDelaRespuesta, 200);        
    }

    public function CerrarComanda($request, $response, $args)
    {
        $vector = $request->getParsedBody(); 
        $idComanda = $vector["id_comanda"];
        $resultado = pedido::TraerPedidosPorComanda($idComanda);

        return var_dump($idComanda);        
    }

    #used
    public function TraerComandas($request, $response, $args) 
    {   
        $Comandas = comanda::TraerTodasLasComandas(); 
        $id = logueo::ObtenerId($request, $response, $args);    
        logueo::InsertarTransaccion($id,"Consulta comandas");       
        $newResponse = $response->withJson($Comandas, 200);  
        return $newResponse;
    }  

    public function MesaMayorOcupacion($request, $response, $args) 
    {        
        $comandas = comanda::MesaMasUsada();
        $mesa = $comandas[0];
        $newResponse = $response->withJson($mesa, 200);  
        return $newResponse;                                     
    } 

    public function MesaMenorOcupacion($request, $response, $args)
    {        
        $comandas = comanda::MesaMenosUsada();
        $mesa = $comandas[0];
        $newResponse = $response->withJson($mesa, 200);  
        return $newResponse;                         
    }
       
    public function MesaMayorFacturacion($request, $response, $args) 
    {   
        $comandas = comanda::MayorFacturacion();
        $mesa = $comandas[0];
        $newResponse = $response->withJson($mesa, 200);  
        return $newResponse;                                     
    }
           
    public function MesaMenorFacturacion($request, $response, $args) 
    {        
        $comandas = comanda::MenorFacturacion();
        $mesa = $comandas[0];
        $newResponse = $response->withJson($mesa, 200);  
        return $newResponse;                                     
    }
   
    public function MesaFacturacionMasAlta($request, $response, $args) {
        
        $comandas = comanda::FacturacionMasAlta();
        $mesa = $comandas[0];
        $newResponse = $response->withJson($mesa, 200);  
        return $newResponse;                                     
    }

    public function MesaFacturacionMasBaja($request, $response, $args) 
    {
        $comandas = comanda::FacturacionMasBaja();
        $mesa = $comandas[0];
        $newResponse = $response->withJson($mesa, 200);  
        return $newResponse;                                     
    }
        
    public function MesaFacturacionFecha($request, $response, $args) 
    {   
        $vector = $request->getParsedBody();                           
        $mesa = $vector['id_mesa'];
        $desde = $vector['desde'];
        $hasta = $vector['hasta'];

        $comandas = comanda::FacturacionFecha($mesa,$desde,$hasta);
        
        if($comandas != null)
        {
            $mesa = $comandas[0];

            if($mesa["facturacion"] == null)
            {
                $respuesta = false;
            }
            else{
                $respuesta = $mesa["facturacion"];
            }
        }
        else{
            $respuesta = false;
        }
        return $respuesta;
       
                                         
    }

    public function TraerLaUltima($request, $response, $args) 
    {   
        $Comandas = comanda::TraerUltima();        
        $newResponse = $response->withJson($Comandas, 200);  
        return $newResponse;
    }  

    public function ModificarComanda($request, $response,$args)
    {
        $com = new comanda();
        $vector = $request->getParams('id_comanda','id_empleado','id_estado_pedido');
        //$id = logueo::ObtenerId($request, $response, $args);   

        $com->id_comanda = $vector['id_comanda'];       
        $com->id_mozo =  $vector['id_empleado'];
        $com->id_estado_pedido = $vector['id_estado_pedido'];
        
        $resultado = $com->ModificarUna();
        $responseObj= new stdclass();
        $responseObj->resultado=$resultado;
        // $responseObj->tarea = "Modificar comanda".$com->id_comanda;
        // logueo::InsertarTransaccion($id,$responseObj->tarea); 
        return $response->withJson($responseObj, 200);
       	
    }

    public function BorrarComanda($request, $response, $args) {
        
            $com = new comanda();
            $vId = $args['id'];        
            $var = comanda::TraerUna($vId);         
            
            if($var != null)
            {
                $com = $var[0];                
                $pedido = new pedido();
                $listado = pedido::TraerPedidosPorComanda($vId);

                for ($x = 0; $x <= count($listado)-1; $x++) {
                    
                    $miValor = $listado[$x]["id_producto"];
                    $otroPedido = new pedido();
                    $otroPedidoAuxiliar = pedido::TraerUnPedido($vId,$miValor);
                    $otroPedido = $otroPedidoAuxiliar[0];
                    $otroPedido->InsertarBorrado();
                }
             
                $pedido->BorrarComandaPedidos($vId);
                $cantidadDeBorrados= $com->BorrarUna();     
                $objDelaRespuesta= new stdclass();
                $objDelaRespuesta->cantidad=$cantidadDeBorrados;
                $id = logueo::ObtenerId($request, $response, $args); 
                $tarea = "Borra comanda ".$com->id_comanda;
                logueo::InsertarTransaccion($id,$tarea);
    
                if($cantidadDeBorrados == 1)$objDelaRespuesta->resultado="Se borró un elemento!!!";
                
                elseif($cantidadDeBorrados > 1) $objDelaRespuesta->resultado="Se borró más de un elemento!!!";
                
                elseif($cantidadDeBorrados < 1) $objDelaRespuesta->resultado="No se borró ningún elemento!!!";
                
                $newResponse = $response->withJson($objDelaRespuesta, 200);  
                return $newResponse; 
            }
            else{                
                return "No existe ninguna comanda con ese código";
            }
        }
}

?>
