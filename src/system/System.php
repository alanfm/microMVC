<?php

namespace System;

class System
{
    /**
     * Method correntUrl
     * @access public
     * 
     * Retorna a url da página atual
     * 
     * @return string
     */
    public static function correntURL()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    
    /**
     * Method redirect
     * @access public
     * 
     * Redireciona para a pagina passada por paramentro
     * 
     * @param string
     */
    public static function redirect($url)
    {
        header('Location: ' . URL_BASE . $url);
    }
}