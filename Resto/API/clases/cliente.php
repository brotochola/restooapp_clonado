<?php

class Cliente
{
    public $id_cliente; //Obligatorio
    public $nombre_completo; //Obligatorio
    public $dni; //Único
    public $email; //Único
    public $clave;
    public $foto; //Obligatorio

    public static $table = "clientes_";

    public function BorrarCliente()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM " . self::$table . " WHERE id_cliente=:id_cliente");
        $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->rowCount();
    }

    public function ModificarCliente()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta(
            "UPDATE " . self::$table . " SET 
            nombre_completo=:nombre_completo,
            dni=:dni,
            email=:email,
            clave=:clave,
            foto=:foto

            WHERE id_cliente=:id_cliente"
        );

        $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $consulta->bindValue(':nombre_completo', $this->nombre_completo, PDO::PARAM_STR);
        $consulta->bindValue(':dni', $this->dni, PDO::PARAM_INT);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public function InsertarCliente()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta(
            "INSERT INTO " . self::$table . " (
            dni,
            nombre_completo,
            email,
            clave,
            foto
            ) values (
            :dni,
            :nombre_completo,
            :email,
            :clave,
            :foto
            )"
        );

        $consulta->bindValue(':nombre_completo', $this->nombre_completo, PDO::PARAM_STR);
        $consulta->bindValue(':dni', $this->dni, PDO::PARAM_INT);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);

        $consulta->execute();

        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function GuardarCliente()
    {
        if (empty(Cliente::TraerUnCliente($this->email))) {
            $this->InsertarCliente();
            echo "Cliente guardado";
        } else {
            $elCliente = Cliente::TraerUnCliente($this->email);
            $this->id_cliente = $elCliente->id_cliente;

            if ($this->ModificarCliente()) {
                echo "Cliente modificado";
            } else {
                echo "No modifico el cliente";
            }
        }
    }

    public static function TraerTodosLosClientes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM " . self::$table);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "Cliente");
    }

    public static function TraerUnCliente($id_cliente)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM " . self::$table . " WHERE id_cliente = :id_cliente");
        $consulta->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $consulta->execute();
        $ClienteBuscado = $consulta->fetchObject('Cliente');

        return $ClienteBuscado;
    }

    public static function TraerUnClientePorUniqueKey($key, $param)
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
        $ClienteBuscado = $consulta->fetchObject('Cliente');

        return $ClienteBuscado;
    }

    public static function BorrarClientePorId_cliente($id_cliente)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM " . self::$table . " WHERE id_cliente=:id_cliente");
        $consulta->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->rowCount();
    }
}
