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
            $consulta = "SELECT * FROM `reservas`";
            return AccesoDatos::ConsultaClase($consulta,"reserva");
        }

        public static function TraerUno($vId)
        {             
            $consulta = "SELECT * FROM `reservas` WHERE  `id` = '$vId'";
            return AccesoDatos::ConsultaClase($consulta,"reserva");
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