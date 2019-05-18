<?php

require_once 'AccesoDatos.php';

class facturacion
{
  

    public function __construct() {}

        public function Insertar($mesa,$empleado,$fecha,$total)
        {                      
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into facturacion (id_mesa,id_empleado,fecha,total)values(:id_mesa,:id_empleado,:fecha,:total)");
            $consulta->bindValue(':id_mesa', $mesa, PDO::PARAM_STR);
            $consulta->bindValue(':id_empleado',$empleado PDO::PARAM_STR);
            $consulta->bindValue(':fecha',$fecha, PDO::PARAM_STR);
            $consulta->bindValue(':total',$total, PDO::PARAM_STR);
            $consulta->execute();		

            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public static function TraerTodos()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `facturacion`");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_CLASS,"facturacion");
        }

        
}


?>