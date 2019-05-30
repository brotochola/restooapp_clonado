<?php
class AccesoDatos
{
    private static $ObjetoAccesoDatos;
    public $objetoPDO;

    public static $url="localhost";
    public static $dbname="opticabaires";
    public static $user="root";
   // public static $pass="Pepwm0ga";
    public static $pass="";
 
    private function __construct()
    {
        try { 
            $this->objetoPDO = new PDO('mysql:host='.self::$url.';dbname='.self::$dbname.';charset=utf8', self::$user, self::$pass, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
            } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }
 
    public function RetornarConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }
     public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
 
    public  function filasAfectadas(){
        return $this->objetoPDO->rowCount();
    }

    public static function dameUnObjetoAcceso()
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new AccesoDatos(); 
        } 
        return self::$ObjetoAccesoDatos;        
    }
 
 
     // Evita que el objeto se pueda clonar
    public function __clone()
    { 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }
}
?>