<?php

require_once 'AccesoDatos.php';

class cliente
{
    public $id_cliente;
    public $nombre_completo;
    public $dni;
    public $email;
    public $foto;
    
    public function __construct() {}

        public function Insertar()
        {                      
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $sql="INSERT into clientes( nombre_completo, dni, email, foto) values('$this->nombre_completo', '$this->dni','$this->email', '$this->foto')";

            $consulta =$objetoAccesoDato->RetornarConsulta($sql);
            

            $consulta->execute();		

            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public static function TraerTodos()
        {
            $consulta = "SELECT * FROM `clientes`";
            return AccesoDatos::ConsultaClase($consulta,"cliente");
        }

        public static function email2Cliente($email)
        {             
            $consulta = "SELECT * FROM `clientes` WHERE  `email` = '$email'";
            return AccesoDatos::ConsultaClase($consulta,"cliente");
        }

        public static function TraerUno($vIdCliente)
        {             
            $consulta = "SELECT * FROM `clientes` WHERE  `id_cliente` = '$vIdCliente'";
            return AccesoDatos::ConsultaClase($consulta,"cliente");
        }

        public function Modificar()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update clientes set
                nombre_completo ='$this->nombre_completo'
                WHERE id_cliente ='$this->id_cliente'");
            return $consulta->execute();    
        }

        public function BorrarUno()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
            delete 
            from clientes 				
            WHERE id_cliente =:id_cliente");	
            $consulta->bindValue(':id_cliente',$this->id_cliente, PDO::PARAM_INT);		
            $consulta->execute();
            return $consulta->rowCount();
        }

        public static function cantVisitasCliente($id) 
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("select * from cliente_visita where id_cliente =".$id);	
           
            $consulta->execute();   
            
          
            return   $consulta->rowCount();
        }
}

?>