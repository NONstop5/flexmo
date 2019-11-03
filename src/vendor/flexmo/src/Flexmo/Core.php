<?php


namespace Flexmo;


use App\Configs\AppConfig;
use App\Database;
use Exception;
use Tracy\Debugger;

class Core
{
    /** @var array Массив конфигурации приложения */
    protected $appConfig;
    /** @var array Текущий маршрут */
    protected $route;
    /** @var Container Контейнер */
    protected $container;

    public function __construct(AppConfig $appConfig)
    {
        $this->appConfig = $appConfig;

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
        $this->container = new Container($this->appConfig);
    }

    /**
     * Инициализируем роутер
     *
     * @throws Exception
     */
    private function initRouter()
    {
        $router = $this->container->get(Router::class);
        $this->route = $router->dispatch();
        $this->checkController();
    }

    /**
     * Инициализируем БД
     */
    private function initDatabase()
    {
        $this->container->get(Database::class);
    }

    /**
     * Запускаем action контроллера, соответствующий маршруту
     *
     * @throws Exception
     */
    private function checkController()
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
            throw new Exception('Не найден Controller, соответствующий маршруту!');
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
