<?php

require_once 'AccesoDatos.php';

class comanda
{
    public $id_comanda;
    public $id_mesa;
    public $id_mozo;
    public $id_estado_pedido;
    public $fecha_alta;
    public $fecha_estipulada;
    public $fecha_entrega;
    public $foto_mesa;
    public $total;
    public $id_cliente;

        public function __construct() {}  

        public function Insertar()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into comandas 
                  (id_comanda,id_mesa,id_mozo,id_estado_pedido,fecha_alta,fecha_estipulada,fecha_entrega,total,foto_mesa,id_cliente)
            values(:id_comanda,:id_mesa,:id_mozo,:id_estado_pedido,:fecha_alta,:fecha_estipulada,:fecha_entrega,:total,:foto_mesa,:id_cliente)");

            $consulta->bindValue(':id_comanda', $this->id_comanda, PDO::PARAM_STR);
            $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':id_mozo', $this->id_mozo, PDO::PARAM_STR);
            $consulta->bindValue(':id_estado_pedido', $this->id_estado_pedido, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_alta', $this->fecha_alta, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_estipulada', $this->fecha_estipulada, PDO::PARAM_STR);            
            $consulta->bindValue(':fecha_entrega', $this->fecha_entrega, PDO::PARAM_STR);
            $consulta->bindValue(':foto_mesa', $this->foto_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
            $consulta->bindValue(':total', $this->total, PDO::PARAM_STR);
            
            $consulta->execute();		
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public static function TraerTodasLasComandas()
        {
            $consulta = "SELECT * FROM `comandas`";
            return AccesoDatos::ConsultaDatosAsociados($consulta); 
        }

        public static function TraerUna($vId)
        {   
            $consulta = "SELECT * FROM `comandas` WHERE  `id_comanda` = '$vId'";         
            return AccesoDatos::ConsultaClase($consulta,"comanda");
        }

        public static function TraerComandaMesa($vId)
        {   
            $consulta = "SELECT * FROM `comandas` WHERE  `id_mesa` = '$vId' ORDER BY fecha_alta DESC LIMIT 1";
            return AccesoDatos::ConsultaClase($consulta,"comanda");
        }
        
        public static function TraerUltima()
        {
            $consulta = "SELECT * FROM `comandas` ORDER BY `id_comanda` DESC LIMIT 1";            
            return AccesoDatos::ConsultaClase($consulta,"comanda");
        }       

        public static function MesaMasUsada()
        {   
            $consulta = "SELECT id_mesa, COUNT(*) as repeticiones FROM `comandas` GROUP BY `id_mesa` ORDER BY repeticiones DESC";
            return AccesoDatos::ConsultaDatosAsociados($consulta);    
        }

        
        public static function MesaMenosUsada()
        {   
            $consulta = "SELECT id_mesa, COUNT(*) as repeticiones FROM `comandas` GROUP BY `id_mesa` ORDER BY repeticiones";            
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function MayorFacturacion()
        {   
            $consulta = "SELECT id_mesa,SUM(total) as facturacion FROM `comandas` GROUP BY `id_mesa` ORDER BY facturacion DESC LIMIT 1";            
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function MenorFacturacion()
        {   
            $consulta = "SELECT id_mesa,SUM(total) as facturacion FROM `comandas` GROUP BY `id_mesa` ORDER BY facturacion LIMIT 1";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function FacturacionMasAlta()
        {
            $consulta = "SELECT id_mesa, fecha_alta as fecha, total as facturacion FROM `comandas` ORDER BY facturacion DESC LIMIT 1";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function FacturacionMasBaja()
        {
            $consulta = "SELECT id_mesa, fecha_alta as fecha, total as facturacion FROM `comandas` ORDER BY facturacion LIMIT 1";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function FacturacionFecha($mesa,$desde,$hasta)
        {   
            $consulta = "SELECT id_mesa, fecha_alta as fecha, SUM(total) as facturacion FROM `comandas` WHERE  `id_mesa` = '$mesa' AND fecha_alta BETWEEN '$desde' AND '$hasta' GROUP BY `id_mesa`";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        #used
        public static function AsignaId()
        {            
            $var = self::TraerUltima();
            $ultima = $var[0];
            $x = $ultima->id_comanda;
            $x++; 
            return $x;      
            
        }        
        
  
        #
        public function ModificarUna()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update comandas
                set 
                id_mozo ='$this->id_mozo',
                id_estado_pedido ='$this->id_estado_pedido'               
                WHERE id_comanda = '$this->id_comanda'");
           return $consulta->execute();

        }

        #used
        public function BorrarUna()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
            delete 
            from comandas 				
            WHERE id_comanda =:id_comanda");	
            $consulta->bindValue(':id_comanda',$this->id_comanda, PDO::PARAM_INT);		
            $consulta->execute();
            return $consulta->rowCount();
        }
          // public static function ConsultaComanda($consulta)
        // {
        //     $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        //     $consulta =$objetoAccesoDato->RetornarConsulta($consulta);
        //     $consulta->execute();      
        //     $consulta->setFetchMode(PDO::FETCH_CLASS,"comanda"); 
        //     return $consulta->fetchAll();
        // }
        
        // public static function ConsultaDatosAsociados($consulta)
        // {
        //     $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        //     $consulta =$objetoAccesoDato->RetornarConsulta($consulta);
        //     $consulta->execute();      
        //     $consulta->setFetchMode(PDO::FETCH_ASSOC);
        //     return $consulta->fetchAll();
        // }
}


?>
