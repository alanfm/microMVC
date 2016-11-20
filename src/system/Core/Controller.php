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
     * @access public
     * 
     * Define as configurações do controller
     */
    public function __construct()
    {
        $this->view = new View();
    }

    public function model($model)
    {
        $this->model = sprintf("\App\Model\%s", $model);

        return new $this->model; 
    }
    
    /**
     * Method getView
     * @access protected
     * 
     * Recebe o endereço do arquivo de view e
     * retorna o objeto view
     * 
     * @param string
     * @param array
     * 
     * @return object
     */
    protected function view($template = null, array $data = [])
    {
        if ($template) {
            $this->view->template($template);
        }

        if (count($data)) {
            $this->view->data($data);
        }

        return $this->view;
    }

    /**
     * Method index
     * @access public
     * 
     * Metodo padrão para impressão do template na tela
     * 
     * @return object
     */
    public function index()
    {
        $this->view()->show();

        return $this;
    }

    /**
     * Method outputJSON
     * @access public
     * 
     * Recebe um array como parametro e imprime
     * na tela os dados no formato JSON
     * 
     * @param array
     */
    public function outputJSON(array $data)
    {
        if (!is_array($data)) {
            throw new \Exception("Parametro inválido. Atribua um vetor como parametro.");         
        }

        header('Content-Type: application/json');
        echo json_encode($data);

        return $this;
    }
}