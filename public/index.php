<?php

use App\App;
use App\Configs\AppConfig;
use Flexmo\Container;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$container = new Container((new AppConfig()));
$container->get(App::class)->start();
