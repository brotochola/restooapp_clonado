<?php

require_once 'AccesoDatos.php';

class encuesta
{
    public $id_encuesta;
    public $id_comanda;
    public $nota_restaurante;
    public $nota_mesa;
    public $nota_mozo;
    public $nota_cocinero;
    public $comentario;

    public function __construct() {}

        public function Insertar()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into encuestas(id_comanda, nota_restaurante, nota_mesa, nota_mozo, nota_cocinero,comentario)
            values(:id_comanda,:nota_restaurante,:nota_mesa,:nota_mozo,:nota_cocinero,:comentario)");
            $consulta->bindValue(':id_comanda', $this->id_comanda, PDO::PARAM_STR);
            $consulta->bindValue(':nota_restaurante', $this->nota_restaurante, PDO::PARAM_STR);
            $consulta->bindValue(':nota_mesa', $this->nota_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':nota_mozo', $this->nota_mozo, PDO::PARAM_STR);
            $consulta->bindValue(':nota_cocinero', $this->nota_cocinero,PDO::PARAM_STR);
            $consulta->bindValue(':comentario', $this->comentario,PDO::PARAM_STR);
            $consulta->execute();		
            
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public static function TraerTodas()
        {            
            $consulta = "SELECT * FROM `encuestas`";            
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }
}

?>
