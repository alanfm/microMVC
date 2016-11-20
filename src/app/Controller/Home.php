<?php
/**
 * Pacote onde está a classe Home
 * 
 * @package App
 * @subpackage Controller
 */
namespace App\Controller;

/**
 * Classes usadas ou herdadas por esse classe
 */
use \System\Core\Controller as Controller;

/**
 * Classe Home
 * 
 * Classe inicial do projeto.
 * Esta classe é usado como padrão para a aplicação
 * e é sempre utilizada para a página inicial
 * 
 * @author Alan Freire - Desenvolvedor - alan_freire@msn.com
 * @version 1.0
 * @copyright MIT © 2016
 */
final class Home extends Controller
{
    /**
     * Method __construct
     * @access public
     * 
     * Método contrutor da classe de controle home
     * 
     * Caso o método de construtor das classes de controle sejam
     * implementados, deve-se adicionar a execução do método
     * construtor da classe pai.
     */
    public function __construct()
    {
        /**
         * O método construtor da classe pai deve ser arbitrariamente 
         * chamado.
         */
        parent::__construct();
    }

    /**
     * Method index
     * @access public
     * 
     * Método que será executado como padrão da aplicação
     */
    public function index()
    {
        /**
         * Seta o valor do arquivo de view que está no diretorio src/app/View/home
         * Os arquivos de view devem ter a extenção .php,
         * mesmo que contenham apenas código de html
         * 
         * No exemplo abaixo, é pego a instancia da classe View, setado o valor do arquivo de view,
         * onde "home" é diretorio dentro do diretorio "View" e index é o arquivo sem a extenção ".php".
         * Depois é setado um vetor, onde a chave é o nome da variável que será acessado no arquivo
         * 
         * Na linha parent::index() é impresso a página na tela do usuário.
         */
        $this->view()->template('home/index')->data(array('title'=>'microMVC'));

        /**
         * Também é possivel fazer como na linha de código abaixo 
         * $this->view('home/index', ['title'=>'microMVC']);
         */
        parent::index();
    }
}