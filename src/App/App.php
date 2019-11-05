<?php

namespace App;

use App\Configs\AppConfig;
use Flexmo\Container;
use Flexmo\Core;

class App extends Core
{
    /** @var array Массив конфигурации приложения */
    protected $appConfig;
    /** @var Router $router Роутер */
    protected $router;
    /** @var Container Контейнер */
    protected $container;

    public function __construct(
        AppConfig $appConfig,
        Router $router,
        Container $container
    ) {
        $this->appConfig = $appConfig;
        $this->router = $router;
        $this->container = $container;
    }
}
