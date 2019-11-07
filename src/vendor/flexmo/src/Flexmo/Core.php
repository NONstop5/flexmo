<?php

namespace Flexmo;

use App\Configs\AppConfig;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Tracy\Debugger;

abstract class Core
{
    /** @var array Текущий маршрут */
    protected $route;
    protected $appConfig;
    protected $container;

    public function __construct(AppConfig $appConfig, \DI\Container $container)
    {
        $this->container = $container;
        $this->appConfig = $appConfig;
    }

    /**
     * Запуск приложения
     *
     * @throws Exception
     */
    public function start()
    {
        $this->initDebugger();
        //$this->initContainer();
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
     *
     * @throws Exception
     */
    private function initContainer()
    {
        //Container();
    }

    /**
     * Инициализируем роутер
     *
     * @throws Exception
     */
    protected function initRouter()
    {
        $request = Request::createFromGlobals();
        $this->container->set(Request::class, $request);
        $router = $this->container->get(Router::class);
        $router->addDefaultRoutes();
        $this->route = $router->dispatch();
        $this->checkController();
    }

    /**
     * Инициализируем БД
     *
     * @throws Exception
     */
    private function initDatabase()
    {
        /** @var Database $database */
        $database = $this->container->get(Database::class);
        $database->make();
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
