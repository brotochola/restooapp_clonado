<?php

require_once 'AccesoDatos.php';

class captcha
{
    public $suma;
    public $respuesta;
    
    public function __construct() {}

        public static function TraerTodos()
        {
            $consulta = "SELECT `suma` FROM `captcha`";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function TraerUna($vSuma)
        {   
            $consulta = "SELECT `respuesta` FROM `captcha` WHERE  `suma` = '$vSuma'";         
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }


        // public static function TraerUno($vIdCliente)
        // {             
        //     $consulta = "SELECT * FROM `clientes` WHERE  `id_cliente` = '$vIdCliente'";
        //     return AccesoDatos::ConsultaClase($consulta,"cliente");
        // }

        // public function Modificar()
        // {
        //     $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        //     $consulta =$objetoAccesoDato->RetornarConsulta("
        //         update clientes set
        //         nombre_completo ='$this->nombre_completo'
        //         WHERE id_cliente ='$this->id_cliente'");
        //     return $consulta->execute();    
        // }

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