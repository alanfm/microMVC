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

    public function setUp()
    {
        $this->sql = new SQL();
    }

    public function testInstanceSQL()
    {
        $this->assertInstanceOf(SQL::class, $this->sql);
    }

    public function testInsert()
    {
        $this->sql->insert('tabela', ['col1'=>'val1', 'col2'=>'val2', 'col3'=>'val3']);

        $this->assertEquals('INSERT INTO tabela (col1, col2, col3) VALUES (?, ?, ?)', $this->sql->get());
    }

    public function testDelete()
    {
        $this->sql->delete('tabela');

        $this->assertEquals('DELETE FROM tabela', $this->sql->get());
    }

    public function testDeleteById()
    {
        $this->sql->delete('tabela')->where(['id'=>1]);

        $this->assertEquals('DELETE FROM tabela WHERE (id = ?)', $this->sql->get());
    }

    public function testUpdate()
    {
        $this->sql->update('tabela', ['col1'=>'val1', 'col2'=>'val2']);

        $this->assertEquals('UPDATE tabela SET col1 = ?, col2 = ?', $this->sql->get());
    }

    public function testUpdateById()
    {
        $this->sql->update('tabela', ['col1'=>'val1', 'col2'=>'val2'])->where(['id'=>2]);

        $this->assertEquals('UPDATE tabela SET col1 = ?, col2 = ? WHERE (id = ?)', $this->sql->get());
    }

    public function testSelect()
    {
        $this->sql->select('tabela', ['col1', 'col2', 'col3']);

        $this->assertEquals('SELECT col1, col2, col3 FROM tabela', $this->sql->get());
    }

    public function testSelectEmptyFields()
    {
        $this->sql->select('tabela');

        $this->assertEquals('SELECT * FROM tabela', $this->sql->get());
    }
}