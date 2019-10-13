<?php

use Flexmo\Router;
use Tracy\Debugger;

require_once '../vendor/autoload.php';
Debugger::enable();

define('PUBLIC', dirname(__DIR__));
define('CORE', dirname(__DIR__) . '/vendor/flexmo/src/core');
define('APP_ROOT', dirname(__DIR__));
define('CONTROLLERS_PATH', dirname(__DIR__) . '/app/Controllers/');
define('VIEWS_PATH', dirname(__DIR__) . '/app/Views/');
define('MODELS_PATH', dirname(__DIR__) . '/app/Models/');

$query = rtrim(substr($_SERVER['REQUEST_URI'], 1), '/');

//Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);

// default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$');

//bdump(Router::getRoutes());

Router::dispatch($query);
