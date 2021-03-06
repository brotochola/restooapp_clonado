<?php



use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);  
require_once __DIR__ . '/../composer/vendor/autoload.php';
require_once './clases/oneSignal.php';
require_once './clases/AccesoDatos.php';
require_once './clases/producto.php';
require_once './clases/productoApi.php';
require_once './clases/empleado.php';
require_once './clases/empleadoApi.php';
require_once './clases/cliente.php';
require_once './clases/clienteApi.php';
require_once './clases/mesa.php';
require_once './clases/mesaApi.php';
require_once './clases/pedidoApi.php';
require_once './clases/pedido.php';
require_once './clases/encuestaApi.php';
require_once './clases/encuesta.php';
require_once './clases/informesApi.php';
require_once './clases/reserva.php';
require_once './clases/reservaApi.php';
require_once './clases/clienteVisitaApi.php';

require_once './clases/facturacion.php';
require_once './clases/facturacionApi.php';



require_once './clases/relevo.php';
require_once './clases/relevoApi.php';

require_once './clases/AutentificadorMW.php';
require_once './clases/AutentificadorJWT.php';
require_once './clases/MWparaCORS.php';

require_once './clases/usuarioAPI.php';
require_once './clases/usuario.php';



//require_once './clases/captchaApi.php';
//require_once './clases/captcha.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

// Agregados appResto2
$app->group('/mozo', function () {

    $this->post('/estado', \mesaApi::class . ':estadoMozo');
    $this->post('/agregarPedido', \pedidoApi::class . ':CargarUnPedido');
    $this->post('/traerMisPedidos[/]', \pedido::class . ':traerMisPedidos');

    // $this->get('/entregar/{id}',\pedidoApi::class . ':EntregarPedido'); 
});

$app->group('/cocinero', function () {

    $this->post('/estado', \pedidoApi::class . ':estadoCocinero');
    $this->post('/pedidoListo', \pedidoApi::class . ':cocineroInformaPedidoListo');
});

$app->group('/admin', function () {

    $this->post('/estado', \mesaApi::class . ':estadoAdmin');

    // $this->get('/entregar/{id}',\pedidoApi::class . ':EntregarPedido');
});


$app->group('/pedidos', function () {

    $this->get('/id/{id}', \pedidoApi::class . ':TraerPedido');

    $this->get('/entregar/{id}', \pedidoApi::class . ':EntregarPedido');

    $this->get('/cancelar/{id}', \pedidoApi::class . ':CancelarPedido');
});

$app->group('/mesas', function () {

    $this->post('/habilitar', \mesaApi::class . ':HabilitarMesa');

    $this->post('/lista', \mesaApi::class . ':TraerMesas');

    $this->get('/id/{id}', \mesaApi::class . ':TraerUnaMesa');

    // $this->get('/entregar/{id}',\pedidoApi::class . ':EntregarPedido'); 
});

$app->group('/reservas', function () {

    $this->post('/metreAsignaMesaAReserva', \reservaApi::class . ':metreAsignaMesaAReserva');

    $this->post('/agregar', \reservaApi::class . ':CargarReserva');

    $this->post('/confirmar/{id}', \reservaApi::class . ':ConfirmarReserva');

    $this->get('/listado', \reservaApi::class . ':TraerReservas');

    $this->get('/listadoDeHoy', \reservaApi::class . ':TraerReservasDeHoy');

    // $this->delete('/borrar/{id}',\clienteApi::class . ':BorrarCliente');//->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');


//============================== FIN AGREGADOS APP RESTO2

$app->group('/login', function () {

    $this->post('/', \empleadoApi::class . ':TraerUnEmpleado');

    // $this->get('/get',\empleadoApi::class . ':TraerUnEmpleadoGet'); 

    // $this->get('/captcha',\captchaApi::class . ':TraerCaptchas'); 

    //  $this->get('/respuestas',\captchaApi::class . ':TraerRespuestas'); 
});

$app->group('/pedido', function () {

    //   $this->post('/modificaCantidad/{cantidad}',\pedidoApi::class . ':ModificaCantidadPedido');

    $this->get('/listadoPendientes', \pedidoApi::class . ':TraerPendientes');

    $this->get('/listado', \pedidoApi::class . ':TraerPedidos');

    $this->post('/ClientesComiendo',\pedidoApi::class . ':InformarClientesComiendo'); 

      
});


$app->group('/empleados', function () {

    // $this->post('/traerUno',\empleadoApi::class . ':TraerUnEmpleadoId'); 

    $this->post('/alta', \empleadoApi::class . ':CargarEmpleado');

    $this->post('/listar', \empleadoApi::class . ':TraerEmpleados');

    //$this->get('/listar/Excel',\empleadoApi::class . ':TraerDatosParaExportarExcel');

    $this->put('/desactivar', \empleadoApi::class . ':DesactivarUnEmpleado');

    $this->put('/activar', \empleadoApi::class . ':ActivarUnEmpleado');

    $this->post('/modificar', \empleadoApi::class . ':ModificarEmpleado');

    $this->post('/borrar', \empleadoApi::class . ':BorrarEmpleado'); //->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 
    $this->post('/guardarDataOneSignal', \oneSignal::class . ':guardarEnDBIDPush'); //->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 

    
});
//->add(\AutentificadorMW::class . ':VerificarAccesoUnico')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/AccesoClientes', function () {

    $this->post('/encuesta', \encuestaApi::class . ':CargarEncuesta');

    $this->get('/', \pedidoApi::class . ':TraerTiempoFaltante');
});

