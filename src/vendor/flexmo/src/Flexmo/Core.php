<?php


namespace Flexmo;

use Exception;
use Tracy\Debugger;

class Core
{
    protected $appConfig;

    public function __construct($appConfig = [])
    {
        $this->appConfig = $appConfig;

        $this->initDebugger();
        $this->initRouter();
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
    private function initRouter()
    {
        $router = new Router();
        $this->runController($router->dispatch());
    }

    /**
     * Запускаем контроллер и action, соответствующие маршруту
     *
     * @param $route
     * @throws Exception
     */
    private function runController($route)
    {
        $controllerClassName = 'App\Controllers\\' . $route['controller'];

        if (class_exists($controllerClassName)) {
            $controllerObject = new $controllerClassName($route);
            $controllerAction = Utils::convertToCamelCase($route['action']) . ACTION_POSTFIX;

            if (method_exists($controllerObject, $controllerAction)) {
                $controllerObject->$controllerAction();
            } else {
                throw new Exception('Не найден Action, соответствующий маршруту!');
            }
        } else {
            throw new Exception('Не найден Controller, соответствующий маршруту!');
        }
    }
}
