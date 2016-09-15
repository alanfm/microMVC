<?php

/**
 * Carregamento automatico das classes
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Configuração das sessões
 */
ini_set('session.save_handler', 'files');
session_save_path(sys_get_temp_dir());
session_start();

/**
 * Arquivos de configuração
 */
include_once __DIR__ . '/src/app/config.php';


try {
    \System\Core\App::run(filter_input(INPUT_GET, 'uri', FILTER_SANITIZE_STRING));
} catch (Exception $e) {
    echo $e->getMessage();
}