<?php

require_once 'AccesoDatos.php';
require_once "AutentificadorJWT.php";

class logueo
{
    public $id_empleado;
    public $fecha;
    public $tarea;

        public function __construct() {}  


        public function ObtenerId($request, $response, $args)
        {
            $arrayConToken = $request->getHeader('token');
            $token = $arrayConToken[0];
            $payload=AutentificadorJWT::ObtenerData($token);
            return $payload->id_empleado; 
        }

        public function ObtenerRol($request, $response, $args)
        {
            $arrayConToken = $request->getHeader('token');
            $token = $arrayConToken[0];
            $payload=AutentificadorJWT::ObtenerData($token);
            return $payload->id_rol; 
        }

        public function InsertarTransaccion($pId_empleado,$pTarea)
        {
            $vHora = new DateTime();
            $actual = date_format($vHora,"Y/m/d H:i:s");

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into logueos 
                  (id_empleado,fecha,tarea)values(:id_empleado,:fecha,:tarea)");

            $consulta->bindValue(':id_empleado', $pId_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':fecha', $actual, PDO::PARAM_STR);
            $consulta->bindValue(':tarea', $pTarea, PDO::PARAM_STR);
            
            $consulta->execute();		
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
       

        public static function TraerCantidadTransacciones()
        {
            $consulta = "SELECT empleados.id_rol, empleados.id_empleado,logueos.id_empleado FROM`logueos` INNER JOIN empleados ON logueos.id_empleado = empleados.id_empleado";            
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }
        
        public static function TraerTodoLosLogueos()
        {             
            $consulta = "SELECT * FROM `logueos` WHERE `tarea` = 'Logueo Usuario'";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function TraerTransaccionPorId($pId)
        {            
            $consulta = "SELECT count(*) as total from logueos WHERE id_empleado = '$pId'";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function TraerOperaciones()
        {
            $consulta =  "SELECT empleados.id_rol, empleados.id_empleado,
            logueos.id_empleado, count(logueos.id_empleado) as cantidad
            FROM empleados INNER JOIN logueos 
            ON logueos.id_empleado = empleados.id_empleado 
            GROUP BY logueos.id_empleado";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }
}
?>