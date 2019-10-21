<?php

use App\App;
use App\Configs\AppConfig;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/src/App/Configs/Constants.php';

(new App(AppConfig::getAppConfig()));

//Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
