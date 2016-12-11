<?php

/**
 * @package System
 */
namespace System;

/**
 * @dependence Tag, StringFormat
 */
use System\Tag;
use System\StringFormat;

/**
 * @class Form
 * 
 * Cria uma interface para criação de formulários dinamicamente
 */
class Form
{
    /**
     * @var array Campos do formulário
     * @access private
     */
    private $field = [];

    /**
     * @var string Fieldset do formulário
     * @access private
     */
    private $fieldset;

    /**
     * @var string Nome do formulário
     * @access private
     */
    private $name;

    /**
     * @var string Ação do formulário
     * @access private
     */
    private $action;

    /**
     * @var string Método de envio do formulário
     * @access private
     */
    private $method;

    /**
     * @var array Atributos do formulário
     * @access private
     */
    private $attr;

    /**
     * @var array Atributos para a div de controle dos inputs
     * @access private
     */
    private $attrForDivControl;

    /**
     * @var array Atributos para o butão de envio do formulário
     * @access private
     */
    private $attrButtonSubmit;

    /**
     * @method __construct()
     * @access public
     *
     * Seta os valores iniciais do formulário
     *
     * @param string Nome do formulário
     * @param string Ação do formulário
     * @param string Metodo de envio do formulário [POST|GET]
     * @param array Atributos do formulário
     */

    public function __construct(string $name = null, string $action = null, string $method = null, array $attr = [])
    {
        $this->setName($name);
        $this->setAction($action ?? './');
        $this->setMethod($method ?? 'POST');
        $this->setAttr($attr);
    }

    /**
     * @method setName()
     * @access public
     *
     * Atribui e filtra um valor para nome
     *
     * @param string Nome do formulário
     * @return object Retorna o objeto
     */
    public function setName(string $name)
    {
        if (!is_string($name)) {
            throw new \Exception('[Class:From|method:setName] Parametro inválido!');
        }

        $this->attr['name'] = [$name];

        return $this;
    }

    /**
     * @method setAction()
     * @access public
     *
     * Atribui e fitra um valor para ação do formulário
     *
     * @param string Ação do Formulário
     * @return object Retorna o objeto
     */
    public function setAction(string $action)
    {
        if (!is_string($action)) {
            throw new \Exception('[Class:From|method:setAction] Paramtro inválido!');
        }

        $this->attr['action'] = [$action];

        return $this;
    }

    /**
     * @method setMethod()
     * @access public
     *
     * Atribui e filtra um valor para o método de envio do formulário
     * POST ou GET
     *
     * @param string Nome do método
     * @return object Retorna o objeto
     */
    public function setMethod(string $method)
    {
        if (!is_string($method)) {
            throw new \Exception('[Class:From|method:setMethod] Parametro inválido!');
        }

        $this->attr['method'] = [$method];

        return $this;
    }

    /**
     * @method setAttr()
     * @access public
     *
     * Seta um atributo para o formulário
     * Onde a chave do array é o nome do atributo e o valor 
     * outro array com os valores
     *
     * @param array Atributos do formulário
     * @return object Retorna o objeto
     */
    public function setAttr(array $attr)
    {
        if (!is_array($attr)) {
            throw new \Exception('[Class:Form|method:setAttr] Parametro inválido!');
        }

        if (!count($this->attr)) {
            $this->attr = $attr;
        }

        $this->attr = array_merge($this->attr, $attr);

        return $this;
    }

    /**
     * @method setFieldset()
     * @access public
     *
     * Atribui e fitra um valor para o nome do fieldset
     *
     * @param string Nome do fieldset
     * @return object Retorna o objeto
     */
    public function setFieldset(string $name)
    {
        if (is_null($name)) {
            throw new \Exception('[Class:From|method:setFieldset] Parametro inválido!');
        }

        $this->fieldset = $name;

        return $this;
    }

    /**
     * @method setAttrForDivControl()
     * @access public
     *
     * Seta um atributo para o div de controle
     *
     * @param array Atributos da div
     * @return object Retorna o objeto
     */
    public function setAttrForDivControl(array $attr)
    {
        if (!is_array($attr)) {
            throw new \Exception('[Class:From|method:setAttrForDivControl] Parametro inválido!');
        }

        $this->attrForDivControl = $attr;

        return $this;
    }

    /**
     * @method setAttrButtonSubmit()
     * @access public
     *
     * Seta um atributo para o bão de submit do formulário
     *
     * @param array Atributos do butão
     * @return object Retorna o objeto
     */
    public function setAttrButtonSubmit(array $attr)
    {
        if (!is_array($attr)) {
            throw new \Exception('[Class:From|method:setAttrButtonSubmit] Parametro inválido!');
        }

        $this->attrButtonSubmit = $attr;

        return $this;        
    }

