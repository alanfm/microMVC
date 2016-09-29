<?php

/**
 * Pacote onde está a classe App
 * 
 * @package System\Core
 */
namespace System\Core;

final class App
{
    /**
     * @var string
     * 
     * Recebe o nome da classe
     */
    private static $class = null;

    /**
     * @var string
     * 
     * Recebe o nome do método
     */
    private static $method = null;

    /**
     * @var array
     * 
     * Recebe uma coleção de parametros
     */
    private static $param = array();

    /**
     * Method run
     * 
     * Executa a aplicação instanciando os controles
     * de acordo com os valores passados na uri
     * 
     * @param string
     */
    public static function run($uri)
    {
        self::parseUri($uri);

        if (self::$class == null) {
            $obj = new \App\Controller\Home();
            $obj->index();

            return;
        }

        if (!file_exists(CONTROLLER_DIR . self::$class . '.php') || self::$class === 'Error') {
            $obj = new \App\Controller\Error();
            $obj->index();

            return;
        }

        $obj = new \ReflectionClass("\\App\\Controller\\" . self::$class);

        if (!isset(self::$method) || self::$method === '') {
            $obj->getMethod('index')->invoke($obj->newInstance());

            return;
        }

        if (!$obj->hasMethod(self::$method)) {
            $obj = new \App\Controller\Error();
            $obj->index();

            return;            
        }

        if (count(self::$param)) {
            $obj->getMethod(self::$method)->invoke($obj->newInstance(), self::$param);
            return;
        }

        $obj->getMethod(self::$method)->invoke($obj->newInstance());
        return;
    }

    /**
     * Method parseUri
     * 
     * Divide a uri passa em classe
     * método e parametros
     * 
     * @param string
     */
    private static function parseUri($uri)
    {
        if (!is_string($uri)) {
            throw new \Exception('URI inválido.');

            return;
        }

        $uri = explode('/', $uri);

        if ($uri[0] == '') {
            self::$class = null;
            return;
        }

        self::$class = count($uri)? self::parseString(array_shift($uri), 'class'): null;
        self::$method = count($uri)? self::parseString(array_shift($uri), 'method'): null;
        self::$param = count($uri)? $uri: array();
    }

    /**
     * Method parseString
     * 
     * Retira os caracteres especiais de uma string
     * e a formata para o padrão usado pelo aplicativo
     * 
     * @param string
     * @param string
     * @return string
     */
    private static function parseString($string, $format = null)
    {
        if (!is_string($string)) {
            throw new \Exception('Parametro inválido.');

            return;
        }

        $string = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $string));

        switch ($format) {
            case 'class':
                $string = ucfirst(strtolower($string));
                break;

            case 'method':
                $string = strtolower($string);
                break;
        }

        return $string;
    }
}
