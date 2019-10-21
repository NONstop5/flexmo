<?php

namespace Flexmo;

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
        $this->addRoute('^$', ['controller' => 'Main', 'action' => 'index']);
        $this->addRoute('^(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$');
    }

    /**
     * Возвращает таблицу маршрутов
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Возвращает текуцщий маршрут
     *
     * @return array
     */
    public function getRoute()
    {
        return $this->route;
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
                            $route[$key] = $this->convertToCamelCase($value);
                        } elseif ($key === 'action') {
                            $route[$key] = lcfirst($this->convertToCamelCase($value));
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
     */
    public function dispatch()
    {
        if ($this->matchRoute()) {
            $controllerClassName = 'App\Controllers\\' . $this->route['controller'];

            if (class_exists($controllerClassName)) {
                $controllerObject = new $controllerClassName($this->route);
                $controllerAction = $this->convertToCamelCase($this->route['action']) . ACTION_POSTFIX;

                if (method_exists($controllerObject, $controllerAction)) {
                    $controllerObject->$controllerAction();
                } else {
                    echo 'No Method!';
                }
            } else {
                echo 'NO Class!';
            }
        } else {
            echo 'NOT MATCH!';
            //$this->errorPage();
        }
    }

    /**
     * Преобразует строку запроса c дифисами в имя класса в CamelCase
     *
     * @param $className
     * @return mixed
     */
    private function convertToCamelCase($className)
    {
        return str_replace('-', '', ucwords($className, '-'));
    }

    /**
     * Выводит страницу 404
     */
    private function errorPage()
    {
        header('Location: ' . $_SERVER['REQUEST_URI'], true, 404);
        print('Страница не обнаружена!');
    }
}
