<?php

require_once 'AccesoDatos.php';

class reserva
{
    public $id;
    public $id_cliente;
    public $id_mesa;
    public $fecha;
    public $confirmada;
    public $fecha_alta;
    public $comensales;
    
    
    public function __construct() {}

        public function Insertar()
        {                      
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into reservas(id_cliente, id_mesa, fecha, fecha_alta, comensales)
            values(:id_cliente, :id_mesa, :fecha, :fecha_alta, :comensales)");
            $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
            $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_alta', $this->fecha_alta, PDO::PARAM_STR);
            $consulta->bindValue(':comensales', $this->comensales, PDO::PARAM_STR);
            $consulta->execute();		

            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public static function TraerTodos()
        {
            $consulta = "SELECT reservas.*, clientes.nombre_completo, clientes.foto FROM reservas, clientes where reservas.id_cliente=clientes.id_cliente";
            return AccesoDatos::ConsultaClase($consulta,"stdClass");
        }
        public static function TraerTodosDeHoy()
        {
            $consulta = "SELECT reservas.*, clientes.nombre_completo, clientes.foto FROM reservas, clientes where reservas.id_cliente=clientes.id_cliente 
            AND    reservas.fecha  <  DATE_ADD(now(), INTERVAL 8 HOUR)
            AND    reservas.confirmada=0
            and reservas.fecha_alta > DATE_SUB(now(), INTERVAL 24 HOUR)
            order by reservas.fecha desc";
            return AccesoDatos::ConsultaClase($consulta,"stdClass");
        }
        public static function TraerUno($vId)
        {             
            $consulta = "SELECT * FROM `reservas` WHERE  `id` = '$vId'";
            return AccesoDatos::ConsultaClase($consulta,"stdClass");
        }

        public function Confirmar($vId)
        {
            $estado = 1;

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update reservas set
                confirmada ='$estado'
                WHERE id ='$vId'");
            return $consulta->execute();    
        }

        public static function TraerIDsMesasLibresConXComensales($comensales)
        {             
            $consulta = 'SELECT `id_mesa` FROM `mesas` WHERE `estado_mesa` = 0 AND `sillas` BETWEEN '.$comensales.' AND '.$comensales+1;

            return AccesoDatos::ConsultaClase($consulta,"stdClass");
        }

        public static function TraerCantidadDeReservasPara1HrConXComensales($comensales)
        {             
            $consulta = 'SELECT * FROM `reservas` WHERE `fecha` < DATE_ADD(now(), INTERVAL 1 HOUR) AND fecha > DATE_SUB(now(), INTERVAL 20 MINUTE) AND `confirmada` = 0 AND comensales BETWEEN '.$comensales.' AND '.$comensales+1;

            return AccesoDatos::ConsultaClase($consulta,"stdClass");
        }

        // public function BorrarUno()
        // {
        //     $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        //     $consulta =$objetoAccesoDato->RetornarConsulta("
        //     delete 
        //     from clientes 				
        //     WHERE id_cliente =:id_cliente");	
        //     $consulta->bindValue(':id_cliente',$this->id_cliente, PDO::PARAM_INT);		
        //     $consulta->execute();
        //     return $consulta->rowCount();
        // }
}

?>