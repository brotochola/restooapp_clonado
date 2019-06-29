<?php

require_once 'AccesoDatos.php';


class facturacion
{
    public $id;
    public $id_mesa;
    public $total_mesa;
    public $porcentaje_propina;
    public $id_mozo;
    public $satisfaccion;
    

    public function __construct() {}

        public function Insertar()
        {
           
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta(
            "INSERT into facturacion(id_mesa,total_mesa,porcentaje_propina,id_mozo,satisfaccion)
            values(:id_mesa,:total_mesa,:porcentaje_propina,:id_mozo,:satisfaccion)");
            
            $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':total_mesa', $this->total_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':porcentaje_propina', $this->porcentaje_propina, PDO::PARAM_STR);
            $consulta->bindValue(':id_mozo', $this->id_mozo, PDO::PARAM_STR);
            $consulta->bindValue(':satisfaccion', $this->satisfaccion,PDO::PARAM_STR);                       
            $consulta->execute();		
            
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
        
        
        public static function TraerUno($vId)
        {
            $consulta = "SELECT * FROM `facturacion` WHERE  `id` = '$vId'";            
            return AccesoDatos::ConsultaClase($consulta, "facturacion");
        }

        public static function TraerTodos()
        {            
            $consulta = "SELECT * FROM `facturacion`";
            return AccesoDatos::ConsultaClase($consulta, "facturacion");
        }
}


?>
