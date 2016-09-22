<?php

namespace System\Core;

use \System\Core\SQL;
use \System\Core\Connection;


class Model
{
    private $sql;
    private $table;
    private $conn;

    public function __construct($table)
    {
        $this->table = $table;
        $this->sql = new SQL();
        $this->conn = Connection::get();
    }

    public function setTable($table)
    {
        if (!is_string($table)) {
            throw new \Exception("Parametro tabela inválido.");
            
            return;
        }

        $this->table = $table;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function insert($fields)
    {
        $stmt = $this->conn->prepare($sql->insert($this->getTable(), $fields));

        $i = 1;

        foreach ($fields as $value) {
            $this->stmt->bindValue($i++, $value, $this->type($value));
        }

        return $this;
    }

    public function save()
    {
        return $this->stmt->execute();
    }

    public function type($value)
    {
        switch ($value) {
            case is_integer($value):
                return \PDO::PARAM_INT;
                break;

            case is_null($value):
                return \PDO::PARAM_NULL;
                break;

            case is_bool($value):
                return \PDO::PARAM_BOOL;
                break;
            
            default:
                return \PDO::PARAM_STR;
                break;
        }
    }
}