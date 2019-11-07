<?php

namespace Flexmo;

use App\Configs\AppConfig;
use Exception;
use Symfony\Component\HttpFoundation\Request;

// TODO Это временный самописный роутер, который будет заменен на \FastRoute\Dispatcher
class Router
{
    /** @var array Таблица маршрутов */
    protected $routes = [];
    /** @var array Текущий маршрут */
    protected $route = [];
    protected $appConfig;
    protected $container;
    protected $request;

    public function __construct(AppConfig $appConfig, Request $request)
    {
        $this->appConfig = $appConfig->getAppConfig();
        $this->request = $request;
    }

    /**
     * Добавляет маршрут в таблицу маршрутов
     *
     * @param $regexp
     * @param array $route
     */
    protected function addRoute($regexp, $route = [])
    {
        $this->routes[$regexp] = $route;
    }

    public function addDefaultRoutes()
    {
        $this->addRoute('', [
            'controller' => $this->appConfig[AppConfig::DEFAULT_CONTROLLER_NAME],
            'action' => $this->appConfig[AppConfig::DEFAULT_ACTION_NAME]
        ]);
        $this->addRoute('^(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$');
    }

    /**
     * Сравнивает строку URL с таблицей маршрутов
     *
     * @return bool
     */
    private function isMatchRoute()
    {
        $url = rtrim(substr($this->request->getPathInfo(), 1), '/');

        foreach ($this->routes as $pattern => $route) {
            if (preg_match("#^$pattern$#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        if ($key === 'controller') {
                            $route[$key] = Utils::convertKebabCaseToCamelCase($value);
                        } elseif ($key === 'action') {
                            $route[$key] = lcfirst(Utils::convertKebabCaseToCamelCase($value));
                        }
                    }
                }

                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }

                $this->route = $route;

                return true;
            }
        }

        return false;
    }

    /**
     * Перенаправляет URL по маршруту
     *
     * @throws Exception
     */
    public function dispatch()
    {
        if ($this->isMatchRoute()) {
            return $this->route;
        } else {
            throw new Exception('Нет соответствий таблице маршрутов!');
        }
    }
}
