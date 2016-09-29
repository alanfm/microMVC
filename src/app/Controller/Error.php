<?php

/**
 * @package App\Controller
 */
namespace App\Controller;

/**
 * Classes usadas por essa classe
 */
use \System\Core\Controller as Controller;


/**
 * Classe erro
 *
 * Gerencia os erros HTTP do cliente
 */
class Error extends Controller
{
	/**
	 * Method index
	 *
	 * Método padrão executado no controles
	 */
    public function index()
    {
        $this->error404();
    }

    /**
     * Method error404
     * 
     * Método usado para mostrar o erro 404
     */
	public function error404()
	{
		$this->getView()
		     ->setTemplate('error/index')
		     ->setData(['erro'=>404, 'message'=>'Página não encontrada!']);

		parent::index();
	}

    /**
     * Method error403
     * 
     * Método usado para mostrar o erro 403
     */
	public function error403()
	{
		$this->getView()
		     ->setTemplate('error/index')
		     ->setData(['erro'=>403, 'message'=>'Esta página não pode ser acessada!']);

		parent::index();
	}
}