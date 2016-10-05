<?php
/**
 * Cria um alias para a classe Router
 */
use \Bramus\Router\Router as Router;

/**
 * Instancia da classe Router
 * 
 * @var Router
 */
$router = new Router();

/**
 * Caso a página não seja encontrada executa o 
 * erro 404 do http
 */
$router->set404(function() {
	$ctrl = new \App\Controller\Error();
	$ctrl->index();
});

/**
 * Rotas do sistema
 * Home
 */
$router->get('/', function() {
	$ctrl = new \App\Controller\Home();
	$ctrl->index();
});


$router->mount('/hello', function() use ($router) {
	$router->get('/(\d+)', function($id) {
		if (count($_SESSION['db']) <= $id) {
			echo 'Registro não encontrado!';
			exit;
		}

		echo 'Olá ', $_SESSION['db'][$id], '!';
	});

	$router->post('/', function() {
		array_push($_SESSION['db'], filter_input(INPUT_POST, 'name'));

		echo 'Olá ', $_SESSION['db'][count($_SESSION['db']) - 1], '<br> id: ', count($_SESSION['db']) - 1;
		echo "<br>Nome cadastrado com sucesso!<br>";
		echo '<br><a href="/hello">Voltar</a>';
	});

	$router->get('/edit/(\d+)', function($id) {
		echo '<form action="/hello/edit" method="post"><label>Nome: </label><input type="text" name="name" value="',$_SESSION['db'][$id - 1],'""><input type="hidden" name="id" value="', $id-1,'"><input type="submit" value="Enviar"></form>';
	});

	$router->post('/edit', function() {
		echo '<a href="/hello">voltar</a><br>';

		if (count($_SESSION['db']) <= filter_input(INPUT_POST, 'id')) {
			echo 'Registro não encontrado!';
			exit;
		}

		$_SESSION['db'][filter_input(INPUT_POST, 'id')] = filter_input(INPUT_POST, 'name');
		echo "<br>Registro alterado com sucesso!";
	});

	$router->get('/delete/(\d+)', function($id) {
		echo "<a href='/hello'>Voltar</a><br><br>";
		if (count($_SESSION['db']) < $id) {
			echo "Registro não encontrado!";
			exit;
		}

		unset($_SESSION['db'][$id - 1]);

		sort($_SESSION['db']);

		echo "Registro apagado com sucesso!";
	});

	$router->get('/', function() {
		echo '<form action="/hello" method="post"><label>Nome: </label><input type="text" name="name"><input type="submit" value="Enviar"></form>';
		echo "<table border=1><thead><tr><th>#id</th><th>Nome</th><th>Opções</th></tr></thead>";

		foreach($_SESSION['db'] as $key => $value) {
			echo "<tr><td>", $key + 1, "</td><td>", $value, "</td><td><a href='/hello/edit/", $key + 1,"'>Editar</a> || <a href='/hello/delete/", $key + 1,"'>Apagar</a></td></tr>";
		}

	    echo "</table>";
	});
});

/**
 * Executa as rotas
 */
$router->run();