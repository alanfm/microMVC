<?php

namespace System\Core;

use \System\Core\View as View;

/**
 * Class Controller
 * 
 * Classe base para um controller do projeto
 * usando o padrão MVC
 * 
 * @author Alan Freire - Alan Freire
 */

class Controller
{
	/**
	 * @var object
	 * 
	 * recebe o um objeto model
	 */
	private $model;

	/**
	 * @var object
	 * 
	 * recebe um objeto view
	 */
	private $view;

	/**
	 * Method __construct
	 * 
	 * Define as configurações do controller
	 */
	public function __construct()
	{
		$this->view = new View();
	}

	/**
	 * Method getView
	 * 
	 * Tetorna o objeto view
	 */
	protected function getView()
	{
		return $this->view;
	}

	/**
	 * Method index
	 * 
	 * Metodo padrão para impressão do template na tela
	 * @return object
	 */
	public function index()
	{
		$this->getView()->show();

		return $this;
	}
}