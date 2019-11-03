<?php

namespace Flexmo;

use App\Configs\AppConfig;
use Exception;

class Router
{
    /** @var string Адресная строка */
    protected $url;
    /** @var array Таблица маршрутов */
    protected $routes = [];
    /** @var array Текущий маршрут */
    protected $route = [];
    protected $appConfig;
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->appConfig = $this->container->get(AppConfig::class)->getAppConfig();
        $this->url = rtrim(substr($_SERVER['REQUEST_URI'], 1), '/');
        $this->addDefaultRoutes();
    }

    /**
     * Добавляет маршрут в таблицу маршрутов
     *
     * @param $regexp
     * @param array $route
     */
    private function addRoute($regexp, $route = [])
    {
        $this->routes[$regexp] = $route;
    }

    /**
     * Добавляет маршруты по-умолчанию
     */
    private function addDefaultRoutes()
    {
        $this->addRoute('^$', [
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
        foreach ($this->routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $this->url, $matches)) {
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
                $this->container->set('route', $route);

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
