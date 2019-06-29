<?php

require_once 'AccesoDatos.php';

class relevo
{
    public $id;
    public $id_empleado;
    public $id_sector;
    public $fecha;
    public $limpieza;
    public $orden;
    public $stock;
    public $residuos;
    public $puntualidad;
    public $foto;


    public function __construct()
    { }

    public function Insertar()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $sql = "INSERT into empleados_relevo(id_empleado,   limpieza, orden, stock, residuos, puntualidad, foto)
        values('$this->id_empleado','$this->limpieza','$this->orden','$this->stock','$this->residuos','$this->puntualidad','$this->foto')";

        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function TraerTodos()
    {
        $consulta = "SELECT * FROM `empleados_relevo`";
        return AccesoDatos::ConsultaClase($consulta, "empleados_relevo");
    }
}
