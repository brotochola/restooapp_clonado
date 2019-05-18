<?php

require_once 'AccesoDatos.php';

class usuario
{
    public $id;
    public $nombre;
    public $mail;
    public $perfil;
    public $clave;

        public function __construct() {} 

	    public static function Insertar($pUsuario)
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("insert into usuarios(nombre,mail,perfil,clave)
            values(:nombre,:mail,:perfil,:clave)");

	        $consulta->bindvalue(':nombre', $pUsuario->nombre,PDO::PARAM_STR);
     	    $consulta->bindvalue(':mail', $pUsuario->mail,PDO::PARAM_STR);
            $consulta->bindvalue(':clave', $pUsuario->clave,PDO::PARAM_STR);
            $consulta->bindvalue(':perfil', $pUsuario->perfil,PDO::PARAM_STR);            
    
           $consulta->execute();	           
           return $consulta->rowcount();
         }

        public static function TraerUnoMail($vId)
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `usuarios` WHERE  `mail` = '$vId'");
            $consulta->execute();      
            $consulta->setFetchMode(PDO::FETCH_CLASS,"usuario"); 
            return $consulta->fetchAll();
        }

        public static function TraerUno($vId,$vClave){
        
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `usuarios` WHERE  `mail` = '$vId' AND `clave`='$vClave'");
            $consulta->execute();      
            $consulta->setFetchMode(PDO::FETCH_CLASS,"usuario"); 
            return $consulta->fetchAll();

        }

	
 
}



?>
