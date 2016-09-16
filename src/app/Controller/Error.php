<?php

namespace App\Controller;

use \System\Core\Controller as Controller;

class Error extends Controller
{
    public function index()
    {
        $this->getView()->setTemplate('error/index');
        parent::index();
    }
}