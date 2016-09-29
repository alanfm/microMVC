<?php

/**
 * @package System\Core
 */
namespace System\Core;

/**
 * Classes usadas
 */
use \System\Core\SQL;
use \System\Core\ConnectionPDO;

/**
 * Classe Model
 *
 * Cria uma interface de conexão com um banco de dados
 * e abstrai seus métodos para uso mais facilitado
 *
 * @author Alan Freire <alan_freire@msn.com>
 * @copyright MIT © 2016
 * @version 1.0 [Versão inicial]
 */
class Model
{
    /**
     * Instancia da classe SQL
     * @var object
     */
    private $sql;

    /**
     * Nome da tabela do banco de dados que gerenciada
     * @var string
     */
    private $table;

    /**
     * Instancia da classe de conexão com banco de dados
     * @var object
     */
    private $conn;

    /**
     * Instancia da classe PDOStatement
     * @var object
     */
    private $stmt;

    /**
     * Caso a operação seja uma consulta
     * @var boolean
     */
    private $select = false;

    /**
     * Method __construct
     *
     * Seta as configurações iniciais para os objetos Model
     * @param string $table Nome da tabela que será gerenciada
     */
    public function __construct($table)
    {
        $this->setTable($table);
        $this->sql = new SQL();
        $this->stmt = null;
        $this->conn = new ConnectionPDO(DB_HOST, DB_DBMS, DB_NAME, DB_USER, DB_PASS);
        $this->conn = $this->conn->get();
    }

    /**
     * Method setTabela
     *
     * Seta um valor para a variável $table
     * 
     * @param string $table Nome da tabela
     */
    public function setTable($table)
    {
        if (!is_string($table)) {
            throw new \Exception(sprintf("Parametro tabela[%s] espera uma string.", $table));
        }

        $this->table = $table;
    }

    /**
     * Method getTable
     *
     * Retorna o valor da variável $table
     * 
     * @return string Nome da tabela
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Method insert
     *
     * Cria uma interface para inserção de novas
     * tuplas na tabela pre-definida
     * 
     * @param  array $fields  Campos(chave) e valores(value) a serem inseridos
     * @return object         Própria classe(objeto)
     */
    public function insert($fields)
    {
        $this->stmt = $this->conn->prepare($this->sql->insert($this->getTable(), $fields)->get());

        $i = 1;

        foreach ($fields as $value) {
            $this->stmt->bindValue($i++, $value, $this->type($value));
        }

        return $this;
    }

    public function delete($field)
    {
        $this->stmt = $this->conn->prepare($this->sql->delete($this->getTable())->where($field)->get());

        $i = 1;

        foreach($field as $value) {
            $this->stmt->bindValue($i++, $value, $this->type($value));
        }

        return $this;
    }

    public function update($fields, $field)
    {
        $this->stmt = $this->conn->prepare($this->sql->update($this->getTable(), $fields)->where($field)->get());

        $i = 1;

        foreach($fields as $value) {
            $this->stmt->bindValue($i++, $value, $this->type($value));
        }

        foreach($field as $value) {
            $this->stmt->bindValue($i++, $value, $this->type($value));
        }

        return $this;
    }

    public function select($fields = ['*'], $where = null)
    {
        $this->sql->select($this->getTable(), $fields);

        if (!is_null($where)) {
            $this->sql->where($where);
        }

        $this->stmt = $this->conn->prepare($this->sql->get());

        if (!is_null($where)){
            $i = 1;
            foreach($where as $value) {
                $this->stmt->bindValue($i++, $value, $this->type($value));
            }
        }

        $this->select = true;

        return $this;
    }

    /**
     * Method save
     *
     * Executa a as instruções usadas anteriormente
     * 
     * @return mixed Valores retornado pelo PDOStatement
     */
    public function save()
    {
        if (is_null($this->stmt)) {
            throw new \Exception("Nenhuma ação foi executada para ser salva.");            
        }

        if (!$this->select) {
            return $this->stmt->execute();
        }

        $this->stmt->execute();
        $this->select = false;

        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Method type
     *
     * Retorna o tipo de dado que será usado
     * nos bindValue do PDOStatement
     * 
     * @param  mixed $value Tipo de valor que será usado pelo bindValue
     * @return mixed        Tipo de valor padrão do PDO para bindValue
     */
    private function type($value)
    {
        switch ($value) {
            case is_integer($value):
                return \PDO::PARAM_INT;

            case is_null($value):
                return \PDO::PARAM_NULL;

            case is_bool($value):
                return \PDO::PARAM_BOOL;
            
            default:
                return \PDO::PARAM_STR;
        }
    }
}