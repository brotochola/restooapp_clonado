<?php

require_once 'AccesoDatos.php';



class mesa
{
    public $id_mesa;
    public $zona;
    public $estado_mesa;

    public function __construct() {}

        //=============AGREGADOS APP RESTO2

        public static function CargarClienteVisita($vIdMesa, $vIdCliente, $vFecha, $vComensales, $idmozo)
        {                      
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            
            
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into cliente_visita (id_mesa, id_cliente, fecha, comensales, mozo)
            values(:id_mesa,:id_cliente,:fecha,:comensales, :mozo)");
            $consulta->bindValue(':id_mesa', $vIdMesa, PDO::PARAM_STR);
            $consulta->bindValue(':id_cliente',$vIdCliente,PDO::PARAM_STR);
            $consulta->bindValue(':fecha',$vFecha,PDO::PARAM_STR);
            $consulta->bindValue(':comensales',$vComensales,PDO::PARAM_STR);
            $consulta->bindValue(':mozo',$idmozo,PDO::PARAM_STR);
            $consulta->execute();		

            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public static function CambiarEstadoMesa($id_mesa, $estado_mesa)
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas SET estado_mesa=:estado_mesa WHERE id_mesa=:id_mesa");
            $consulta->bindValue(':estado_mesa', $estado_mesa, PDO::PARAM_INT);
            $consulta->bindValue(':id_mesa', $id_mesa, PDO::PARAM_INT);
            $consulta->execute();
    
            return $consulta->rowCount();
        }

        public static function ModificarEstadoDeLaMesa($idMesa, $vEstado)
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

            $consulta="
            update mesas
            set 
            estado_mesa ='$vEstado'
            WHERE id_mesa ='$idMesa'";
      
            $consulta =$objetoAccesoDato->RetornarConsulta($consulta);
            return $consulta->execute();    
        }

        public static function TraerLaMesa($vId)
        {
            $consulta = "SELECT * FROM `mesas`  WHERE  `id_mesa` = '$vId'";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function TraerClienteVisita($vId)
        {
            $consulta = "SELECT * FROM `cliente_visita`  WHERE  `id_mesa` = '".$vId."' order by date_created desc limit 1";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function TraerTodas()
        {
            $consulta = "SELECT * FROM `mesas`";
            return AccesoDatos::ConsultaClase($consulta, "mesa");
        }

        //=============FIN AGREGADOS APP RESTO2
        
        public function Insertar()
        {                      
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into mesas (zona, sillas, habilitada)values(:zona,:sillas, 1)");
          
            $consulta->bindValue(':zona', $this->zona, PDO::PARAM_STR);
            $consulta->bindValue(':sillas', $this->sillas, PDO::PARAM_STR);
            
            $consulta->execute();		

            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public static function TraerTodos()
        {
            $consulta = "SELECT * FROM `mesas`";
            return AccesoDatos::ConsultaClase($consulta, "mesa");
        }
        
        public static function TraerUno($vId)
        {
            $consulta = "SELECT * FROM `mesas` WHERE  `id_mesa` = '$vId'";
            return AccesoDatos::ConsultaClase($consulta, "mesa");
        }

        public function Modificar()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update mesas
                set id_sector ='$this->id_sector',
                id_estado_mesa ='$this->id_estado_mesa'
                WHERE id_mesa ='$this->id_mesa'");
            return $consulta->execute();
    
        }

        public function Cerrar()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update mesas
                id_estado_mesa = 4
                WHERE id_mesa ='$this->id_mesa'");
            return $consulta->execute();
    
        }

        public function Borrar()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
            delete 
            from mesas 				
            WHERE id_mesa =:id_mesa");	
            $consulta->bindValue(':id_mesa',$this->id_mesa, PDO::PARAM_INT);		
            $consulta->execute();
            return $consulta->rowCount();
        }
}

?>