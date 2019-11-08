<?php

use App\App;
use DI\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$container = ContainerBuilder::buildDevContainer();
$container->set(Request::class, Request::createFromGlobals());
$container->get(App::class)->start();
