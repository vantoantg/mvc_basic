<?php

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('WEB_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], '/index.php')));
define('ROOT_PATH', realpath(dirname(__FILE__) . '/'));
//define('CMS_PATH', ROOT_PATH . '/');

// starts the session
session_start();

require __DIR__.'/vendor/autoload.php';
$env = \Dotenv\Dotenv::create(__DIR__);
$env->load();

require 'config/routes.php';

$router = new \app\Application();
$router->run($routes);
