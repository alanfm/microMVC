<?php

/**
 * Carregamento automatico das classes
 */
$autoload = __DIR__ . '/vendor/autoload.php';

if (!file_exists($autoload)) {
    echo "Você precisa executar <strong>composer install</strong>!";
    exit;
}

require_once $autoload;

/**
 * Configuração das sessões
 */
ini_set('session.save_handler', 'files');
session_save_path(sys_get_temp_dir());
session_start();

/**
 * Arquivos de configuração
 */
require_once __DIR__ . '/src/app/config.php';

/**
 * Rotas do sistema
 */
require_once __DIR__ . '/src/app/router.php';