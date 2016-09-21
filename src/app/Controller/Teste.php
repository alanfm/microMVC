<?php

namespace App\Controller;

use \System\Core\Controller as Controller;

final class Teste extends Controller
{
    public function index()
    {
        echo 'teste';
    }

    public function outro()
    {
        echo 'outro';
    }
}