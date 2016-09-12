<?php

/**
 * @package System\Core
 * 
 * Pacate onde está a classe View
 */
namespace System\Core;

/**
 * Class View
 * 
 * Define uma interface de integração entre os
 * arquivos da visão com os controladores
 * 
 * @author Alan Freire - alan_freire@msn.com
 */

class View
{
	/**
	 * @var string
	 * 
	 * Recebe o caminho do arquivo do template
	 */
	private $template;

	/**
	 * @var array
	 * 
	 * Variáveis que pode ser visualizadas no template
	 */

	private $data;

	/**
	 * Method getTemplate
	 * 
	 * Retorna o nome do template
	 * 
	 * @return string
	 */
	public function getTemplate()
	{
		if (empty($this->template)) {
			throw new \Exception('Não foi definido o nome do template.');

			return;
		}

		return $this->template;
	}

	/**
	 * Method setTemplate
	 * 
	 * Atribui um valor para o nome do template
	 * 
	 * @param string
	 * @return object
	 */
	public function setTemplate($template)
	{
		if (!is_string($template)) {
			throw new \Exception('Nome do template inserido é inválido.');

			return;
		}

		$this->template = VIEW_DIR . $template . '.php';

		return $this;
	}

	/**
	 * Method getData
	 * 
	 * Retorna o vetor com os valores que
	 * poderam ser visualizados pelo template
	 * 
	 * @return array
	 */
	public function getData()
	{
		if (count($this->data) == 0) {
			throw new \Exception('Vetor data está vazio.');

			return array();
		}

		return $this->data;
	}

	/**
	 * Method setData
	 * 
	 * Atribui um valor para o vetor de variáveis
	 * que podem ser usadas no template
	 * 
	 * @param array
	 * @return object
	 */
	public function setData($data)
	{
		if (!is_array($data)) {
			throw new \Exception('O valor passado é inválido.');

			return;
		}

		$this->data = $data;

		return $this;
	}

	/**
	 * Method show
	 * 
	 * Imprime o template na tela
	 * 
	 * @return object
	 */
	public function show()
	{
		if (file_exists($this->getTemplate())) {
			if (count($this->getData()) > 0) {
				foreach ($this->getData() as $k => $v) {
					$$k = $v;
				}
			}
			include_once $this->getTemplate();
		} else {
			throw new \Exception('O arquivo do template não existe.');
			return;
		}

		return $this;
	}
}