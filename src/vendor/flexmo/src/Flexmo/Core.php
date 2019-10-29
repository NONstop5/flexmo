<?php


namespace Flexmo;


use App\Configs\AppConfig;
use Exception;
use Tracy\Debugger;

class Core
{
    /** @var array Массив конфигурации приложения */
    protected $appConfig;
    /** @var array Текущий маршрут */
    protected $route;

    public function __construct(array $appConfig)
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
        new Container(AppConfig::getAppConfig());
    }

    /**
     * Инициализируем роутер
     *
     * @throws Exception
     */
    private function initRouter()
    {
        $router = new Router($this->appConfig);
        $this->route = $router->dispatch();
        $this->checkController();
    }

    /**
     * Инициализируем БД
     */
    private function initDatabase()
    {
        new \App\Database(AppConfig::getDbConfig());
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
                dirname($this->appConfig[AppConfig::APP_ROOT]) . '/',
                '',
                $this->appConfig[AppConfig::CONTROLLER_PATH]
            )
        );
        $controllerClassName = $controllersNamespace . $this->route['controller'];

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
        $controllerObject = new $controllerClassName($this->route, $this->appConfig);
        $controllerAction = $this->route['view'] . $this->appConfig[AppConfig::ACTION_POSTFIX];

        if (method_exists($controllerObject, $controllerAction)) {
            $controllerObject->$controllerAction();
        } else {
            throw new Exception('Не найден Action, соответствующий маршруту!');
        }
    }
}