    /**
     * @method addField()
     * @access public
     *
     * Adiciona um campo para o formulário
     *
     * @param string Nome do campo
     * @param string Tipo do campo
     * @param string Valor do campo
     * @param array Atributos do campo
     * @return object Retorna o objeto
     */
    public function addField(string $name, string $type, $value = null, array $attr = [])
    {
        if (!is_string($name) || !is_string($type)) {
            throw new \Exception('[Class:Form|method:setField] Parametro(s) inválido(s)!');
        }
        $field_tag = new Tag('label', sprintf('%s: ', $name), ['for'=>[StringFormat::slug($name)]]);

        switch (StringFormat::slug($type)) {
            case 'textarea':
                $field = $this->buildTextarea($name, $value, $attr);
                break;
            case 'select':
                $field = $this->buildSelect($name, $value['options'] ?? $value, $value['selected'] ?? null, $attr);
                break;
            default:
                $field = $this->buildInput($name, $type, $value, $attr);
        }

        $this->field[StringFormat::slug($name)] = ['name'=>sprintf('%s: ', $name), 'field_tag'=>$field_tag->build(), 'input'=>$field];

        return $this;
    }

    /**
     * @method buildTextarea()
     * @access private
     *
     * Cria um campo de área de texto
     *
     * @param string Nome do campo
     * @param string Valor do campo
     * @param array Atributos do campo
     * @return string Código HTML de uma área de texto
     */
    private function buildTextarea(string $name, string $value = null, array $attr = [])
    {
        $textarea = new Tag('textarea', $value, $attr);
        $textarea->setAttr('name', StringFormat::slug($name))
                 ->setAttr('id', StringFormat::slug($name));

        return $textarea->build();
    }

    /**
     * @method buildInput()
     * @access private
     *
     * Cria um campo de área de texto
     *
     * @param string Nome do campo
     * @param string Tipo do campo
     * @param string Valor do campo
     * @param array Atributos do campo
     * @return string Código HTML de um input
     */
    private function buildInput(string $name, string $type, string $value = null, array $attr = [])
    {        
        $input = new Tag('input', null, $attr);
        $input->setAttr('name', StringFormat::slug($name))
              ->setAttr('id', StringFormat::slug($name))
              ->setAttr('type', StringFormat::slug($type));
        
        if (!is_null($value)) {
            $input->setAttr(['value'=>$value]);
        }

        return $input->build();
    }

    /**
     * @method buildSelect()
     * @access private
     *
     * Cria um campo de área de texto
     *
     * @param string Nome do campo
     * @param array Opções para o select
     * @param string Opção que será selecionada
     * @param array Atributos do campo
     * @return string Código HTML de uma select
     */
    private function buildSelect(string $name, array $options, string $selected = null, array $attr = [])
    {
        $select = new Tag('select', null, $attr);
        $select->setAttr('name', StringFormat::slug($name));

        foreach ($options as $v) {
            $option = new Tag('option', $v);
            $option->setAttr('value', StringFormat::slug($v));

            if ($selected === $v) {
                $option->setAttr('selected', true);
            }

            $select->setValue($option);
        }

        return $select->build();
    }

    /**
     * @method getFieldTag()
     * @access public
     *
     * Retorna a tag field de um campo
     *
     * @param string Nome do campo
     * @return string Código HTML de uma field tag
     */
    public function getFieldTag(string $name)
    {
        if (!array_key_exists($name, $this->field)) {
            return;
        }

        return $this->field[$name]['field_tag'];
    }

    /**
     * @method getFieldName()
     * @access public
     *
     * Retorna o nome de um campo
     *
     * @param string Nome do campo
     * @return string Nome do campo
     */
    public function getFieldName(string $name)
    {
        if (!array_key_exists($name, $this->field)) {
            return;
        }

        return $this->field[$name]['name'];
    }

    /**
     * @method getFieldInput()
     * @access public
     *
     * Retorna a tag input de um campo
     *
     * @param string Nome do campo
     * @return string Código HTML de um input
     */
    public function getFieldInput(string $name)
    {
        if (!array_key_exists($name, $this->field)) {
            return;
        }

        return $this->field[$name]['input'];
    }

    /**
     * @method getField()
     * @access public
     *
     * Retorna a tag field e tag input de um campo
     *
     * @param string Nome do campo
     * @return string Código HTML de um campo [field e input]
     */
    public function getField(string $name)
    {
        if (!array_key_exists($name, $this->field)) {
            return;
        }

        $field = new Tag('div', null, $this->attrForDivControl ?? []);
        $field->setValue($this->field[$name]['field_tag'])
              ->setValue($this->field[$name]['input']);
        
        return $field->build();
    }

    /**
     * @method buildForm()
     * @access public
     *
     * Retorna o código de um formulário em HTML
     *
     * @return string Código HTML de formulário
     */
    public function buildForm()
    {
        $field = [];
        foreach ($this->field as $key => $value) {
            $field[] = new Tag('div', [$value['field_tag'], $value['input']], $this->attrForDivControl ?? []);
        }

        $field[] = new Tag('div', new Tag('button', 'Salvar', array_merge(['type'=>['submit']], $this->attrButtonSubmit ?? [])), $this->attrForDivControl ?? []);
        
        if ($this->fieldset) {
            $fieldset = new Tag('fieldset', [new Tag('legend', $this->fieldset), $field]);
        }

        $form = new Tag('form', $fieldset ?? $field, $this->attr);

        return $form->build();
    }
}