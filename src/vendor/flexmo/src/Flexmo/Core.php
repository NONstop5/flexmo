<?php

namespace Flexmo;

use App\Configs\AppConfig;
use App\Database;
use Exception;
use Tracy\Debugger;

abstract class Core
{
    /** @var array Массив конфигурации приложения */
    protected $appConfig;
    /** @var array Текущий маршрут */
    protected $route;
    protected $router;
    /** @var Container Контейнер */
    protected $container;

    public function start()
    {
        $this->initDebugger();
        $this->initContainer();
        $this->initRouter();
        $this->initDatabase();
    }

    /**
     * Инициализируем отладчик
     */
    private function initDebugger()
    {
        Debugger::enable();
    }

    /**
     * Инициализируем контейнер
     */
    private function initContainer()
    {
        $this->container->get(AppConfig::class);
    }

    /**
     * Инициализируем роутер
     *
     * @throws Exception
     */
    protected function initRouter()
    {
        /** @var Router $router */
        $this->router->addRoutes();
        $this->router->addDefaultRoutes();
        $this->route = $this->router->dispatch();
        $this->checkController();
    }

    /**
     * Инициализируем БД
     */
    private function initDatabase()
    {
        $database = $this->container->get(Database::class);
    }

    /**
     * Запускаем action контроллера, соответствующий маршруту
     *
     * @throws Exception
     */
    protected function checkController()
    {
        $controllersNamespace = str_replace(
            '/',
            '\\',
            str_replace(
                dirname($this->appConfig->getAppConfig()[AppConfig::APP_ROOT]) . '/',
                '',
                $this->appConfig->getAppConfig()[AppConfig::CONTROLLER_PATH]
            )
        );
        $controllerClassName = $controllersNamespace . $this->route['controller'] . 'Controller';

        if (class_exists($controllerClassName)) {
            $this->invokeController($controllerClassName);
        } else {
            throw new Exception('Не найден контроллер ' . $controllerClassName . ', соответствующий маршруту!');
        }
    }

    /**
     * Вызывает контроллер по namespace
     *
     * @param $controllerClassName
     * @throws Exception
     */
    private function invokeController($controllerClassName)
    {
        $controllerObject = $this->container->get($controllerClassName);
        $controllerAction = $this->route['action'] . $this->appConfig->getAppConfig()[AppConfig::ACTION_POSTFIX];

        if (method_exists($controllerObject, $controllerAction)) {
            echo $controllerObject->$controllerAction();
        } else {
            throw new Exception('Не найден Action, соответствующий маршруту!');
        }
    }
}
