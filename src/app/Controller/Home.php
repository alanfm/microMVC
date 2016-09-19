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
 * @copyright GPL 2016
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
        $this->getView()->setTemplate('home/index')->setData(array('title'=>'microMVC'));
        parent::index();
    }

    public function teste()
    {
        try {
            $sql = new \System\Core\SQL();

            echo $sql->select('tabela', ['a','b','c'])
                     ->where(['c'=>['%d%', 'like'], 'd'=>2], 'OR')
                     ->where(['a'=>'micro', 'b'=>'frame', 'e'=>'work'])
                     ->where(['c'=>['%d%', 'like'], 'd'=>2])->get(), '<br>';
            echo $sql->select('table')
                     ->where(['c'=>['%d%', '!=']], 'OR')
                     ->orderBy('z', 'asc')
                     ->limit(5)
                     ->get(), '<br>';
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}