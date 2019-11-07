<?php

use App\App;
use DI\Container;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$container = new Container();
$app = $container->get(App::class);
$app->start();
