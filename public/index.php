<?php

use App\App;
use App\Configs\AppConfig;

require_once dirname(__DIR__) . '/vendor/autoload.php';


(new App((new AppConfig())));

//Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