$app->group('/informes', function () {

    $this->post('/logueos', \informesApi::class . ':InformesLogueos');

    $this->post('/productos/cantidades', \informesApi::class . ':TraerProductosCantidades');

    $this->post('/ListadoPedidos', \pedidoApi::class . ':TraerPedidos');

    $this->post('/operaciones/sector', \informesApi::class . ':TareasSector');

    $this->post('/operaciones/empleado', \informesApi::class . ':TransaccionesEmpleado');

    $this->post('/operaciones/empleado/sector', \informesApi::class . ':TransaccionesEmpleadoSector');

    $this->post('/pedidos', \informesApi::class . ':PedidoMasVendido');

    $this->post('/pedidos/borrados', \informesApi::class . ':TraerPedidosEliminados');

    $this->post('/pedidos/demorados', \pedidoApi::class . ':PedidosDemorados');

    $this->post('/encuestas/mejor', \informesApi::class . ':MejorNota');

    $this->post('/encuestas/peor', \informesApi::class . ':PeorNota');

    $this->post('/encuestas/listado', \encuestaApi::class . ':TraerEncuestas');
}); //->add(\MWparaCORS::class . ':HabilitarCORSTodos');
//->add(\AutentificadorMW::class . ':VerificarAccesoInformes')->add(\MWparaCORS::class . ':HabilitarCORSTodos');


//===========Se verificaron todos los métodos usados
$app->group('/producto', function () {

    $this->post('/cargar', \productoApi::class . ':CargarProducto');

    $this->post('/listado', \productoApi::class . ':TraerProductos');

    $this->get('/consulta', \productoApi::class . ':TraerUnProducto');

    $this->get('/modifica', \productoApi::class . ':ModificarProducto');

    $this->delete('/borra', \productoApi::class . ':BorrarProducto');
}); //->add(\MWparaCORS::class . ':HabilitarCORSTodos');


$app->group('/facturacion', function () {

    $this->post('/cargar', \facturacionApi::class . ':CargarFacturacion');

    $this->post('/listado', \facturacionApi::class . ':TraerFacturaciones');
    
});



$app->group('/empleados/relevo', function () {

    $this->post('/cargar', \relevoApi::class . ':CargarRelevo');

    $this->post('/listado', \relevoApi::class . ':TraerRelevos');

});


$app->group('/cliente', function () {

    $this->post('/alta', \clienteApi::class . ':CargarCliente');

    $this->post('/login', \clienteApi::class . ':TraerUnCliente');//Revisar si lo usa el front

    $this->post('/login2', \clienteApi::class . ':LoginCliente');//Para reemplazar el anterior

    $this->post('/alta-anonimo', \clienteApi::class . ':CargarClienteAnonimo');

    $this->post('/login-anonimo', \clienteApi::class . ':LoginAnonimo');

    $this->get('/por-id/{id}', \clienteApi::class . ':TraerUnCliente');

    $this->get('/por-email/{email}', \clienteApi::class . ':TraerUnClientePorMail');

    $this->get('/listado', \clienteApi::class . ':TraerClientes');

    $this->delete('/borrar/{id}',\clienteApi::class . ':BorrarCliente');//->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 
    //ESTE TIENE Q SER GET:
    $this->get('/habilitar/{email}/{dni}[/]',\clienteApi::class . ':habilitarUsuario');//->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 
       
    $this->put('/modificar', \clienteApi::class . ':ModificarCliente');

   // $this->delete('/borrar/{id}', \clienteApi::class . ':BorrarCliente'); //->add(\MWparaCORS::class . ':HabilitarCORSTodos'); 
   
   $this->post('/estadoCliente', \clienteApi::class . ':estadoCliente');

    $this->post('/clienteSolicitaMesa', \mesaApi::class . ':clienteSolicitaMesa');
  

}); //->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/mesa', function () {

    $this->post('/alta', \mesaApi::class . ':CargarMesa');

    $this->post('/pedirCuenta', \mesaApi::class . ':pedirCuenta');

    $this->post('/cerrar', \mesaApi::class . ':cerrarMesa');
    
    $this->post('/indicarQueLaMesaEstaLibre', \mesaApi::class . ':indicarQueLaMesaEstaLibre');
    
    $this->post('/consulta', \mesaApi::class . ':TraerMesa');

    $this->post('/estado', \mesaApi::class . ':ModificarEstadoMesa_');

    $this->get('/listado', \mesaApi::class . ':TraerMesas');

    $this->post('/modificar', \mesaApi::class . ':ModificarMesa');

    $this->delete('/borrar/{id_mesa}', \mesaApi::class . ':BorraMesa')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
}); //->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/cliente-visita', function () {
    
    $this->get('/traer-todas', \clienteVisitaApi::class . ':TraerTodos');

    $this->get('/traer/{id_cliente_visita}', \clienteVisitaApi::class . ':TraerUno');

    $this->get('/traer-por-id-cliente/{id_cliente}', \clienteVisitaApi::class . ':TraerMesaPorIDCliente');
    
    $this->post('/alta', \clienteVisitaApi::class . ':CargarUno');

    $this->post('/modificar', \clienteVisitaApi::class . ':ModificarUno');

    $this->delete('/borrar/{id_cliente_visita}', \clienteVisitaApi::class . ':BorrarUno');
}); //->add(\MWparaCORS::class . ':HabilitarCORSTodos');

//->add(\AutentificadorMW::class . ':VerificarAccesoUnico')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
//localhost/resto/API/crearToken/?id_empleado=2&nombre_completo=Juan Gritz&id_rol=2&clave=1234


$app->post('/prueba', \pedido::class . ':cambiarEstadoProductoDePedidoAPI');


///CORS FÜR ALLES
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, token, Token')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->run();

?>