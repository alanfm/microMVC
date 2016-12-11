<?php

/**
 * @package System
 */
namespace System;

use System\Interfaces\InterfaceTags;

/**
 * @class Tag
 *
 * Cria uma interface para criação de códigos HTML
 * @author Alan Freire - alan_freire@msn.com
 * @copyright Alan Freire - 2016
 * @licence MIT
 */
class Tag implements InterfaceTags
{
    /**
     * @var string Nome da tag
     * @access private
     */
    private $name;

    /**
     * @var mixed Valor da Tag
     * @access private
     */
    private $value;

    /**
     * @var array Atributos da tag
     * @access private
     */
    private $attr = [];

    /**
     * @var string Código HTML da tag
     * @access private
     */
    private $tag;

    /**
     * @var array Lista de tag que não possuem fechamento
     * @access private
     */
    private $listTag;

    /**
     * @method __construct()
     * @access public
     *
     * Seta as configuração iniciais de uma tag
     *
     * @param string Nome da tag
     * @param mixed Valor da tag
     * @param array Lista de atributos da tag
     */
    public function __construct(string $name, $value = null, array $attr = [])
    {
        $this->name = $name;
        $this->setValue($value);
        $this->attr = $attr;
        $this->listTag = ['br', 'link', 'meta', 'hr', 'img', 'input'];
    }

    /**
     * @method setValue()
     * @access public
     *
     * Atrbui e filtra o conteúdo de uma tag
     *
     * @param mixed Conteúdo da tag
     * @return object Retorna o objeto
     */
    public function setValue($value)
    {
        if (is_int($value) || is_bool($value) || is_double($value)) {
            throw new \Exception("[class:Tag|method:setValue()]: Parametro inválido válido");
        }

        $this->value[] = $value;

        return $this;
    }

    /**
     * @method setAttr()
     * @access public
     *
     * Seta um atributo da tag
     *
     * @param string Nome do atributo
     * @param mixed Valor do atributo
     * @return object Retorna o objeto
     */
    public function setAttr(string $attr, $value)
    {
        $this->attr[$attr] = $value;

        return $this;
    }

    /**
     * @method build()
     * @access public
     *
     * Constroi a tag
     *
     * @return string Código HTML da tag
     */
    public function build()
    {
        $this->tag = '<' . $this->name;

        if (count($this->attr)) {
            $this->tag .= ' ';

            foreach ($this->attr as $key => $value) {
                $this->tag .= $key;

                if ($value === true) {
                    $this->tag .= ' ';
                    continue;
                }

                $this->tag .= '="';

                if (is_array($value)) {
                    $this->tag .= implode(' ', $value);
                } else {
                    $this->tag .= $value;
                }

                $this->tag .= '" ';
            }
        }
        $this->tag = trim($this->tag) . '>';

        if (!in_array(strtolower($this->name), $this->listTag)) {
            $this->tag .= $this->parseValue($this->value) . '</' . $this->name . '>';
        }

        return $this->tag;
    }

    /**
     * @method parseValue()
     * @access private
     *
     * Analise e filtra o conteúdo de uma tag
     *
     * @param mixed Conteúdo da tag
     * @return string Conteúdo filtrado da tag
     */
    private function parseValue($value)
    {
        if (is_object($value)) {
            return $value->build();
        }

        if (is_array($value)) {
            $str = '';
            
            foreach($value as $v) {
                $str .= $this->parseValue($v);
            }

            return $str;
        }

        return $value;
    }
}