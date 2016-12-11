<?php

/**
 * @package Tests
 */
namespace Tests;

use System\Form;

class FormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var object
     */
    protected $form;

    public function setUp()
    {
        $this->form = new Form('test');
    }
    
    public function testInstanceForm()
    {
        $this->assertInstanceOf(Form::class, $this->form);
    }

    public function testGetFieldTag()
    {
        $this->form->addField('Name', 'text');

        $this->assertEquals('<label for="name">Name: </label>', $this->form->getFieldTag('name'));
    }

    public function testGetFieldName()
    {
        $this->form->addField('Name', 'text');

        $this->assertEquals('Name: ', $this->form->getFieldName('name'));
    }

    public function testGetFieldInput()
    {
        $this->form->addField('Name', 'text');

        $this->assertEquals('<input id="name" name="name" type="text">', $this->form->getFieldInput('name'));
    }

    public function testGetField()
    {
        $this->form->addField('Name', 'text');

        $this->assertEquals('<div><label for="name">Name: </label><input id="name" name="name" type="text"></div>', $this->form->getField('name'));
    }

    public function testBuidForm()
    {
        $this->form->addField('Name', 'text');

        $this->assertEquals('<form name="test" action="" method="POST"><div><label for="name">Name: </label><input id="name" name="name" type="text"></div><button type="submit">Salvar</button></form>', $this->form->buildForm());
    }
}