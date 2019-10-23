<?php

namespace Flexmo;

use Exception;

class Router
{
    /** @var string Адресная строка */
    protected $url;

    /** @var array Таблица маршрутов */
    protected $routes = [];

    /** @var array Текущий маршрут */
    protected $route = [];

    public function __construct()
    {
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
        $this->addRoute('^$', ['controller' => 'Main', 'action' => 'index', 'view' => 'index']);
        $this->addRoute('^(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$');
    }

    /**
     * Сравнивает строку URL с таблицей маршрутов
     *
     * @return bool
     */
    private function matchRoute()
    {
        foreach ($this->routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $this->url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        if ($key === 'controller') {
                            $route[$key] = Utils::convertToCamelCase($value);
                        } elseif ($key === 'action') {
                            $route[$key] = lcfirst(Utils::convertToCamelCase($value));
                            $route['view'] = $value;
                        }
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                    $route['view'] = $route['action'];
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
        if ($this->matchRoute()) {
            bdump($this->route);
            return $this->route;
        } else {
            throw new Exception('Нет соответствий таблице маршрутов!');
            //$this->errorPage();
        }
    }
}
