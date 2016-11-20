<?php

namespace App\Controller;

use \System\Core\Controller as Controller;

final class Teste extends Controller
{
    public function index()
    {
        echo '<h1>MicroMVC</h1>';
        echo '<h3>Exemplo de uma pequena aplicação com microframework.</h3>';
        echo '<hr>';
    }

    public function insertInDB()
    {
        $this->index();
        if ($this->model('Teste')->insert(['id'=>null, 'name'=>'Test', 'last_name'=>'Test'])->save()) {
        	echo 'Salvo!';
        } else {
        	echo 'Erro!';
        }
    }

    public function deleteInDB($id)
    {
        $this->index();
    	if ($this->model('Teste')->delete(['id'=>$id[0]])->save()) {
    		echo 'Apagado!';
    	} else {
    		echo 'Erro!';
    	}
    }

    public function updateInDB($id)
    {
        $this->index();
    	if ($this->model('Teste')->update(['name'=>'Test', 'last_name'=>'Test'], ['id'=>$id[0]])->save()) {
    		echo 'Alterado!';
    	} else {
    		echo 'Erro!';
    	}
    }

    public function select1InDB()
    {
        $this->index();
    	$rows = $this->model('Teste')->select()->save();

    	if (count($rows)) {
    		var_dump($rows);
    	} else {
    		echo 'Erro!';
    	}
    }

    public function select2InDB($id)
    {
        $this->index();
    	$rows = $this->model('Teste')->select(['*'], ['id'=>$id])->save();

    	if (count($rows)) {
    		var_dump($rows);
    	} else {
    		echo 'Erro!';
    	}
    }

    public function select3InDB($field)
    {
        $this->index();
        $field = filter_var($field, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        
        $rows = $this->model('Teste')->select(['*'], ['name'=>["%$field%", 'LIKE']])->save();

        if (count($rows)) {
            var_dump($rows);
        } else {
            echo 'Erro!';
        }
    }
}