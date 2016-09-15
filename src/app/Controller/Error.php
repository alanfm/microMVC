<?php

namespace App\Controller;

class Error
{
    public function __construct()
    {

    }
    public function index($param = null)
    {
        print('Página não encontrada!');
    }
}