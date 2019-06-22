<?php

require_once 'AccesoDatos.php';

class empleado
{
    public $id_empleado;
    public $usuario;
    public $nombre_completo;
    public $fecha_nac;
    public $dni;
    public $id_rol;
    public $fecha_ingreso;
    public $fecha_egreso;
    public $sueldo;
    public $habilitado;
    public $clave;
    public $email;
    public $foto;

        public function __construct() {} 

	    public function InsertarPrueba($id_empleado,$usuario,$clave)
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleados 
            (id_empleado, usuario, clave)
            values(:id_empleado,:usuario,:clave)");

            $consulta->bindValue(':id_empleado', $id_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);            
            
            $consulta->execute();	           
            return $consulta->rowCount();
        }
 

        public function Insertar()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleados 
            (id_empleado, email, nombre_completo,fecha_nac,dni,id_rol,fecha_ingreso,fecha_egreso,sueldo,clave,habilitado,foto)
            values(:id_empleado,:email,:nombre_completo,:fecha_nac,:dni,:id_rol,:fecha_ingreso,:fecha_egreso,:sueldo,:clave,:habilitado,:foto)");

            $consulta->bindValue(':id_empleado', $this->id_empleado, PDO::PARAM_STR);            
            $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
            $consulta->bindValue(':nombre_completo', $this->nombre_completo, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_nac', $this->fecha_nac, PDO::PARAM_STR);
            $consulta->bindValue(':dni', $this->dni, PDO::PARAM_STR);
            $consulta->bindValue(':id_rol', $this->id_rol, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_ingreso', $this->fecha_ingreso, PDO::PARAM_STR);
            $consulta->bindValue(':habilitado', $this->habilitado, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_egreso', $this->fecha_egreso, PDO::PARAM_STR);
            $consulta->bindValue(':sueldo', $this->sueldo, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);            
            $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
            
            $consulta->execute();	           
            return $consulta->rowCount();
        }
        
        public static function TraerTodoLosEmpleados()
        {            
            $consulta =  "SELECT `id_empleado`,`usuario`, `email`, `dni`,`clave`, `nombre_completo`, `fecha_nac`, `id_rol`, `fecha_ingreso`,`sueldo`,`fecha_egreso`,`habilitado` FROM `empleados`";
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function TraerUsuario($pUsuario,$pClave)
        {    
            $consulta = "SELECT * FROM `empleados` WHERE  `usuario` = '$pUsuario' AND `clave`='$pClave'";            
            return AccesoDatos::ConsultaClase($consulta, "empleado");    
        }

        public static function TraerUnoUsuarioClave($vUsuario,$vClave){        
            
            $consulta = "SELECT * FROM `empleados` WHERE  `usuario` = '$vUsuario' AND `clave`='$vClave'";            
            return AccesoDatos::ConsultaClase($consulta, "empleado");    
        }

        public static function TraerUnoEmailClave($vEmail,$vClave){        
            
            $consulta = "SELECT * FROM `empleados` WHERE  `email` = '$vEmail' AND `clave`='$vClave'";            
            return AccesoDatos::ConsultaClase($consulta, "empleado");    
        }

        public static function TraerUno($vId,$vClave)
        {   
            $consulta = "SELECT * FROM `empleados` WHERE  `id_empleado` = '$vId' AND `clave`='$vClave'";            
            return AccesoDatos::ConsultaClase($consulta, "empleado");    
        }

        public static function TraerUnoId($vId)
        {   
            $consulta = "SELECT * FROM `empleados` WHERE  `id_empleado` = '$vId'";            
            return AccesoDatos::ConsultaClase($consulta, "empleado");    
        }

	public static function TraerUltimoIdEmpleado()
        {   
            $consulta = "SELECT `id_empleado` FROM `empleados` ORDER BY `id_empleado` DESC LIMIT 1";            
            return AccesoDatos::ConsultaDatosAsociados($consulta);
        }

        public static function TraerUnoUsuario($pUsuario)
        {     
            $consulta = "SELECT * FROM `empleados` WHERE  `usuario` = '$pUsuario'";            
            return AccesoDatos::ConsultaClase($consulta, "empleado");            
        }

        public static function TraerUnoEmail($pEmail)
        {     
            $consulta = "SELECT * FROM `empleados` WHERE  `email` = '$pEmail'";            
            return AccesoDatos::ConsultaClase($consulta, "empleado");            
        }

        public function ModificarUno()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $sql="
            update empleados
            set                 
            nombre_completo ='$this->nombre_completo',
            id_rol ='$this->id_rol',
            email ='$this->email',
            usuario ='$this->usuario',
            dni ='$this->dni',
            sueldo ='$this->sueldo',                
            clave ='$this->clave',
            habilitado ='$this->habilitado'
            WHERE id_empleado = '$this->id_empleado'";
            
            $consulta =$objetoAccesoDato->RetornarConsulta($sql);

            return $consulta->execute();
        }
       
        public function BorrarUno()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
            delete 
            from empleados 				
            WHERE id_empleado =:id_empleado");	
            $consulta->bindValue(':id_empleado',$this->id_empleado, PDO::PARAM_INT);		
            $consulta->execute();
            return $consulta->rowCount();
        }
}

        //    public static function TraerUsuario($pUsuario,$pClave){
            
        //         $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        //         $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `empleados` WHERE  `usuario` = '$pUsuario' AND `clave`='$pClave'");
        //         $consulta->execute();      
        //         $consulta->setFetchMode(PDO::FETCH_CLASS,"empleado"); 
        //         return $consulta->fetchAll();

        //     }
    
        // public static function TraerUnoUsuarioClave($vUsuario,$vClave){
            
        //     $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        //     $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `empleados` WHERE  `usuario` = '$vUsuario' AND `clave`='$vClave'");
        //     $consulta->execute();      
        //     $consulta->setFetchMode(PDO::FETCH_CLASS,"empleado"); 
        //     return $consulta->fetchAll();

        // }

        
        // public static function TraerUno($vId,$vClave){
            
        //     $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        //     $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `empleados` WHERE  `id_empleado` = '$vId' AND `clave`='$vClave'");
        //     $consulta->execute();      
        //     $consulta->setFetchMode(PDO::FETCH_CLASS,"empleado"); 
        //     return $consulta->fetchAll();
        // }

    
        // public static function ConsultaEmpleado($consulta){               

        //     $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        //     $consulta =$objetoAccesoDato->RetornarConsulta($consulta);
        //     $consulta->execute();      
        //     $consulta->setFetchMode(PDO::FETCH_CLASS,"empleado"); 
        //     return $consulta->fetchAll();
        // }


        // public static function TraerUnoSector($vId)
        // {     
        //     $unEmpleado = new empleado();
        //     $var = self::TraerUnoId($vId);
        //     $unEmpleado = $var[0];
        // }



?>


