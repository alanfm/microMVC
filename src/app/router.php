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

/**
 * Pequeno exemplo de como funciona o sistema
 * de rotas para esse micro framework
 * 
 * Para mais informações de como funciona o sistema de rotas
 * acesse o github do desenvolvedor: https://github.com/bramus/router
 */
$router->mount('/teste', function() use ($router) {
	$ctrl = new \App\Controller\Teste();

	$router->get('/', function() use ($ctrl) {
		$ctrl->index();
	});

	$router->get('/insert', function() use ($ctrl) {
		$ctrl->insertInDB('y');
	});

	$router->get('/delete/(\d+)', function($id) use ($ctrl) {
		$ctrl->deleteInDB($id);
	});

	$router->get('/update/(\d+)', function($id) use ($ctrl) {
		$ctrl->updateInDB($id);
	});

	$router->get('/select1', function() use ($ctrl) {
		$ctrl->select1InDB();
	});

	$router->get('/select2/(\d+)', function($id) use ($ctrl) {
		$ctrl->select2InDB($id);
	});

	$router->get('/select3/(\w+)', function($name) use ($ctrl) {
		$ctrl->select3InDB($name);
	});	
});

/**
 * Executa as rotas
 */
$router->run();