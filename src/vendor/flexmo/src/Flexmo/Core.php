<?php

namespace Flexmo;

use App\Configs\AppConfig;
use Exception;
use Tracy\Debugger;

abstract class Core
{
    /** @var array Текущий маршрут */
    protected $route;
    protected $appConfig;
    protected $router;
    protected $database;
    protected $container;

    public function __construct(
        AppConfig $appConfig,
        Router $router,
        Database $database,
        \DI\Container $container
    ) {
        $this->appConfig = $appConfig;
        $this->router = $router;
        $this->database = $database;
        $this->container = $container;
    }

    /**
     * Запуск приложения
     *
     * @throws Exception
     */
    public function start()
    {
        $this->initDebugger();
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
     * Инициализируем роутер
     *
     * @throws Exception
     */
    protected function initRouter()
    {
        $this->router->addDefaultRoutes();
        $this->route = $this->router->dispatch();
        $this->checkController();
    }

    /**
     * Инициализируем БД
     *
     * @throws Exception
     */
    private function initDatabase()
    {
        $this->database->makePdo();
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
