<?php

/**
 * Constantes usadas pelo sistema
 */

/**
 * Esse bloco de constantes só deve ser mudado se
 * você tiver certeza do que estará fazendo,
 * pois o mesmo define os diretorio para o MVC
 */
define('VIEW_DIR', __DIR__ . '/View/');
define('CONTROLLER_DIR', __DIR__ . '/Controller/');
define('MODEL_DIR', __DIR__ . '/Model/');

/**
 * Modifique para a URL do seu sistema
 */
define('URL_BASE','http://frame.local/');

/**
 * Configurações para conexão com o banco de dados
 */
define('DB_HOST', 'localhost'); // Host onde está o banco de dados
define('DB_DBMS', 'mysql');		// Sistema de Gerenciamento de Banco de Dados
define('DB_NAME', 'test');		// Nome do banco de dados
define('DB_USER', 'test');		// Usuário do banco de dados
define('DB_PASS', 'test');		// Senha do usuário do banco de dados