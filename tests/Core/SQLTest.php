<?php

/**
 * @package Tests
 * @subpackage Core
 */
namespace Tests\Core;

use \System\Core\SQL;

/**
 * Class SQLTest
 * 
 * Cria um teste unitário para a classe SQL e seus métodos
 */
class SQLTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var object
     */
    protected $sql;

    /**
     * Executa as configurações iniciais
     */
    public function setUp()
    {
        $this->sql = new SQL();
    }

    /**
     * Testa se foi criado a instancia da classe SQL
     */
    public function testInstanceSQL()
    {
        $this->assertInstanceOf(SQL::class, $this->sql);
    }

    /**
     * Testa o método insert
     */
    public function testInsert()
    {
        $this->sql->insert('tabela', ['col1'=>'val1', 'col2'=>'val2', 'col3'=>'val3']);

        $this->assertEquals('INSERT INTO tabela (col1, col2, col3) VALUES (?, ?, ?)', $this->sql->get());
    }

    /**
     * Testa o método delete sem a clausula where
     */
    public function testDelete()
    {
        $this->sql->delete('tabela');

        $this->assertEquals('DELETE FROM tabela', $this->sql->get());
    }

    /**
     * Testa o método delete com a clausula where
     */
    public function testDeleteById()
    {
        $this->sql->delete('tabela')->where(['id'=>1]);

        $this->assertEquals('DELETE FROM tabela WHERE (id = ?)', $this->sql->get());
    }

    /**
     * Testa o método update sem a cláusula where
     */
    public function testUpdate()
    {
        $this->sql->update('tabela', ['col1'=>'val1', 'col2'=>'val2']);

        $this->assertEquals('UPDATE tabela SET col1 = ?, col2 = ?', $this->sql->get());
    }

    /**
     * Testa o método update com a cláusula where
     */
    public function testUpdateById()
    {
        $this->sql->update('tabela', ['col1'=>'val1', 'col2'=>'val2'])->where(['id'=>2]);

        $this->assertEquals('UPDATE tabela SET col1 = ?, col2 = ? WHERE (id = ?)', $this->sql->get());
    }

    /**
     * Testa do método select sem a cláusula where
     * e com os campos passados por parametro
     */
    public function testSelect()
    {
        $this->sql->select('tabela', ['col1', 'col2', 'col3']);

        $this->assertEquals('SELECT col1, col2, col3 FROM tabela', $this->sql->get());
    }

    /**
     * Teste do método selec sem a clausula where
     * e sem passar o parametro campos
     */
    public function testSelectEmptyFields()
    {
        $this->sql->select('tabela');

        $this->assertEquals('SELECT * FROM tabela', $this->sql->get());
    }
}