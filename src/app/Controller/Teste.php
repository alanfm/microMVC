<?php

namespace App\Controller;

use \System\Core\Controller as Controller;

final class Teste extends Controller
{
    public function index()
    {
        $this->view('teste/index', ['data'=>'Página inicial de teste!', 'title'=>'Página de teste!']);
        parent::index();
    }

    public function insertInDB()
    {
        if ($this->model('Teste')->insert(['id'=>null, 'name'=>'Test', 'last_name'=>'Test'])->save()) {
            $data = 'Registro salvo com sucesso!';
        } else {
            $data = 'Erro ao registrar os dados!';
        }

        $this->view('teste/index', ['data'=>$data, 'title'=>'Página de teste!']);
        parent::index();
    }

    public function deleteInDB($id)
    {
        if ($this->model('Teste')->delete(['id'=>$id[0]])->save()) {
            $data = 'Registro apagado com sucesso!';
        } else {
            $data = 'Erro ao apagar osdados';
        }

        $this->view('teste/index', ['data'=>$data, 'title'=>'Página de teste!']);
        parent::index();
    }

    public function updateInDB($id, $name = 'Teste', $last_name = 'Test')
    {
        if ($this->model('Teste')->update(['name'=>$name, 'last_name'=>$last_name], ['id'=>$id])->save()) {
            $data = 'Registro alterado com sucesso!';
        } else {
            $data = 'Erro ao alterar o registro';
        }

        $this->view('teste/index', ['data'=>$data, 'title'=>'Página de teste!']);
        parent::index();
    }

    public function select1InDB()
    {
        $rows = $this->model('Teste')->select()->save();

        if (count($rows)) {
            ob_start();
            var_dump($rows);
            $data = ob_get_contents();
            ob_end_clean();
        } else {
            $data = 'Erro ao fazer um select na tabela';
        }

        $this->view('teste/index', ['data'=>$data, 'title'=>'Página de teste!']);
        parent::index();
    }

    public function select2InDB($id)
    {
        $rows = $this->model('Teste')->select(['*'], ['id'=>$id])->save();

        if (count($rows)) {
            ob_start();
            var_dump($rows);
            $data = ob_get_contents();
            ob_end_clean();
        } else {
            $data = 'Erro ao fazer um select na tabela';
        }

        $this->view('teste/index', ['data'=>$data, 'title'=>'Página de teste!']);
        parent::index();
    }

    public function select3InDB($field)
    {
        $field = filter_var($field, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $rows = $this->model('Teste')->select(['*'], ['name'=>["%$field%", 'LIKE']])->save();

        if (count($rows)) {
            ob_start();
            var_dump($rows);
            $data = ob_get_contents();
            ob_end_clean();
        } else {
            $data = 'Erro ao fazer um select na tabela';
        }

        $this->view('teste/index', ['data'=>$data, 'title'=>'Página de teste!']);
        parent::index();
    }
}