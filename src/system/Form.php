<?php

namespace System;

use System\Tag;
use System\StringFormat;

class Form
{
    private $field = [];
    private $fieldset;
    private $name;
    private $action;
    private $method;
    private $attr;

    public function __construct(string $name = null, string $action = null, string $method = null, array $attr = [])
    {
        $this->setName($name);
        $this->setAction($action ?? '');
        $this->setMethod($method ?? 'POST');
        $this->setAttr($attr);
    }

    public function setName(string $name)
    {
        if (!is_string($name)) {
            throw new \Exception('[Class:From|method:setName] Parametro inválido!');
        }

        $this->attr['name'] = [$name];

        return $this;
    }

    public function setAction(string $action)
    {
        if (!is_string($action)) {
            throw new \Exception('[Class:From|method:setAction] Paramtro inválido!');
        }

        $this->attr['action'] = [$action];

        return $this;
    }

    public function setMethod(string $method)
    {
        if (!is_string($method)) {
            throw new \Exception('[Class:From|method:setMethod] Parametro inválido!');
        }

        $this->attr['method'] = [$method];

        return $this;
    }

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

    public function setFieldset(string $name)
    {
        if (is_null($name)) {
            throw new \Exception('[Class:From|method:setFieldset] Parametro inválido!');
        }

        $this->fieldset = $name;

        return $this;
    }

    public function addField(string $name, string $type, string $value = null, array $attr = [])
    {
        if (!is_string($name) || !is_string($type)) {
            throw new \Exception('[Class:Form|method:setField] Parametro(s) inválido(s)!');
        }

        $attr['name'] = $attr['id'] = [StringFormat::slug($name)];
        $attr['type'] = [strtolower($type)];

        if (!is_null($value)) {
            $attr['value'] = [$value];
        }
        
        $input = new Tag('input', $value, $attr);
        $field_tag = new Tag('label', sprintf('%s: ', $name), ['for'=>$attr['id']]);

        $this->field[StringFormat::slug($name)] = ['name'=>sprintf('%s: ', $name), 'field_tag'=>$field_tag->build(), 'input'=>$input->build()];

        return $this;
    }

    public function getFieldTag(string $name)
    {
        if (!array_key_exists($name, $this->field)) {
            return;
        }

        return $this->field[$name]['field_tag'];
    }

    public function getFieldName(string $name)
    {
        if (!array_key_exists($name, $this->field)) {
            return;
        }

        return $this->field[$name]['name'];
    }

    public function getFieldInput(string $name)
    {
        if (!array_key_exists($name, $this->field)) {
            return;
        }

        return $this->field[$name]['input'];
    }

    public function buildForm()
    {
        $field = [];
        foreach ($this->field as $key => $value) {
            $field[] = new Tag('div', [$value['field_tag'], $value['input']]);
        }
        $field[] = new Tag('button', 'Salvar', ['type'=>['submit']]);
        
        if ($this->fieldset) {
            $fieldset = new Tag('fieldset', [new Tag('legend', $this->fieldset), $field]);
        }

        $form = new Tag('form', $fieldset ?? $field, $this->attr);

        return $form->build();
    }
}