<?php

namespace App\Controller;

use \System\Core\Controller as Controller;

final class Teste extends Controller
{
    public function index()
    {
        echo '<h1>teste</h1>';
    }

    public function insertInDB()
    {
        if ($this->model('Teste')->insert(['id'=>null, 'name'=>'Alan', 'last_name'=>'Freire'])->save()) {
        	echo 'Salvo!';
        } else {
        	echo 'Erro!';
        }
    }

    public function deleteInDB($id)
    {
    	if ($this->model('Teste')->delete(['id'=>$id[0]])->save()) {
    		echo 'Apagado!';
    	} else {
    		echo 'Erro!';
    	}
    }

    public function updateInDB($id)
    {
    	if ($this->model('Teste')->update(['name'=>'Lys', 'last_name'=>'Moreira'], ['id'=>$id[0]])->save()) {
    		echo 'Alterado!';
    	} else {
    		echo 'Erro!';
    	}
    }

    public function selectInDB()
    {
    	$rows = $this->model('Teste')->select()->save();

    	if (count($rows)) {
    		var_dump($rows);
    	} else {
    		echo 'Erro!';
    	}
    }

    public function select2InDB($id)
    {
    	$rows = $this->model('Teste')->select(['*'], ['id'=>array_shift($id)])->save();

    	if (count($rows)) {
    		var_dump($rows);
    	} else {
    		echo 'Erro!';
    	}
    }
}