<?php

class ClienteVisita
{
    public $id_cliente_visita;
    public $id_cliente;
    public $id_mesa;
    public $fecha;
    public $comensales;
    public $mozo;
    public $date_created;
    public $last_modified;

    public static $table = "cliente_visita";

    public function BorrarClienteVisita()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM " . self::$table . " WHERE id_cliente_visita=:id_cliente_visita");
        $consulta->bindValue(':id_cliente_visita', $this->id_cliente_visita, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->rowCount();
    }

    public function ModificarClienteVisita()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta(
            "UPDATE " . self::$table . " SET 
            id_cliente=:id_cliente,
            id_mesa=:id_mesa,
            fecha=:fecha,
            comensales=:comensales,
            mozo=:mozo,
            date_created=:date_created,
            last_modified=:last_modified

            WHERE id_cliente_visita=:id_cliente_visita"
        );

        $consulta->bindValue(':id_cliente_visita', $this->id_cliente_visita, PDO::PARAM_INT);
        $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_INT);
        $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
        $consulta->bindValue(':comensales', $this->comensales, PDO::PARAM_INT);
        $consulta->bindValue(':mozo', $this->mozo, PDO::PARAM_INT);
        $consulta->bindValue(':date_created', $this->date_created, PDO::PARAM_STR);
        $consulta->bindValue(':last_modified', $this->last_modified, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public function InsertarClienteVisita()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta(
            "INSERT INTO " . self::$table . " (
            id_cliente,
            id_mesa,
            fecha,
            comensales,
            mozo,
            date_created,
            last_modified
            ) values (
            :id_cliente,
            :id_mesa,
            :fecha,
            :comensales,
            :mozo,
            :date_created,
            :last_modified
            )"
        );

        $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_INT);
        $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
        $consulta->bindValue(':comensales', $this->comensales, PDO::PARAM_INT);
        $consulta->bindValue(':mozo', $this->mozo, PDO::PARAM_INT);
        $consulta->bindValue(':date_created', $this->date_created, PDO::PARAM_STR);
        $consulta->bindValue(':last_modified', $this->last_modified, PDO::PARAM_STR);

        $consulta->execute();

        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function GuardarClienteVisita()
    {
        if (empty(ClienteVisita::TraerUnClienteVisita($this->fecha))) {
            $this->InsertarClienteVisita();
            echo "ClienteVisita guardado";
        } else {
            $elClienteVisita = ClienteVisita::TraerUnClienteVisita($this->fecha);
            $this->id_cliente_visita = $elClienteVisita->id_cliente_visita;

            if ($this->ModificarClienteVisita()) {
                echo "ClienteVisita modificado";
            } else {
                echo "No modifico el clienteVisita";
            }
        }
    }

    public static function TraerTodosLosClienteVisitas()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM " . self::$table);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "ClienteVisita");
    }

    public static function TraerUnClienteVisita($id_cliente_visita)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM " . self::$table . " WHERE id_cliente_visita = :id_cliente_visita");
        $consulta->bindValue(':id_cliente_visita', $id_cliente_visita, PDO::PARAM_INT);
        $consulta->execute();
        $ClienteVisitaBuscado = $consulta->fetchObject('ClienteVisita');

        return $ClienteVisitaBuscado;
    }

    public static function TraerPorID_Cliente($id_cliente)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM `cliente_visita` WHERE `id_mesa` IN (SELECT `id_mesa` FROM `mesas` WHERE `estado_mesa` != 6) AND `id_cliente` = :id_cliente ORDER BY`date_created` DESC LIMIT 1");
        $consulta->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $consulta->execute();
        $ClienteVisitaBuscado = $consulta->fetchObject('ClienteVisita');

        return $ClienteVisitaBuscado;
    }

    public static function TraerUnClienteVisitaPorUniqueKey($key, $param)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM " . self::$table . " WHERE " . $key . " = :" . $key);

        if (is_string($param)) {
            $consulta->bindValue(':' . $key . '', $param, PDO::PARAM_STR);
        }

        if (is_numeric($param)) {
            $consulta->bindValue(':' . $key . '', $param, PDO::PARAM_INT);
        }

        $consulta->execute();
        $ClienteVisitaBuscado = $consulta->fetchObject('ClienteVisita');

        return $ClienteVisitaBuscado;
    }

    public static function BorrarClienteVisitaPorId_clienteVisita($id_cliente_visita)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM " . self::$table . " WHERE id_cliente_visita=:id_cliente_visita");
        $consulta->bindValue(':id_cliente_visita', $id_cliente_visita, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->rowCount();
    }
}
