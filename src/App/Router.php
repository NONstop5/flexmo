<?php

namespace App;

use App\Configs\AppConfig;

class Router extends \Flexmo\Router
{
    /**
     * Добавляет маршруты в таблицу маршрутов в дополнение к автоматическому определнию маршрутов
     */
    public function addRoutes()
    {
        $this->addRoute('', [
            'controller' => $this->appConfig[AppConfig::DEFAULT_CONTROLLER_NAME],
            'action' => $this->appConfig[AppConfig::DEFAULT_ACTION_NAME]
        ]);
        $this->addRoute('test1', [
            'controller' => 'Contacts',
            'action' => 'Index'
        ]);
        $this->addRoute('test2', [
            'controller' => 'Contacts',
            'action' => 'Index'
        ]);
    }
}
