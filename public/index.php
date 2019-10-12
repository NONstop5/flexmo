<?php
error_reporting(E_ALL);

use vendor\flexmo\src\core\Router;

define('PUBLIC', dirname(__DIR__));
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . 'app');

$query = rtrim(substr($_SERVER['REQUEST_URI'], 1), '/');

spl_autoload_register(function ($class) {
    $classFullPath = ROOT . '/' . str_replace('\\', '/', $class) . '.php';

    if (is_file($classFullPath)) {
        require_once $classFullPath;
    }
});


// default routs
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
